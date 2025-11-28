<?php
$conn = new mysqli("localhost", "root", "", "smart_solar");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$today = date('Y-m-d');

$sql = "
    SELECT HOUR(reading_time) AS hour, AVG(battery_power) AS avg_load
    FROM sensor_reading
    WHERE DATE(reading_time) = '$today'
    GROUP BY HOUR(reading_time)
    ORDER BY hour
";

$res = $conn->query($sql);
$hourly = array_fill(0, 24, 0); // default 0 for missing hours

while($row = $res->fetch_assoc()){
    $hourly[(int)$row['hour']] = round($row['avg_load'], 2);
}

echo json_encode($hourly);
?>
