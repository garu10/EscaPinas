<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include '../../php/connect.php';

// Select all users
$query = "SELECT username, email, password, role  FROM users";
$result = executeQuery($query);

$users = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
    
    http_response_code(200);
    echo json_encode($users);
} else { // error handling
    http_response_code(500);
    echo json_encode(["error" => mysqli_error($conn)]);
}
?>