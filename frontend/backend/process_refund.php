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
// mga binago ko (ralph)
    try {
        // 1. Mark payment as refunded
        mysqli_query($conn, "UPDATE payments SET payment_status = 'REFUNDED' WHERE payment_id = '$pid'");
        
        // 2. Cancel the booking
        mysqli_query($conn, "UPDATE bookings SET booking_status = 'Cancelled' WHERE booking_id = '$bid'");

        // 3. Get the LATEST balance for this user to calculate the new running balance
        $currentBalanceQuery = "SELECT running_balance FROM refund_wallet WHERE user_id = '$uid' ORDER BY updated_at DESC LIMIT 1";
        $balanceRes = mysqli_query($conn, $currentBalanceQuery);
        $row = mysqli_fetch_assoc($balanceRes);
        $oldBalance = $row ? $row['running_balance'] : 0;
        $newBalance = $oldBalance + $amount;

        // 4. Insert NEW row for history (Ledger Style)
        // Note: We use the columns we added: amount, type, description, and running_balance
        $description = "Refund for Booking #" . $bid;
        $walletQuery = "INSERT INTO refund_wallet (user_id, amount, type, description, running_balance) 
                        VALUES ('$uid', '$amount', 'Refund', '$description', '$newBalance')";
// mga binago ko (ralph)
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