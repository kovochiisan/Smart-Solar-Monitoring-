<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id']) || !isset($_POST['user_notification_id'])) {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
    exit;
}

$user_id = $_SESSION['user_id'];
$user_notification_id = intval($_POST['user_notification_id']);

$stmt = $conn->prepare("
    UPDATE user_notifications
    SET is_read = 1
    WHERE id = ? AND user_id = ?
");
$stmt->bind_param("ii", $user_notification_id, $user_id);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'No rows updated']);
    }
} else {
    echo json_encode(['success' => false, 'error' => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
