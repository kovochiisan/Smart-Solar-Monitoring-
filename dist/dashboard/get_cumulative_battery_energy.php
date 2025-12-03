<?php
$conn = new mysqli("localhost", "root", "", "smart_solar");
if ($conn->connect_error) die("DB connection failed");

$sql = "SELECT battery_power, reading_time 
        FROM sensor_reading 
        WHERE DATE(reading_time) = CURDATE() 
        ORDER BY reading_time";

$result = $conn->query($sql);

$cumulative = 0;
$prev_time = null;

$interval_minutes = 10;
$interval_bucket = []; // store cumulative per 10-min bucket

while ($row = $result->fetch_assoc()) {
    $time = strtotime($row['reading_time']);

    if ($prev_time !== null) {
        $delta = $time - $prev_time;

        // cap delta between readings to avoid huge gaps
        $delta = min($delta, 3600);

        // compute Wh added
        $energy_wh = ($row['battery_power'] * $delta) / 3600;
        $cumulative += $energy_wh;
    }

    // 10-min interval key: e.g., 08:00, 08:10, 08:20, etc.
    $minute = floor(date('i', $time) / $interval_minutes) * $interval_minutes;
    $bucket_key = date('H', $time) . ':' . str_pad($minute, 2, '0', STR_PAD_LEFT);

    // store the last reading in this bucket
    $interval_bucket[$bucket_key] = round($cumulative, 2);

    $prev_time = $time;
}

echo json_encode([
    "labels" => array_keys($interval_bucket),
    "data" => array_values($interval_bucket)
]);
?>
