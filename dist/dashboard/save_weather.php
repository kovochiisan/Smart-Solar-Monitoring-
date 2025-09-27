<?php
// save_weather.php
header('Content-Type: application/json');

// Database credentials
$host = "localhost";
$db   = "smart_solar";
$user = "root"; // change if needed
$pass = "";     // change if needed

// Connect to MySQL
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => $conn->connect_error]);
    exit;
}

// Get POST data
$temperature = isset($_POST['temperature']) ? floatval($_POST['temperature']) : null;

if ($temperature === null) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Temperature is required"]);
    exit;
}

// Insert into database
$stmt = $conn->prepare("INSERT INTO weather_history (time, temperature) VALUES (NOW(), ?)");
$stmt->bind_param("d", $temperature);

if ($stmt->execute()) {
    echo json_encode(["status" => "success"]);
} else {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
