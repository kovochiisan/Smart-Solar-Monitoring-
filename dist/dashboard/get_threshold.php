<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "smart_solar");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the current battery threshold
$sql = "SELECT value FROM battery_threshold WHERE threshold_name = 'MainBattery' LIMIT 1";
$result = $conn->query($sql);
$thresholdValue = 100; // default

if ($result && $row = $result->fetch_assoc()) {
    $thresholdValue = $row['value'];
}
?>
