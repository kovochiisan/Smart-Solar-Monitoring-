<?php
header('Content-Type: application/json');
$conn = new mysqli("localhost", "root", "", "smart_solar");
if ($conn->connect_error) die(json_encode(['error' => 'DB connection failed']));

// Fetch readings for today
$sql = "SELECT reading_time, battery_soc, battery_power
        FROM sensor_reading
        WHERE DATE(reading_time) = CURDATE()
        ORDER BY reading_time ASC";
$result = $conn->query($sql);

$data = ['time'=>[], 'charge'=>[], 'discharge'=>[]];
$interval = 600; // 10 minutes in seconds
$bucket_start = null;
$bucket_charge = 0;
$bucket_discharge = 0;
$prev_soc = null;

while($row = $result->fetch_assoc()){
    $time = strtotime($row['reading_time']);

    if ($prev_soc !== null){
        $soc_diff = $row['battery_soc'] - $prev_soc;
        $bucket_charge += $soc_diff > 0 ? $soc_diff : 0;
    }
    $bucket_discharge += $row['battery_power'];
    $prev_soc = $row['battery_soc'];

    if ($bucket_start === null) $bucket_start = $time;

    // Check if 10 min passed
    if (($time - $bucket_start) >= $interval){
        $data['time'][] = date('H:i', $bucket_start);
        $data['charge'][] = round($bucket_charge, 2);
        $data['discharge'][] = round($bucket_discharge, 2);

        // Reset bucket
        $bucket_start = $time;
        $bucket_charge = 0;
        $bucket_discharge = 0;
    }
}

// Add last bucket if any
if ($bucket_charge > 0 || $bucket_discharge > 0){
    $data['time'][] = date('H:i', $bucket_start);
    $data['charge'][] = round($bucket_charge, 2);
    $data['discharge'][] = round($bucket_discharge, 2);
}

echo json_encode($data);
$conn->close();
?>
