<?php
require_once "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $role = $_POST['role'] ?? null;

    if (!$id || !$role) {
        echo json_encode(['success' => false, 'error' => 'Missing parameters']);
        exit;
    }

    $stmt = $conn->prepare("UPDATE users SET role = ? WHERE id = ?");
    $stmt->bind_param("si", $role, $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    $stmt->close();
}
?>
