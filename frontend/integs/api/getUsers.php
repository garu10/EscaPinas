<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include '../../php/connect.php';
$externalUrl = "http://192.168.1.15/api/getUsers.php"; // ito need palitan ng tamang URL ng external system

$json_data = @file_get_contents($externalUrl);

if ($json_data === FALSE) {
    echo json_encode(["status" => "error", "message" => "Could not connect to External API."]);
    exit;
}

$externalUsers = json_decode($json_data, true);

if (!empty($externalUsers) && is_array($externalUsers)) {
    $count = 0;
    $errors = 0;

    foreach ($externalUsers as $user) {
        // 1. Sanitize the data from the external source
        $username = mysqli_real_escape_string($conn, $user['username']);
        $email    = mysqli_real_escape_string($conn, $user['email']);
        $hash     = mysqli_real_escape_string($conn, $user['password_hash']);
        $role     = mysqli_real_escape_string($conn, $user['role']); 

        
        $sql = "INSERT INTO users (username, email, password_hash, role) 
                VALUES ('$username', '$email', '$hash', '$role')
                ON DUPLICATE KEY UPDATE 
                password_hash = '$hash', 
                role = '$role'";

        if (executeQuery( $sql)) {
            $count++; 
        } else {
            $errors++;
        }
    }

    echo json_encode([
        "status" => "success", 
        "message" => "$count users synced successfully.",
        "failed" => $errors
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "No data received or invalid JSON format."]);
}
?>