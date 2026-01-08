<?php
// Prevent any PHP errors from showing up as HTML, which breaks JSON
// error_reporting(0); 
// ini_set('display_errors', 0);
session_start();
$conn_path = __DIR__ . "/../php/connect.php";

header('Content-Type: application/json');

if (!file_exists($conn_path)) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection file missing']);
    exit;
}
require_once($conn_path);
// check if tama ba yung variable ng connection dun sa db (connect.php)
if (!isset($conn)) {
    echo json_encode(['status' => 'error', 'message' => 'Connection variable $conn not found']);
    exit;
}
// check if nakalogin na ba yung user
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Please log in first']);
    exit;
}

$uid = $_SESSION['user_id'];
$tid = isset($_POST['tour_id']) ? (int)$_POST['tour_id'] : 0;

if ($tid <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid Tour ID']);
    exit;
}

// chinecheck dine if existing na yung tour dun sa wishlist
$check_query = "SELECT * FROM wishlist WHERE user_id = $uid AND tour_id = $tid";
$check_result = mysqli_query($conn, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    // delete query para maremove sa wishlist yung tour if nage-exists na
    $delete = "DELETE FROM wishlist WHERE user_id = $uid AND tour_id = $tid";
    if (mysqli_query($conn, $delete)) {
        echo json_encode(['status' => 'removed']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Delete failed']);
    }
} else {
    // insert query para maadd sa wishlist yung tour
    $insert = "INSERT INTO wishlist (user_id, tour_id) VALUES ($uid, $tid)";
    if (mysqli_query($conn, $insert)) {
        echo json_encode(['status' => 'added']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Insert failed']);
    }
}
exit;