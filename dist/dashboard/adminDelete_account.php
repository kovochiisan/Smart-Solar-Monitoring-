<?php
require_once "config.php";
require("phpMQTT.php");
session_start();

header('Content-Type: application/json');

// -----------------------------
// MQTT Config
// -----------------------------
$server    = "broker.hivemq.com";
$port      = 1883;
$client_id = "phpMQTT-delete-user-" . rand(1000, 9999);
$topic_sms = "system/sms/send";

$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);

// -----------------------------
// Helper: format PH numbers
// -----------------------------
function formatPHNumber($number) {
    $digits = preg_replace('/\D/', '', $number);
    if ($digits === '') return '';
    if (substr($digits, 0, 1) === '0') return '+63' . substr($digits, 1);
    if (substr($digits, 0, 2) === '63') return '+' . $digits;
    if (strlen($digits) > 10 && substr($digits, 0, 2) !== '63') return '+' . $digits;
    return '+' . $digits;
}

// -----------------------------
// Validate POST
// -----------------------------
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id'])) {
    echo json_encode(['success' => false, 'error' => 'Missing ID']);
    exit;
}

$id = intval($_POST['id']);

// Get deleted user's name BEFORE deleting
$stmt = $conn->prepare("SELECT full_name FROM users WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($deleted_name);
$stmt->fetch();
$stmt->close();

// If not found
if (!$deleted_name) {
    echo json_encode(['success' => false, 'error' => 'User not found']);
    exit;
}

// Delete user
$stmt = $conn->prepare("DELETE FROM users WHERE id=?");
$stmt->bind_param("i", $id);

if (!$stmt->execute()) {
    echo json_encode(['success' => false, 'error' => $stmt->error]);
    $stmt->close();
    exit;
}

$stmt->close();

// -----------------------------
// NOTIFICATION + SMS CONTENT
// -----------------------------
$admin_name = isset($_SESSION['full_name']) ? $_SESSION['full_name'] : "Unknown Admin";

$notif_message = "User '$deleted_name' has been deleted by $admin_name.";

// -----------------------------
// 1️⃣ Insert into notifications table
// -----------------------------
$stmt = $conn->prepare("INSERT INTO notifications (message) VALUES (?)");
$stmt->bind_param("s", $notif_message);
$stmt->execute();
$notification_id = $stmt->insert_id;
$stmt->close();

// -----------------------------
// 2️⃣ Assign notification to all users + prepare SMS list
// -----------------------------
$sms_messages = [];
$users = $conn->query("SELECT id, contact_number FROM users");

while ($user = $users->fetch_assoc()) {
    $uid = $user['id'];
    $conn->query("
        INSERT INTO user_notifications (user_id, notification_id, is_read) 
        VALUES ($uid, $notification_id, 0)
    ");

    // SMS build
    $formatted = formatPHNumber($user['contact_number']);
    if (!empty($formatted)) {
        $sms_messages[] = [
            'number' => $formatted,
            'message' => $notif_message
        ];
    }
}

// -----------------------------
// 3️⃣ Send SMS via MQTT
// -----------------------------
$sms_status = false;

if ($mqtt->connect(true, NULL, NULL, NULL)) {
    foreach ($sms_messages as $sms) {
        $payload = $sms['number'] . "|" . $sms['message'];
        $mqtt->publish($topic_sms, $payload, 0);
        usleep(100000); // prevent flooding
    }

    $mqtt->close();
    $sms_status = true;
}

// -----------------------------
// FINAL JSON RESPONSE
// -----------------------------
echo json_encode([
    'success' => true,
    'deleted_user' => $deleted_name,
    'message' => $notif_message,
    'sms_sent' => $sms_status,
    'sms_count' => count($sms_messages)
]);

$conn->close();
?>
