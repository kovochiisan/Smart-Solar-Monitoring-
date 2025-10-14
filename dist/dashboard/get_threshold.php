<?php
include 'config.php';

$query = "SELECT value FROM battery_threshold WHERE threshold_name='MainBattery'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

echo json_encode(['value' => $row['value']]);
?>
