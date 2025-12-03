<?php
// delete_readings.php

// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$db   = "smart_solar";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_POST['selected_readings'])) {
        $ids = explode(',', $_POST['selected_readings']);
        $ids = array_map('intval', $ids);
        $ids_str = implode(',', $ids);
        $sql = "DELETE FROM sensor_reading WHERE id IN ($ids_str)";
    } else {
        $start_date = $_POST['start_date'] ?? date('Y-m-d');
        $end_date   = $_POST['end_date'] ?? date('Y-m-d');
        $start_time = $_POST['start_time'] ?? '00:00:00';
        $end_time   = $_POST['end_time'] ?? '23:59:59';
        $start_datetime = $conn->real_escape_string("$start_date $start_time");
        $end_datetime   = $conn->real_escape_string("$end_date $end_time");
        $sql = "DELETE FROM sensor_reading WHERE reading_time BETWEEN '$start_datetime' AND '$end_datetime'";
    }

    if ($conn->query($sql) === TRUE) {
        // Simply return a success response for your JS
        echo 'success';
    } else {
        http_response_code(500);
        echo "Error deleting records: " . $conn->error;
    }
}

$conn->close();
