<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include '../../php/connect.php';

$query = "SELECT user_id, username, email, password, role FROM users";
$result = executeQuery($query);

$users = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
    http_response_code(200);
    echo json_encode($users);
} else {
    http_response_code(500);
    echo json_encode(["error" => mysqli_error($conn)]);
}
