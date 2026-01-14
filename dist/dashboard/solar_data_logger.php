<?php
require("phpMQTT.php");

// -----------------------------
// MySQL Connection
// -----------------------------
$conn = new mysqli("localhost", "root", "", "smart_solar");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// -----------------------------
// MQTT Config
// -----------------------------
$mqtt = new Bluerhinos\phpMQTT(
    "broker.hivemq.com",
    1883,
    "phpMQTT-solar-bridge-" . rand(0, 1000)
);

$data = [];

// -----------------------------
// Notification Cooldown
// -----------------------------
$lastNotification = [];
$cooldown = 600;

function canNotify($key)
{
    global $lastNotification, $cooldown;
    $now = time();
    if (!isset($lastNotification[$key]) || ($now - $lastNotification[$key]) >= $cooldown) {
        $lastNotification[$key] = $now;
        return true;
    }
    return false;
}

function formatPHNumber($number)
{
    $digits = preg_replace('/\D/', '', $number);
    if ($digits === '') return '';
    if ($digits[0] === '0') return '+63' . substr($digits, 1);
    if (substr($digits, 0, 2) === '63') return '+' . $digits;
    return '+' . $digits;
}

// -----------------------------
// Alert Handler with Severity
// -----------------------------
function checkAlertsAndNotify($data, $conn, $mqtt)
{
    $alerts = [];

    // -----------------------------
    // WARNING (Early indicators)
    // -----------------------------
    if ($data['battery/soc'] < 30 && canNotify('soc_warning')) {
        $alerts[] = [
            'severity' => 'WARNING',
            'message' =>
            "Battery charge is dropping ({$data['battery/soc']}%). Monitor usage to avoid deep discharge."
        ];
    }
    if ($data['battery/soc'] < 20 && canNotify('soc_low')) {
        $alerts[] = [
            'severity' => 'WARNING',
            'message' =>
            "Battery charge is critically low ({$data['battery/soc']}%). Prepare for possible system shutdown."
        ];
    }
    if ($data['battery/current'] > 20 && canNotify('battery_current_warn')) {
        $alerts[] = [
            'severity' => 'WARNING',
            'message' =>
            "High battery current detected ({$data['battery/current']}A). Possible heavy load condition."
        ];
    }

    // -----------------------------
    // MAINTENANCE (Preventive)
    // -----------------------------
    if ($data['battery/voltage'] < 11 && canNotify('battery_maint')) {
        $alerts[] = [
            'severity' => 'MAINTENANCE',
            'message' =>
            "Battery voltage is below normal ({$data['battery/voltage']}V). Possible aging or loose wiring. Maintenance inspection recommended."
        ];
    }
    if ($data['solar/powerrr'] < 50 && canNotify('solar_maint')) {
        $alerts[] = [
            'severity' => 'MAINTENANCE',
            'message' =>
            "Solar power output is abnormally low ({$data['solar/powerrr']}W). Panel cleaning or inspection is advised."
        ];
    }
    if ($data['solar/voltageee'] < 15 && canNotify('solar_voltage_low')) {
        $alerts[] = [
            'severity' => 'MAINTENANCE',
            'message' =>
            "Solar voltage is below expected level ({$data['solar/voltageee']}V). Possible shading or loose connections."
        ];
    }
    if ($data['solar/powerrr'] == 0 && canNotify('solar_zero')) {
        $alerts[] = [
            'severity' => 'MAINTENANCE',
            'message' =>
            "No solar power output detected. Panel disconnection or failure suspected."
        ];
    }
    if ($data['solar/powerrr'] < 50 && $data['solar/voltageee'] < 12 && canNotify('system_degradation')) {
        $alerts[] = [
            'severity' => 'MAINTENANCE',
            'message' =>
            "⚠️ Maintenance Required: Solar voltage and power output are both below normal. System performance degradation detected."
        ];
    }
    if ($data['battery/current'] <= 0 && $data['solar/powerrr'] > 50 && canNotify('battery_not_charging')) {
        $alerts[] = [
            'severity' => 'MAINTENANCE',
            'message' =>
            "Battery is not charging despite available solar power. Charge controller or wiring inspection recommended."
        ];
    }

    // -----------------------------
    // CRITICAL (Immediate action)
    // -----------------------------
    if ($data['system/temperature'] > 75 && canNotify('temp_critical')) {
        $alerts[] = [
            'severity' => 'CRITICAL',
            'message' =>
            "Critical temperature detected ({$data['system/temperature']}°C). Immediate maintenance required to prevent system failure."
        ];
    }
    if ($data['battery/voltage'] > 14.8 && canNotify('battery_overvolt')) {
        $alerts[] = [
            'severity' => 'CRITICAL',
            'message' =>
            "Battery overvoltage detected ({$data['battery/voltage']}V). Risk of battery damage."
        ];
    }
    if ($data['system/temperature'] > 85 && canNotify('temp_shutdown')) {
        $alerts[] = [
            'severity' => 'CRITICAL',
            'message' =>
            "Extreme temperature detected ({$data['system/temperature']}°C). System shutdown may occur."
        ];
    }

    // -----------------------------
    // Save & Send Alerts
    // -----------------------------
    if (!empty($alerts)) {
        $users = [];
        $res = $conn->query("SELECT id, contact_number FROM users");
        while ($row = $res->fetch_assoc()) $users[] = $row;

        foreach ($alerts as $alert) {
            $stmt = $conn->prepare(
                "INSERT INTO notifications (message, severity) VALUES (?, ?)"
            );
            $stmt->bind_param("ss", $alert['message'], $alert['severity']);
            $stmt->execute();
            $nid = $stmt->insert_id;
            $stmt->close();

            foreach ($users as $u) {
                $stmt = $conn->prepare(
                    "INSERT INTO user_notifications (user_id, notification_id) VALUES (?, ?)"
                );
                $stmt->bind_param("ii", $u['id'], $nid);
                $stmt->execute();
                $stmt->close();

                $formatted = formatPHNumber($u['contact_number']);
                if ($formatted) {
                    $payload = $formatted . "|[" . $alert['severity'] . "] " . $alert['message'];
                    $mqtt->publish("system/sms/send", $payload, 0);
                    usleep(100000);
                }
            }

            echo "[" . date('Y-m-d H:i:s') . "] 🔔 {$alert['severity']} - {$alert['message']}\n";
        }
    }
}

