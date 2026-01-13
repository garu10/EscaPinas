<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once __DIR__ . "/../php/connect.php"; 

header('Content-Type: application/json');
$uid = $_SESSION['user_id'] ?? null;
$pid = $_POST['payment_id'] ?? null;

if (!$uid || !$pid) {
    echo json_encode(['status' => 'error', 'message' => 'Session expired or missing ID']);
    exit;
}

if (!isset($conn)) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection variable not found']);
    exit;
}

$pid = mysqli_real_escape_string($conn, $pid);
$query = "SELECT amount, booking_id FROM payments WHERE payment_id = '$pid' AND user_id = '$uid' AND payment_status = 'COMPLETED'";
$res = mysqli_query($conn, $query);

if (!$res) {
    echo json_encode(['status' => 'error', 'message' => 'Query Failed: ' . mysqli_error($conn)]);
    exit;
}

$payment = mysqli_fetch_assoc($res);

if ($payment) {
    $amount = $payment['amount'];
    $bid = $payment['booking_id'];

    mysqli_begin_transaction($conn);

    try {
        mysqli_query($conn, "UPDATE payments SET payment_status = 'REFUNDED' WHERE payment_id = '$pid'");
        
        mysqli_query($conn, "UPDATE bookings SET booking_status = 'Cancelled' WHERE booking_id = '$bid'");

        $walletQuery = "INSERT INTO refund_wallet (user_id, balance) VALUES ('$uid', '$amount') 
                        ON DUPLICATE KEY UPDATE balance = balance + $amount";
        
        if (!mysqli_query($conn, $walletQuery)) {
            throw new Exception("Wallet Update Failed: " . mysqli_error($conn));
        }

        mysqli_commit($conn);
        echo json_encode(['status' => 'success']);
    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No eligible payment found or already refunded']);
}