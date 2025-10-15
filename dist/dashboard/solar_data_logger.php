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
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// -----------------------------
// MQTT Config
// -----------------------------
$server    = "broker.hivemq.com";
$port      = 1883;
$client_id = "phpMQTT-solar-bridge";

// Store latest readings
$data = [];

// -----------------------------
// Notification cooldowns
// -----------------------------
$lastNotification = []; // ['notification_key' => timestamp]
$cooldown = 600; // seconds (10 minutes)

// Helper function to check cooldown
function canNotify($key) {
    global $lastNotification, $cooldown;
    $now = time();
    if (!isset($lastNotification[$key]) || ($now - $lastNotification[$key]) >= $cooldown) {
        $lastNotification[$key] = $now;
        return true;
    }
    return false;
}

// -----------------------------
// Callback function for MQTT messages
// -----------------------------
function handleMessage($topic, $msg)
{
    global $data, $conn;

    echo "[" . date('Y-m-d H:i:s') . "] Received: $topic => $msg\n";
    $data[$topic] = floatval($msg);

    $requiredTopics = [
        "solar/voltage",
        "solar/current",
        "solar/power",
        "battery/voltage",
        "battery/current",
        "battery/power",
        "battery/soc",
        "system/temperature"
    ];

    if (count(array_intersect_key(array_flip($requiredTopics), $data)) === count($requiredTopics)) {
        // Insert sensor readings
        $stmt = $conn->prepare("
            INSERT INTO sensor_reading 
            (solar_voltage, solar_current, solar_power, battery_voltage, battery_current, battery_power, battery_soc, temperature)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param(
            "dddddddd",
            $data['solar/voltage'],
            $data['solar/current'],
            $data['solar/power'],
            $data['battery/voltage'],
            $data['battery/current'],
            $data['battery/power'],
            $data['battery/soc'],
            $data['system/temperature']
        );
        $stmt->execute();
        $stmt->close();
        echo "[" . date('Y-m-d H:i:s') . "] Data inserted into database\n";

        // -----------------------------
        // Notifications logic with cooldown
        // -----------------------------
        $notifications = [];

        // --- Battery Notifications ---
        if ($data['battery/soc'] < 20 && canNotify('battery_soc_low')) {
            $notifications[] = "Battery SOC low: " . $data['battery/soc'] . "%";
        }
        if ($data['battery/soc'] > 95 && canNotify('battery_soc_high')) {
            $notifications[] = "Battery SOC high: " . $data['battery/soc'] . "%";
        }
        if ($data['battery/voltage'] < 11 && canNotify('battery_voltage_low')) {
            $notifications[] = "Battery voltage too low: " . $data['battery/voltage'] . "V";
        }
        if ($data['battery/voltage'] > 15 && canNotify('battery_voltage_high')) {
            $notifications[] = "Battery voltage too high: " . $data['battery/voltage'] . "V";
        }
        if ($data['battery/current'] > 10 && canNotify('battery_current_high')) {
            $notifications[] = "Battery current too high: " . $data['battery/current'] . "A";
        }
        if ($data['battery/current'] < -5 && canNotify('battery_current_fast_discharge')) {
            $notifications[] = "Battery discharging too fast: " . $data['battery/current'] . "A";
        }
        if ($data['battery/power'] > 500 && canNotify('battery_power_high')) {
            $notifications[] = "Battery power too high: " . $data['battery/power'] . "W";
        }

        // --- Solar Notifications ---
        if ($data['solar/voltage'] < 12 && canNotify('solar_voltage_low')) {
            $notifications[] = "Solar voltage too low: " . $data['solar/voltage'] . "V";
        }
        if ($data['solar/voltage'] > 30 && canNotify('solar_voltage_high')) {
            $notifications[] = "Solar voltage too high: " . $data['solar/voltage'] . "V";
        }
        if ($data['solar/current'] > 10 && canNotify('solar_current_high')) {
            $notifications[] = "Solar current too high: " . $data['solar/current'] . "A";
        }
        if ($data['solar/current'] < 0 && canNotify('solar_current_negative')) {
            $notifications[] = "Solar current negative: " . $data['solar/current'] . "A";
        }
        if ($data['solar/power'] < 50 && canNotify('solar_power_low')) {
            $notifications[] = "Solar power low: " . $data['solar/power'] . "W";
        }
        if ($data['solar/power'] > 3000 && canNotify('solar_power_high')) {
            $notifications[] = "Solar power unusually high: " . $data['solar/power'] . "W";
        }

        // --- System Temperature Notifications ---
        if ($data['system/temperature'] > 60 && canNotify('temp_high')) {
            $notifications[] = "System temperature high: " . $data['system/temperature'] . "°C";
        }
        if ($data['system/temperature'] > 75 && canNotify('temp_critical')) {
            $notifications[] = "System temperature critical: " . $data['system/temperature'] . "°C!";
        }
        if ($data['system/temperature'] < 0 && canNotify('temp_freezing')) {
            $notifications[] = "System temperature below freezing: " . $data['system/temperature'] . "°C";
        }

        // --- Combined or Performance Alerts ---
        if ($data['solar/power'] < 0.1 && $data['battery/soc'] < 20 && canNotify('critical_power')) {
            $notifications[] = "Critical power alert: Solar not producing and battery low!";
        }
        if ($data['battery/voltage'] > $data['solar/voltage'] + 5 && canNotify('voltage_mismatch')) {
            $notifications[] = "Voltage mismatch: Battery voltage higher than solar by 5V!";
        }

        // Insert notifications into database and assign to users
        $user_ids = [3, 4, 5]; // Replace with actual user IDs
        foreach ($notifications as $msg) {
            $stmt = $conn->prepare("INSERT INTO notifications (message) VALUES (?)");
            $stmt->bind_param("s", $msg);
            $stmt->execute();
            $notification_id = $stmt->insert_id;
            $stmt->close();

            foreach ($user_ids as $user_id) {
                $stmt = $conn->prepare("INSERT INTO user_notifications (user_id, notification_id) VALUES (?, ?)");
                $stmt->bind_param("ii", $user_id, $notification_id);
                $stmt->execute();
                $stmt->close();
            }

            echo "[" . date('Y-m-d H:i:s') . "] Notification created: $msg\n";
        }

        $data = []; // Clear readings
    }
}

// -----------------------------
// Subscribe Topics
// -----------------------------
$topics = [
    "solar/voltage"      => ['qos' => 0, 'function' => 'handleMessage'],
    "solar/current"      => ['qos' => 0, 'function' => 'handleMessage'],
    "solar/power"        => ['qos' => 0, 'function' => 'handleMessage'],
    "battery/voltage"    => ['qos' => 0, 'function' => 'handleMessage'],
    "battery/current"    => ['qos' => 0, 'function' => 'handleMessage'],
    "battery/power"      => ['qos' => 0, 'function' => 'handleMessage'],
    "battery/soc"        => ['qos' => 0, 'function' => 'handleMessage'],
    "system/temperature" => ['qos' => 0, 'function' => 'handleMessage']
];

// -----------------------------
// Connect to MQTT broker
// -----------------------------
$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);

if ($mqtt->connect(true, NULL, NULL, NULL)) {
    echo "[" . date('Y-m-d H:i:s') . "] Connected to MQTT broker\n";
    $mqtt->subscribe($topics);

    while ($mqtt->proc()) {
        usleep(100000); // Reduce CPU usage
    }

    $mqtt->close();
} else {
    echo "[" . date('Y-m-d H:i:s') . "] Failed to connect to MQTT broker\n";
}

$conn->close();
