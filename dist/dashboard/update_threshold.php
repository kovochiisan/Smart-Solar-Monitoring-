<?php
include 'config.php';
require("phpMQTT.php");
session_start();

header('Content-Type: application/json');

// -----------------------------
// MQTT Config
// -----------------------------
$server    = "broker.hivemq.com";
$port      = 1883;
$client_id = "phpMQTT-threshold-" . rand(0, 1000);
$topic_sms = "system/sms/send";
$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);

// -----------------------------
// Helper: format PH numbers
// -----------------------------
function formatPHNumber($number)
{
    $digits = preg_replace('/\D/', '', $number);
    if ($digits === '') return '';
    if (substr($digits, 0, 1) === '0') return '+63' . substr($digits, 1);
    if (substr($digits, 0, 2) === '63') return '+' . $digits;
    if (strlen($digits) > 10 && substr($digits, 0, 2) !== '63') return '+' . $digits;
    return '+' . $digits;
}

// -----------------------------
// Recommended threshold limits
// -----------------------------
$MIN_THRESHOLD = 35; // Safe cutoff to protect battery & ensure stable output
$MAX_THRESHOLD = 80; // Optimal upper limit for battery longevity


$value = isset($_POST['value']) ? intval($_POST['value']) : 100;
$user_name = isset($_SESSION['full_name']) ? $_SESSION['full_name'] : 'Unknown User';

// -----------------------------
// Determine severity based on threshold
// -----------------------------
$severity = 'INFO'; // Default severity
$warning_messages = [];

if ($value < $MIN_THRESHOLD) {
    $severity = 'WARNING';
    $warning_messages[] = "⚠️ Warning: Setting battery threshold below {$MIN_THRESHOLD}% may cause deep discharge and shorten battery life.";
} elseif ($value > $MAX_THRESHOLD) {
    $severity = 'RECOMMENDATION';
    $warning_messages[] = "⚠️ Recommendation: Setting battery threshold above {$MAX_THRESHOLD}% may prevent optimal battery usage.";
}

// -----------------------------
// Update DB with user-set value
// -----------------------------
$query = "UPDATE battery_threshold SET value=$value WHERE threshold_name='MainBattery'";
if (mysqli_query($conn, $query)) {

    $message = "Battery threshold updated to $value% by $user_name";

    // Insert main notification with proper severity
    $stmt = $conn->prepare("INSERT INTO notifications (message, severity) VALUES (?, ?)");
    $stmt->bind_param("ss", $message, $severity);
    $stmt->execute();
    $notification_id = $stmt->insert_id;
    $stmt->close();

    // Notify all users
    $users = $conn->query("SELECT id, contact_number FROM users");
    $sms_messages = [];

    while ($user = $users->fetch_assoc()) {
        $uid = $user['id'];
        $conn->query("INSERT INTO user_notifications (user_id, notification_id, is_read) VALUES ($uid, $notification_id, 0)");

        $formatted = formatPHNumber($user['contact_number']);
        if (!empty($formatted)) {
            $sms_messages[] = [
                'number' => $formatted,
                'message' => $message
            ];
        }
    }

    // Send MQTT SMS
    $mqtt_status = false;
    if ($mqtt->connect(true, NULL, NULL, NULL)) {
        foreach ($sms_messages as $sms) {
            $payload = $sms['number'] . "|" . $sms['message'];
            $mqtt->publish($topic_sms, $payload, 0);
            usleep(100000);
        }
        $mqtt->close();
        $mqtt_status = true;
    }

    // Return JSON response including warnings and severity
    echo json_encode([
        'success' => true,
        'value' => $value,
        'message' => $message,
        'severity' => $severity,
        'warnings' => $warning_messages,
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
