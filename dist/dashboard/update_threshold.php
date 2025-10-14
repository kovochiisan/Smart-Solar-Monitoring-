<?php
include 'config.php';

$value = isset($_POST['value']) ? intval($_POST['value']) : 100;

$query = "UPDATE battery_threshold SET value=$value WHERE threshold_name='MainBattery'";
if(mysqli_query($conn, $query)) {
    echo json_encode(['success' => true, 'value' => $value]);
} else {
    echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
}
?>
