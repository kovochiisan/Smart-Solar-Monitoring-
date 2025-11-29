<?php
session_start();
require_once "config.php"; // DB connection
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success"=>false,"message"=>"Not logged in"]);
    exit;
}

$userId = $_SESSION['user_id'];
$email = trim($_POST['email'] ?? '');
$fullname = trim($_POST['fullname'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$dob = trim($_POST['dob'] ?? '');
$address = trim($_POST['address'] ?? '');
$password = trim($_POST['password'] ?? '');
$profileImage = $_FILES['profile_image'] ?? null;

$errors = [];

// Email validation (allow empty, but if filled must be valid)
if($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)){
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

// Convert empty strings to NULL or 'N/A'
$email = $email ?: null;
$fullname = $fullname ?: null;
$phone = $phone ?: null;
$dob = $dob ?: null;
$address = $address ?: null;

// Build SQL dynamically
$sql = "UPDATE users SET email=?, full_name=?, contact_number=?, date_of_birth=?, address=?";
$params = [$email, $fullname, $phone, $dob, $address];

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

// Prepare and execute
$stmt = $conn->prepare($sql);

// Bind parameters dynamically
$types = str_repeat('s', count($params)-1) . 'i'; // all strings + last id integer
$stmt->bind_param($types, ...$params);

if($stmt->execute()){
    if($email) $_SESSION['email'] = $email; // update session email if changed
    echo json_encode(["success"=>true,"message"=>"Profile updated successfully"]);
} else {
    echo json_encode(["success"=>false,"message"=>"Failed to update profile"]);
}

?>
