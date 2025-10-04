<?php
session_start();
require_once "config.php"; // DB connection
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success"=>false,"message"=>"Not logged in"]);
    exit;
}

$userId = $_SESSION['user_id'];
$email = $_POST['email'] ?? '';
$fullname = $_POST['fullname'] ?? '';
$phone = $_POST['phone'] ?? '';
$dob = $_POST['dob'] ?? '';
$address = $_POST['address'] ?? '';
$password = $_POST['password'] ?? '';
$profileImage = $_FILES['profile_image'] ?? null;

$errors = [];

// Email validation
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email address";
}

// Password validation
if (!empty($password) && strlen($password) < 6) {
    $errors[] = "Password must be at least 6 characters";
}

if($errors){
    echo json_encode(["success"=>false,"message"=>implode(", ", $errors)]);
    exit;
}

// Handle profile image upload
$profileImagePath = null;
if($profileImage && $profileImage['error'] === UPLOAD_ERR_OK){
    $originalName = pathinfo($profileImage['name'], PATHINFO_FILENAME);
    $ext = pathinfo($profileImage['name'], PATHINFO_EXTENSION);
    $allowed = ['jpg','jpeg','png','gif'];

    if(!in_array(strtolower($ext), $allowed)){
        echo json_encode(["success"=>false,"message"=>"Invalid image type"]);
        exit;
    }

    $safeName = preg_replace("/[^a-zA-Z0-9_-]/", "", $originalName);
    $newFileName = 'uploads/' . $safeName . '_' . $userId . '_' . time() . '.' . $ext;

    if(!move_uploaded_file($profileImage['tmp_name'], '../' . $newFileName)){
        echo json_encode(["success"=>false,"message"=>"Failed to upload image"]);
        exit;
    }

    $profileImagePath = $newFileName;
}

// Update DB
$params = [$email, $fullname, $phone, $dob, $address];
$sql = "UPDATE users SET email=?, full_name=?, contact_number=?, date_of_birth=?, address=?";

if(!empty($password)){
    $sql .= ", password=?";
    $params[] = password_hash($password, PASSWORD_DEFAULT);
}

if($profileImagePath){
    $sql .= ", profile_image=?";
    $params[] = $profileImagePath;
}

$sql .= " WHERE id=?";
$params[] = $userId;

$stmt = $conn->prepare($sql);
if($stmt->execute($params)){
    $_SESSION['email'] = $email; // update session email
    echo json_encode(["success"=>true,"message"=>"Profile updated successfully"]);
} else {
    echo json_encode(["success"=>false,"message"=>"Failed to update profile"]);
}
?>
