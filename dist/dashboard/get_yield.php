<?php
header('Content-Type: application/json');

$conn = new mysqli("localhost", "username", "password", "smart_solar");

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "DB Connection failed"]);
    exit;
}

$sql = "SELECT SUM(solar_power * 0.0000005556) AS total_yield_kWh FROM sensor_reading";
$result = $conn->query($sql);

$total_yield = 0;
if ($result && $row = $result->fetch_assoc()) {
    $total_yield = $row['total_yield_kWh']; // no rounding
}

$conn->close();

echo json_encode(["success" => true, "total_yield_kWh" => $total_yield]);
?>
