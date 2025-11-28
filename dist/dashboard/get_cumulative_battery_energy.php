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
$labels = [];
$data = [];

while ($row = $result->fetch_assoc()) {
    $time = strtotime($row['reading_time']);

    if ($prev_time !== null) {
        $delta = $time - $prev_time; // seconds between readings
        $delta_capped = min($delta, 3600); // cap at 3600 sec (1 hour)
        $energy_wh = ($row['battery_power'] * $delta_capped) / 3600; // W × seconds → Wh
        $cumulative += $energy_wh;
    }

    // Record cumulative per reading or per hour
    $hour = date('H:00', $time);
    $labels[] = $hour;
    $data[] = round($cumulative, 2); // cumulative Wh
    $prev_time = $time;
}

echo json_encode(['labels'=>$labels, 'data'=>$data]);
?>
