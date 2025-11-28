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
$prev_soc = null;

while($row = $result->fetch_assoc()){
    $data['time'][] = date('H:i:s', strtotime($row['reading_time']));
    
    // Battery discharge is just battery_power
    $data['discharge'][] = $row['battery_power'];

    // Battery charge calculated from SOC increase
    if($prev_soc !== null){
        $soc_diff = $row['battery_soc'] - $prev_soc;
        $data['charge'][] = $soc_diff > 0 ? $soc_diff : 0;
    } else {
        $data['charge'][] = 0;
    }
    $prev_soc = $row['battery_soc'];
}

echo json_encode($data);
$conn->close();
?>
