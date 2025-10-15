<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch notifications for the current user
$stmt = $conn->prepare("
    SELECT un.id AS user_notification_id, n.id AS notification_id, n.message, n.icon, n.time_stamp, un.is_read
    FROM user_notifications un
    JOIN notifications n ON n.id = un.notification_id
    WHERE un.user_id = ?
    ORDER BY n.time_stamp DESC
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$notifications = [];
while ($row = $result->fetch_assoc()) {
    $notifications[] = $row;
}

echo json_encode(['success' => true, 'notifications' => $notifications]);

$stmt->close();
$conn->close();
?>
