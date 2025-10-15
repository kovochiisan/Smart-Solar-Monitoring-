<?php
include 'config.php';
session_start();

// Get the threshold value from POST
$value = isset($_POST['value']) ? intval($_POST['value']) : 100;

// Get the current user's name from session
$user_name = isset($_SESSION['full_name']) ? $_SESSION['full_name'] : 'Unknown User';

// 1️⃣ Update the battery_threshold table
$query = "UPDATE battery_threshold SET value=$value WHERE threshold_name='MainBattery'";
if(mysqli_query($conn, $query)) {

    // 2️⃣ Create a notification message
    $message = "Battery threshold has been updated to $value% by $user_name";

    $stmt = $conn->prepare("INSERT INTO notifications (message) VALUES (?)");
    $stmt->bind_param("s", $message);
    $stmt->execute();
    $notification_id = $stmt->insert_id;
    $stmt->close();

    // 3️⃣ Assign notification to all users (unread)
    $users = $conn->query("SELECT id FROM users");
    while ($user = $users->fetch_assoc()) {
        $uid = $user['id'];
        $conn->query("INSERT INTO user_notifications (user_id, notification_id, is_read) VALUES ($uid, $notification_id, 0)");
    }

    echo json_encode(['success' => true, 'value' => $value]);

} else {
    echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
}
?>
