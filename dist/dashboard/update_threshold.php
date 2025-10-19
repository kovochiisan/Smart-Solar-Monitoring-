<?php
include 'config.php';
require("phpMQTT.php");
session_start();

header('Content-Type: application/json'); // ✅ Make sure we output JSON only

// -----------------------------
// MQTT Config
// -----------------------------
$server    = "broker.hivemq.com";
$port      = 1883;
$client_id = "phpMQTT-threshold-" . rand(0, 1000);
$topic_sms = "system/sms/send";

// Create MQTT client
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
// Battery threshold update
// -----------------------------
$value = isset($_POST['value']) ? intval($_POST['value']) : 100;
$user_name = isset($_SESSION['full_name']) ? $_SESSION['full_name'] : 'Unknown User';

// Update DB
$query = "UPDATE battery_threshold SET value=$value WHERE threshold_name='MainBattery'";
if (mysqli_query($conn, $query)) {

    // 1️⃣ Notification message
    $message = "Battery threshold updated to $value% by $user_name";

    // 2️⃣ Insert into notifications
    $stmt = $conn->prepare("INSERT INTO notifications (message) VALUES (?)");
    $stmt->bind_param("s", $message);
    $stmt->execute();
    $notification_id = $stmt->insert_id;
    $stmt->close();

    // 3️⃣ Assign to all users
    $users = $conn->query("SELECT id, contact_number FROM users");
    $sms_messages = [];

    while ($user = $users->fetch_assoc()) {
        $uid = $user['id'];
        $conn->query("INSERT INTO user_notifications (user_id, notification_id, is_read) VALUES ($uid, $notification_id, 0)");

        // Add to SMS list
        $formatted = formatPHNumber($user['contact_number']);
        if (!empty($formatted)) {
            $sms_messages[] = [
                'number' => $formatted,
                'message' => $message
            ];
        }
    }

    // 4️⃣ Send MQTT SMS message to ESP32
    $mqtt_status = false;
    if ($mqtt->connect(true, NULL, NULL, NULL)) {
        foreach ($sms_messages as $sms) {
            $payload = $sms['number'] . "|" . $sms['message'];
            $mqtt->publish($topic_sms, $payload, 0);
            usleep(100000); // avoid flooding
        }
        $mqtt->close();
        $mqtt_status = true;
    }

    // ✅ Clean JSON response for SweetAlert
    echo json_encode([
        'success' => true,
        'value' => $value,
        'message' => $message,
        'sms_sent' => $mqtt_status,
        'sms_count' => count($sms_messages)
    ]);

} else {
    echo json_encode([
        'success' => false,
        'error' => mysqli_error($conn)
    ]);
}

$conn->close();
?>
