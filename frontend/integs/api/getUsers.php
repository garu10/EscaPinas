<?php
include '../../php/connect.php';

// ip address nina Adrian
$adrian_url = "http://192.168.0.XXX/path_to_adrian_api/echo_users.php"; 

// get the data from Adrian's API
$json_data = file_get_contents($adrian_url);
$adrian_users = json_decode($json_data, true);

if (!empty($adrian_users)) {
    $count = 0;
    foreach ($adrian_users as $user) {
        $name = mysqli_real_escape_string($conn, $user['username']);
        $email = mysqli_real_escape_string($conn, $user['email']);
        $hash = mysqli_real_escape_string($conn, $user['password_hash']);

        // inserting to the local database, update if email exists
        $sql = "INSERT INTO users (username, email, password_hash, role) 
                VALUES ('$name', '$email', '$hash', 'user')
                ON DUPLICATE KEY UPDATE 
                user_name = '$name', 
                password_hash = '$hash'";

        if (mysqli_query($conn, $sql)) {
            $count++;
        }
    }
    echo json_encode(["status" => "success", "message" => "$count users synced via Email."]);
} else {
    echo json_encode(["status" => "error", "message" => "No data received from Adrian."]);
}