// -----------------------------
// MQTT Message Handler
// -----------------------------
function handleMessage($topic, $msg)
{
    global $data, $conn, $mqtt;
    $data[$topic] = floatval($msg);

    $required = [
        "solar/voltageee",
        "solar/currenttt",
        "solar/powerrr",
        "battery/voltage",
        "battery/current",
        "battery/power",
        "battery/soc",
        "system/temperature"
    ];

    foreach ($required as $r)
        if (!isset($data[$r])) return;

    $stmt = $conn->prepare("
        INSERT INTO sensor_reading
        (solar_voltage, solar_current, solar_power,
         battery_voltage, battery_current, battery_power,
         battery_soc, temperature)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "dddddddd",
        $data['solar/voltageee'],
        $data['solar/currenttt'],
        $data['solar/powerrr'],
        $data['battery/voltage'],
        $data['battery/current'],
        $data['battery/power'],
        $data['battery/soc'],
        $data['system/temperature']
    );

    if ($stmt->execute()) {
        checkAlertsAndNotify($data, $conn, $mqtt);
    }

    $stmt->close();
    $data = [];
}

// -----------------------------
// MQTT Subscribe
// -----------------------------
$topics = [
    "solar/voltageee"    => ["qos" => 0, "function" => "handleMessage"],
    "solar/currenttt"    => ["qos" => 0, "function" => "handleMessage"],
    "solar/powerrr"      => ["qos" => 0, "function" => "handleMessage"],
    "battery/voltage"    => ["qos" => 0, "function" => "handleMessage"],
    "battery/current"    => ["qos" => 0, "function" => "handleMessage"],
    "battery/power"      => ["qos" => 0, "function" => "handleMessage"],
    "battery/soc"        => ["qos" => 0, "function" => "handleMessage"],
    "system/temperature" => ["qos" => 0, "function" => "handleMessage"]
];

if ($mqtt->connect(true, NULL, NULL, NULL)) {
    $mqtt->subscribe($topics);
    while ($mqtt->proc()) usleep(100000);
    $mqtt->close();
}

$conn->close();
