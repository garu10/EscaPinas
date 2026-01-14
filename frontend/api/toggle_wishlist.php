<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
    exit;
}

session_start();
include("../php/connect.php");

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'Please log in first']);
    exit;
}

$uid = $_SESSION['user_id'];
$tid = isset($_POST['tour_id']) ? (int)$_POST['tour_id'] : 0;

if ($tid <= 0) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Invalid Tour ID']);
    exit;
}

// Check if tour exists in wishlist
$check_query = "SELECT * FROM wishlist WHERE user_id = $uid AND tour_id = $tid";
$check_result = mysqli_query($conn, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    // Remove from wishlist
    $delete = "DELETE FROM wishlist WHERE user_id = $uid AND tour_id = $tid";
    if (mysqli_query($conn, $delete)) {
        echo json_encode(['status' => 'removed']);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Delete failed']);
    }
} else {
    // Add to wishlist
    $insert = "INSERT INTO wishlist (user_id, tour_id) VALUES ($uid, $tid)";
    if (mysqli_query($conn, $insert)) {
        echo json_encode(['status' => 'added']);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Insert failed']);
    }
}
?>