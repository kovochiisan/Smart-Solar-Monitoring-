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
$client_id = "phpMQTT-solar-bridge-" . rand(0, 1000);

// Create mqtt client instance
$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);

// Store latest readings
$data = [];

// -----------------------------
// Notification cooldowns
// -----------------------------
$lastNotification = []; // ['notification_key' => timestamp]
$cooldown = 600; // seconds (10 minutes)

// Helper: check cooldown
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

// Helper: format PH numbers to E.164 (+63...)
function formatPHNumber($number)
{
    // Remove non-digit characters
    $digits = preg_replace('/\D/', '', $number);

    if ($digits === '') return '';

    // If starts with 0 -> replace with +63
    if (substr($digits, 0, 1) === '0') {
        return '+63' . substr($digits, 1);
    }
    // If starts with 63 -> add +
    if (substr($digits, 0, 2) === '63') {
        return '+' . $digits;
    }
    // If already has country code like +1... (digits won't contain +), assume safe to prefix +
    if (strlen($digits) > 10 && substr($digits, 0, 2) !== '63') {
        return '+' . $digits;
    }
    // Fallback: return as-is with plus
    return '+' . $digits;
}

// -----------------------------
// Callback function for MQTT messages
// -----------------------------
function handleMessage($topic, $msg)
{
    global $data, $conn, $mqtt;

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
            $notifications[] = "Hey! Your battery's running low — it's down to " . $data['battery/soc'] . "%.";
        }
        if ($data['battery/soc'] > 95 && canNotify('battery_soc_high')) {
            $notifications[] = "Good news! Your battery’s almost full at " . $data['battery/soc'] . "%.";
        }
        if ($data['battery/voltage'] < 11 && canNotify('battery_voltage_low')) {
            $notifications[] = "Heads up! Battery voltage is getting too low (" . $data['battery/voltage'] . "V). You might want to check your system.";
        }
        if ($data['battery/voltage'] > 15 && canNotify('battery_voltage_high')) {
            $notifications[] = "Whoa! Battery voltage is unusually high (" . $data['battery/voltage'] . "V). Better take a look!";
        }
        if ($data['battery/current'] > 10 && canNotify('battery_current_high')) {
            $notifications[] = "Just so you know — your battery current is a bit high at " . $data['battery/current'] . "A.";
        }
        if ($data['battery/current'] < -5 && canNotify('battery_current_fast_discharge')) {
            $notifications[] = "Uh-oh! Your battery is discharging faster than usual (" . $data['battery/current'] . "A).";
        }
        if ($data['battery/power'] > 500 && canNotify('battery_power_high')) {
            $notifications[] = "Notice: Battery power draw is quite high (" . $data['battery/power'] . "W).";
        }

        // --- Solar Notifications ---
        if ($data['solar/voltage'] < 12 && canNotify('solar_voltage_low')) {
            $notifications[] = "Hmm, solar voltage seems a bit low (" . $data['solar/voltage'] . "V). Maybe it’s cloudy?";
        }
        if ($data['solar/voltage'] > 30 && canNotify('solar_voltage_high')) {
            $notifications[] = "Wow, solar voltage is pretty high (" . $data['solar/voltage'] . "V). That’s strong sunlight!";
        }
        if ($data['solar/current'] > 10 && canNotify('solar_current_high')) {
            $notifications[] = "Solar current’s quite high (" . $data['solar/current'] . "A). Looks like your panels are working hard!";
        }
        if ($data['solar/current'] < 0 && canNotify('solar_current_negative')) {
            $notifications[] = "Weird reading — solar current looks negative (" . $data['solar/current'] . "A). Might be a wiring or sensor issue.";
        }
        if ($data['solar/power'] < 50 && canNotify('solar_power_low')) {
            $notifications[] = "Hey, solar power’s really low (" . $data['solar/power'] . "W). Maybe it’s nighttime or overcast?";
        }
        if ($data['solar/power'] > 3000 && canNotify('solar_power_high')) {
            $notifications[] = "Impressive! Solar power is really high right now (" . $data['solar/power'] . "W).";
        }

        // --- System Temperature Notifications ---
        if ($data['system/temperature'] > 60 && canNotify('temp_high')) {
            $notifications[] = "Temperature alert — your system’s getting warm at " . $data['system/temperature'] . "°C.";
        }
        if ($data['system/temperature'] > 75 && canNotify('temp_critical')) {
            $notifications[] = "Critical alert! System temperature is very high (" . $data['system/temperature'] . "°C). Please cool it down soon!";
        }
        if ($data['system/temperature'] < 0 && canNotify('temp_freezing')) {
            $notifications[] = "Brrr! System temperature’s below freezing (" . $data['system/temperature'] . "°C).";
        }

        // --- Combined Alerts ---
        if ($data['solar/power'] < 0.1 && $data['battery/soc'] < 20 && canNotify('critical_power')) {
            $notifications[] = "Power’s in trouble — solar isn’t producing and your battery’s almost empty!";
        }
        if ($data['battery/voltage'] > $data['solar/voltage'] + 5 && canNotify('voltage_mismatch')) {
            $notifications[] = "Something looks off — your battery voltage is higher than the solar by over 5V.";
        }

        // Fetch all users
        $users = [];
        $result = $conn->query("SELECT id, contact_number FROM users");
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }

        // Insert notifications, assign to users, AND publish MQTT SMS payload for the ESP32 to send
        foreach ($notifications as $msg) {
            // 1) insert notification
            $stmt = $conn->prepare("INSERT INTO notifications (message) VALUES (?)");
            $stmt->bind_param("s", $msg);
            $stmt->execute();
            $notification_id = $stmt->insert_id;
            $stmt->close();

            // 2) assign to users & publish SMS request for each user
            foreach ($users as $user) {
                // Insert user_notification
                $stmt = $conn->prepare("INSERT INTO user_notifications (user_id, notification_id) VALUES (?, ?)");
                $stmt->bind_param("ii", $user['id'], $notification_id);
                $stmt->execute();
                $stmt->close();

                // Prepare SMS payload and publish via MQTT
                $rawNumber = $user['contact_number'];
                $formatted = formatPHNumber($rawNumber);
                if (!empty($formatted)) {
                    // Payload format: number|message
                    $smsPayload = $formatted . "|" . $msg;
                    // Make sure MQTT client is available and connected
                    if ($mqtt && $mqtt->connect(true, NULL, NULL, NULL)) {
                        // publish and keep connection (some phpMQTT versions require re-connecting before publish)
                        $mqtt->publish("system/sms/send", $smsPayload, 0);
                        // Do not close here; the main loop will handle lifecycle
                        echo "[" . date('Y-m-d H:i:s') . "] MQTT SMS published to {$formatted}: {$msg}\n";
                        // Optionally sleep briefly to avoid flooding
                        usleep(100000); // 100ms
                    } else {
                        // If connect failed, just log — main loop should handle reconnect
                        echo "[" . date('Y-m-d H:i:s') . "] MQTT not connected; failed to publish SMS for {$formatted}\n";
                    }
                }
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
// Connect to MQTT broker and run
// -----------------------------
if ($mqtt->connect(true, NULL, NULL, NULL)) {
    echo "[" . date('Y-m-d H:i:s') . "] Connected to MQTT broker\n";

    $mqtt->subscribe($topics);

    // phpMQTT loop
    while ($mqtt->proc()) {
        // proc() handles incoming messages and will call handleMessage()
        usleep(100000);
    }

    $mqtt->close();
} else {
    echo "[" . date('Y-m-d H:i:s') . "] Failed to connect to MQTT broker\n";
}

$conn->close();
