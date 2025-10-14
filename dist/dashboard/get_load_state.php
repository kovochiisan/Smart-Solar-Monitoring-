<?php
include 'config.php'; // Use your connection file

$query = "SELECT state FROM control_load WHERE load_name='MainLoad'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

echo json_encode(['state' => $row['state']]);
?>
