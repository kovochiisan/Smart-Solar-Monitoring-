<?php
include 'config.php';

$state = isset($_POST['state']) ? intval($_POST['state']) : 0;

$query = "UPDATE control_load SET state=$state WHERE load_name='MainLoad'";
if(mysqli_query($conn, $query)) {
    echo json_encode(['success' => true, 'state' => $state]);
} else {
    echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
}
?>
