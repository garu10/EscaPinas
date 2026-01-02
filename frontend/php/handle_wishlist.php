<!-- backend to nung wishlist function -->
<?php
session_start();
include 'connect.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || !isset($_POST['tour_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit;
}

$uid = $_SESSION['user_id'];
$tid = (int)$_POST['tour_id'];

// chinecheck dine if existing na yung tour dun sa wishlist
$check = executeQuery("SELECT * FROM wishlist WHERE user_id = $uid AND tour_id = $tid");

if (mysqli_num_rows($check) > 0) {
    // delete query para maremove sa wishlist yung tour
    $query = "DELETE FROM wishlist WHERE user_id = $uid AND tour_id = $tid";
    executeQuery($query);
    echo json_encode(['status' => 'removed']);
} else {
    // insert query para maadd sa wishlist yung tour
    $query = "INSERT INTO wishlist (user_id, tour_id) VALUES ($uid, $tid)";
    executeQuery($query);
    echo json_encode(['status' => 'added']);
}