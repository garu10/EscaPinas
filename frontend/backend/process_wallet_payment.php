<?php
session_start();
include_once("../php/connect.php");

header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Please log in first']);
    exit;
}

$user_id = $_SESSION['user_id'];

// Get POST data
$tour_id = isset($_POST['tour_id']) ? intval($_POST['tour_id']) : 0;
$schedule_id = isset($_POST['schedule_id']) ? intval($_POST['schedule_id']) : 0;
$total_amount = isset($_POST['total_amount']) ? floatval($_POST['total_amount']) : 0;
$locpoints_id = isset($_POST['locpoints_id']) ? intval($_POST['locpoints_id']) : 0;
$voucher_code = isset($_POST['voucher_code']) ? trim($_POST['voucher_code']) : '';

if ($tour_id <= 0 || $schedule_id <= 0 || $total_amount <= 0 || $locpoints_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid payment data']);
    exit;
}

// Check wallet balance
$walletQuery = "SELECT running_balance FROM refund_wallet
                WHERE user_id = ? ORDER BY updated_at DESC LIMIT 1";
$walletStmt = $conn->prepare($walletQuery);
$walletStmt->bind_param("i", $user_id);
$walletStmt->execute();
$walletResult = $walletStmt->get_result();
$walletData = $walletResult->fetch_assoc();
$currentBalance = $walletData['running_balance'] ?? 0.00;

if ($currentBalance < $total_amount) {
    echo json_encode(['success' => false, 'message' => 'Insufficient wallet balance']);
    exit;
}

try {
    $conn->begin_transaction();

    // Generate booking reference
    $ref = 'WL-' . date('Ymd') . '-' . strtoupper(substr(md5(uniqid()), 0, 6));

    // Insert booking
    $bookingQuery = "INSERT INTO bookings (user_id, tour_id, schedule_id, locpoints_id, booking_status, total_amount, booking_reference)
                     VALUES (?, ?, ?, ?, 'confirmed', ?, ?)";
    $bookingStmt = $conn->prepare($bookingQuery);
    $bookingStmt->bind_param("iiiids", $user_id, $tour_id, $schedule_id, $locpoints_id, $total_amount, $ref);

    if (!$bookingStmt->execute()) {
        throw new Exception('Failed to create booking');
    }

    $booking_id = $conn->insert_id;

    // Insert payment record
    $paymentQuery = "INSERT INTO payments (booking_id, user_id, amount, payment_status)
                     VALUES (?, ?, ?, 'COMPLETED')";
    $paymentStmt = $conn->prepare($paymentQuery);
    $paymentStmt->bind_param("iid", $booking_id, $user_id, $total_amount);

    if (!$paymentStmt->execute()) {
        throw new Exception('Failed to record payment');
    }
    // Deduct from wallet balance (negative amount for payment)
    $debitAmount = -$total_amount; // Negative for debit
    $newBalance = $currentBalance + $debitAmount; // Subtract from balance

    $walletUpdateQuery = "INSERT INTO refund_wallet (user_id, amount, type, description, running_balance, updated_at)
                         VALUES (?, ?, 'Payment', ?, ?, NOW())";
    $walletStmt = $conn->prepare($walletUpdateQuery);
    $description = "Payment for booking #" . $ref;
    $walletStmt->bind_param("idss", $user_id, $debitAmount, $description, $newBalance);

    if (!$walletStmt->execute()) {
        throw new Exception('Failed to update wallet balance');
    }

    // Handle voucher if applied
    if (!empty($voucher_code)) {
        $voucherQuery = "UPDATE user_vouchers uv
                        JOIN voucher_templates vt ON uv.voucher_id = vt.voucher_id
                        SET uv.is_redeemed = 1, uv.redeemed_at = NOW()
                        WHERE uv.user_id = ? AND vt.code = ? AND uv.is_redeemed = 0";
        $voucherStmt = $conn->prepare($voucherQuery);
        $voucherStmt->bind_param("is", $user_id, $voucher_code);
        $voucherStmt->execute();
    }

    $conn->commit();

    echo json_encode([
        'success' => true,
        'message' => 'Payment completed successfully',
        'ref' => $ref,
        'booking_id' => $booking_id
    ]);

} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => 'Payment failed: ' . $e->getMessage()]);
}
?>