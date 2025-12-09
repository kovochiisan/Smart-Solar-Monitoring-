<?php
require("phpMQTT.php");

// -----------------------------
// MySQL Connection
// -----------------------------
$host = "localhost";
$user = "root";
$pass = "";
$db   = "smart_solar";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// -----------------------------
// MQTT Config
// -----------------------------
$server    = "broker.hivemq.com";
$port      = 1883;
$client_id = "phpMQTT-solar-bridge-" . rand(0, 1000);
$mqtt      = new Bluerhinos\phpMQTT($server, $port, $client_id);
$data      = [];

// -----------------------------
// Notification Cooldown System
// -----------------------------
$lastNotification = [];
$cooldown = 600; // 10 minutes

function canNotify($key) {
    global $lastNotification, $cooldown;
    $now = time();
    if (!isset($lastNotification[$key]) || ($now - $lastNotification[$key]) >= $cooldown) {
        $lastNotification[$key] = $now;
        return true;
    }
    return false;
}

function formatPHNumber($number) {
    $digits = preg_replace('/\D/', '', $number);
    if ($digits === '') return '';
    if (substr($digits, 0, 1) === '0') return '+63' . substr($digits, 1);
    if (substr($digits, 0, 2) === '63') return '+' . $digits;
    return '+' . $digits;
}

// -----------------------------
// Alert Handler
// -----------------------------
function checkAlertsAndNotify($data, $conn, $mqtt) {
    $notifications = [];

    // Battery Alerts
    if ($data['battery/soc'] < 20 && canNotify('battery_soc_low'))
        $notifications[] = "Hey! Your battery's running low — it's down to {$data['battery/soc']}%.";
    if ($data['battery/soc'] > 95 && canNotify('battery_soc_high'))
        $notifications[] = "Good news! Your battery’s almost full at {$data['battery/soc']}%.";

    if ($data['battery/voltage'] < 11 && canNotify('battery_voltage_low'))
        $notifications[] = "Heads up! Battery voltage is low ({$data['battery/voltage']}V).";
    if ($data['battery/voltage'] > 15 && canNotify('battery_voltage_high'))
        $notifications[] = "Whoa! Battery voltage is high ({$data['battery/voltage']}V).";

    if ($data['battery/current'] > 10 && canNotify('battery_current_high'))
        $notifications[] = "Battery current is high ({$data['battery/current']}A).";
    if ($data['battery/current'] < -5 && canNotify('battery_fast_discharge'))
        $notifications[] = "Battery is discharging fast ({$data['battery/current']}A).";

    // Solar Alerts
    if ($data['solar/voltageee'] < 12 && canNotify('solar_voltage_low'))
        $notifications[] = "Solar voltage seems low ({$data['solar/voltageee']}V). Maybe it’s cloudy?";
    if ($data['solar/voltageee'] > 30 && canNotify('solar_voltage_high'))
        $notifications[] = "Solar voltage is high ({$data['solar/voltageee']}V). Strong sunlight!";

    if ($data['solar/currenttt'] > 10 && canNotify('solar_current_high'))
        $notifications[] = "Solar current’s high ({$data['solar/currenttt']}A).";

    if ($data['solar/powerrr'] < 50 && canNotify('solar_power_low'))
        $notifications[] = "Solar power’s really low ({$data['solar/powerrr']}W).";
    if ($data['solar/powerrr'] > 3000 && canNotify('solar_power_high'))
        $notifications[] = "Solar power’s very strong ({$data['solar/powerrr']}W).";

    // Temperature Alerts
    if ($data['system/temperature'] > 60 && canNotify('temp_high'))
        $notifications[] = "Temperature alert — your system’s at {$data['system/temperature']}°C.";
    if ($data['system/temperature'] > 75 && canNotify('temp_critical'))
        $notifications[] = "Critical alert! System temperature is very high ({$data['system/temperature']}°C).";
    if ($data['system/temperature'] < 0 && canNotify('temp_freezing'))
        $notifications[] = "System temperature is below freezing ({$data['system/temperature']}°C).";

    // Combined Alerts
    if ($data['solar/powerrr'] < 0.1 && $data['battery/soc'] < 20 && canNotify('critical_power'))
        $notifications[] = "Power’s in trouble — solar isn’t producing and your battery’s almost empty!";

    // Push notifications
    if (count($notifications) > 0) {
        $users = [];
        $res = $conn->query("SELECT id, contact_number FROM users");
        while ($row = $res->fetch_assoc()) $users[] = $row;

        foreach ($notifications as $msg) {
            $stmt = $conn->prepare("INSERT INTO notifications (message) VALUES (?)");
            $stmt->bind_param("s", $msg);
            $stmt->execute();
            $nid = $stmt->insert_id;
            $stmt->close();

            foreach ($users as $u) {
                $stmt = $conn->prepare("INSERT INTO user_notifications (user_id, notification_id) VALUES (?, ?)");
                $stmt->bind_param("ii", $u['id'], $nid);
                $stmt->execute();
                $stmt->close();

                $formatted = formatPHNumber($u['contact_number']);
                if (!empty($formatted)) {
                    $payload = $formatted . "|" . $msg;
                    $mqtt->publish("system/sms/send", $payload, 0);
                    echo "[" . date('Y-m-d H:i:s') . "] 📱 SMS MQTT published to {$formatted}: {$msg}\n";
                    usleep(100000);
                }
            }

            echo "[" . date('Y-m-d H:i:s') . "] 🔔 Notification created: $msg\n";
        }
    }
}

