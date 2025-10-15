<?php
include 'config.php';
session_start();

$state = isset($_POST['state']) ? intval($_POST['state']) : 0;

// Get the current user's name from session
$user_name = isset($_SESSION['full_name']) ? $_SESSION['full_name'] : 'Unknown User';

// 1️⃣ Update the control_load table
$query = "UPDATE control_load SET state = $state WHERE load_name = 'MainLoad'";
if (mysqli_query($conn, $query)) {

    // 2️⃣ Create a new notification message including the user
    $message = $state 
        ? "Load has been turned ON by $user_name" 
        : "Load has been turned OFF by $user_name";

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

    echo json_encode(['success' => true, 'state' => $state]);
} else {
    echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
}
?>
