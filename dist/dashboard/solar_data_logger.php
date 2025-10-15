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
// Callback function for MQTT messages
// -----------------------------
function handleMessage($topic, $msg)
{
    global $data, $conn;
    echo "[" . date('Y-m-d H:i:s') . "] Received: $topic => $msg\n";

    $data[$topic] = floatval($msg);

    // Required topics to log data
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

    // Check if all required topics are received
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
        // Extended Notifications logic
        // -----------------------------
        $notifications = [];

        // --- Battery Notifications ---
        if ($data['battery/soc'] < 20) {
            $notifications[] = "Battery SOC low: " . $data['battery/soc'] . "%";
        }
        if ($data['battery/soc'] > 95) {
            $notifications[] = "Battery SOC high: " . $data['battery/soc'] . "%";
        }
        if ($data['battery/voltage'] < 11) {
            $notifications[] = "Battery voltage too low: " . $data['battery/voltage'] . "V";
        }
        if ($data['battery/voltage'] > 15) {
            $notifications[] = "Battery voltage too high: " . $data['battery/voltage'] . "V";
        }
        if ($data['battery/current'] > 10) {
            $notifications[] = "Battery current too high: " . $data['battery/current'] . "A";
        }
        if ($data['battery/current'] < -5) {
            $notifications[] = "Battery discharging too fast: " . $data['battery/current'] . "A";
        }
        if ($data['battery/power'] > 500) {
            $notifications[] = "Battery power too high: " . $data['battery/power'] . "W";
        }

        // --- Solar Notifications ---
        if ($data['solar/voltage'] < 12) {
            $notifications[] = "Solar voltage too low: " . $data['solar/voltage'] . "V";
        }
        if ($data['solar/voltage'] > 30) {
            $notifications[] = "Solar voltage too high: " . $data['solar/voltage'] . "V";
        }
        if ($data['solar/current'] > 10) {
            $notifications[] = "Solar current too high: " . $data['solar/current'] . "A";
        }
        if ($data['solar/current'] < 0) {
            $notifications[] = "Solar current negative: " . $data['solar/current'] . "A";
        }
        if ($data['solar/power'] < 50) {
            $notifications[] = "Solar power low: " . $data['solar/power'] . "W";
        }
        if ($data['solar/power'] > 3000) {
            $notifications[] = "Solar power unusually high: " . $data['solar/power'] . "W";
        }

        // --- System Temperature Notifications ---
        if ($data['system/temperature'] > 60) {
            $notifications[] = "System temperature high: " . $data['system/temperature'] . "°C";
        }
        if ($data['system/temperature'] > 75) {
            $notifications[] = "System temperature critical: " . $data['system/temperature'] . "°C!";
        }
        if ($data['system/temperature'] < 0) {
            $notifications[] = "System temperature below freezing: " . $data['system/temperature'] . "°C";
        }

        // --- Combined or Performance Alerts ---
        if ($data['solar/power'] < 0.1 && $data['battery/soc'] < 20) {
            $notifications[] = "Critical power alert: Solar not producing and battery low!";
        }
        if ($data['battery/voltage'] > $data['solar/voltage'] + 5) {
            $notifications[] = "Voltage mismatch: Battery voltage higher than solar by 5V!";
        }


        // Insert notifications into database and assign to users
        $user_ids = [3, 4, 5]; // Replace with actual user IDs
        foreach ($notifications as $msg) {
            // Insert into notifications table
            $stmt = $conn->prepare("INSERT INTO notifications (message) VALUES (?)");
            $stmt->bind_param("s", $msg);
            $stmt->execute();
            $notification_id = $stmt->insert_id;
            $stmt->close();

            // Assign to users
            foreach ($user_ids as $user_id) {
                $stmt = $conn->prepare("INSERT INTO user_notifications (user_id, notification_id) VALUES (?, ?)");
                $stmt->bind_param("ii", $user_id, $notification_id);
                $stmt->execute();
                $stmt->close();
            }

            echo "[" . date('Y-m-d H:i:s') . "] Notification created: $msg\n";
        }

        // Clear stored readings
        $data = [];
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

    // Subscribe to topics
    $mqtt->subscribe($topics);

    // Keep listening for messages indefinitely
    while ($mqtt->proc()) {
        // Optional: add sleep to reduce CPU usage
        usleep(100000); // 0.1 sec
    }

    $mqtt->close();
} else {
    echo "[" . date('Y-m-d H:i:s') . "] Failed to connect to MQTT broker\n";
}

$conn->close();
