<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include '../../php/connect.php';

// 1. Ensure this IP matches your MacBook's current IP
// 2. Ensure users1.php is the filename on the other project
$externalUrl = "http://192.168.1.16:8080/BookStack/api/users.php"; 

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $externalUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

$json_data = curl_exec($ch);

if (curl_errno($ch)) {
    echo json_encode(["status" => "error", "message" => "Connection failed: " . curl_error($ch)]);
    exit;
}
curl_close($ch);

$externalUsers = json_decode($json_data, true);

if (!empty($externalUsers) && is_array($externalUsers)) {
    $count = 0;
    $errors = 0;

    foreach ($externalUsers as $user) {
        // Match the keys exactly as they are returned by users1.php
        $username = mysqli_real_escape_string($conn, $user['username']);
        $email    = mysqli_real_escape_string($conn, $user['email']);
        
        // Note: users1.php returns it as 'password', NOT 'password_hash'
        $pass     = mysqli_real_escape_string($conn, $user['password']);
        $role     = mysqli_real_escape_string($conn, $user['role']); 

        // SQL updated to use 'password' column to match your users table
        $sql = "INSERT INTO users (username, email, password, role) 
                VALUES ('$username', '$email', '$pass', '$role')
                ON DUPLICATE KEY UPDATE 
                password = '$pass', 
                role = '$role'";

        if (mysqli_query($conn, $sql)) {
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
    echo json_encode(["status" => "error", "message" => "No data found or URL incorrect."]);
}
?>