// -----------------------------
// MQTT Message Handler
// -----------------------------
function handleMessage($topic, $msg) {
    global $data, $conn, $mqtt;

    echo "[" . date('Y-m-d H:i:s') . "] Received: $topic => $msg\n";
    $data[$topic] = floatval($msg);

    $required = [
        "solar/voltageee","solar/currenttt","solar/powerrr",
        "battery/voltage","battery/current","battery/power",
        "battery/soc","system/temperature"
    ];
    foreach ($required as $r) if (!isset($data[$r])) return;

    $stmt = $conn->prepare("
        INSERT INTO sensor_reading 
        (solar_voltage, solar_current, solar_power, battery_voltage, battery_current, battery_power, battery_soc, temperature)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");
    if (!$stmt) {
        echo "❌ SQL Prepare failed: " . $conn->error . "\n";
        return;
    }

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
        echo "[" . date('Y-m-d H:i:s') . "] ✅ Data inserted into database\n";
        checkAlertsAndNotify($data, $conn, $mqtt);
    } else {
        echo "❌ SQL Execute failed: " . $stmt->error . "\n";
    }

    $stmt->close();
    $data = [];
}

// -----------------------------
// Subscribe and Listen
// -----------------------------
$topics = [
    "solar/voltageee"     => ["qos"=>0,"function"=>"handleMessage"],
    "solar/currenttt"     => ["qos"=>0,"function"=>"handleMessage"],
    "solar/powerrr"       => ["qos"=>0,"function"=>"handleMessage"],
    "battery/voltage"     => ["qos"=>0,"function"=>"handleMessage"],
    "battery/current"     => ["qos"=>0,"function"=>"handleMessage"],
    "battery/power"       => ["qos"=>0,"function"=>"handleMessage"],
    "battery/soc"         => ["qos"=>0,"function"=>"handleMessage"],
    "system/temperature"  => ["qos"=>0,"function"=>"handleMessage"]
];

if ($mqtt->connect(true, NULL, NULL, NULL)) {
    echo "[" . date('Y-m-d H:i:s') . "] Connected to MQTT broker\n";
    $mqtt->subscribe($topics);
    while ($mqtt->proc()) usleep(100000);
    $mqtt->close();
} else {
    echo "[" . date('Y-m-d H:i:s') . "] ❌ Failed to connect to MQTT broker\n";
}
$conn->close();
?>
