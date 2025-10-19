<?php
include 'config.php';
require("phpMQTT.php");
session_start();

header('Content-Type: application/json'); // 💡 ensures JSON-only output

// -----------------------------
// MQTT Config
// -----------------------------
$server    = "broker.hivemq.com";
$port      = 1883;
$client_id = "phpMQTT-load-" . rand(0, 1000);
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
// Load Control Logic
// -----------------------------
$state = isset($_POST['state']) ? intval($_POST['state']) : 0;
$user_name = isset($_SESSION['full_name']) ? $_SESSION['full_name'] : 'Unknown User';

$query = "UPDATE control_load SET state = $state WHERE load_name = 'MainLoad'";
if (mysqli_query($conn, $query)) {

    // Create message
    $message = $state
        ? "Main load has been turned ON by $user_name"
        : "Main load has been turned OFF by $user_name";

    // Insert into notifications
    $stmt = $conn->prepare("INSERT INTO notifications (message) VALUES (?)");
    $stmt->bind_param("s", $message);
    $stmt->execute();
    $notification_id = $stmt->insert_id;
    $stmt->close();

    // Assign to all users
    $users = $conn->query("SELECT id, contact_number FROM users");
    $sms_messages = [];

    while ($user = $users->fetch_assoc()) {
        $uid = $user['id'];
        $conn->query("INSERT INTO user_notifications (user_id, notification_id, is_read) VALUES ($uid, $notification_id, 0)");

        // Prepare SMS
        $formatted = formatPHNumber($user['contact_number']);
        if (!empty($formatted)) {
            $sms_messages[] = [
                'number' => $formatted,
                'message' => $message
            ];
        }
    }

    // Send SMS via MQTT
    $mqtt_status = false;
    if ($mqtt->connect(true, NULL, NULL, NULL)) {
        foreach ($sms_messages as $sms) {
            $payload = $sms['number'] . "|" . $sms['message'];
            $mqtt->publish($topic_sms, $payload, 0);
            usleep(100000); // small delay
        }
        $mqtt->close();
        $mqtt_status = true;
    }

    // ✅ Return JSON cleanly for SweetAlert
    echo json_encode([
        'success' => true,
        'state' => $state,
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
