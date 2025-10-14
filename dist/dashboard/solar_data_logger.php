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
function handleMessage($topic, $msg) {
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

        if ($stmt->execute()) {
            echo "[" . date('Y-m-d H:i:s') . "] Data inserted into database\n";
        } else {
            echo "[" . date('Y-m-d H:i:s') . "] Failed to insert data: " . $stmt->error . "\n";
        }

        // Clear stored readings
        $data = [];
        $stmt->close();
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
?>
