<?php
// validate_voucher.php
session_start();
include_once "../../php/connect.php"; // Siguraduhin ang path patungo sa connect.php

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['voucher_code'])) {
    $code = trim($_POST['voucher_code']);
    $user_id = $_SESSION['user_id'];

    // I-check kung valid, hindi pa redeemed, at pag-aari ng user
    $stmt = $conn->prepare("SELECT discount_amount FROM vouchers WHERE code = ? AND user_id = ? AND is_redeemed = 0 LIMIT 1");
    $stmt->bind_param("si", $code, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo json_encode([
            'valid' => true,
            'discount_amount' => $row['discount_amount']
        ]);
    } else {
        echo json_encode([
            'valid' => false,
            'message' => 'Voucher is invalid or already used.'
        ]);
    }
}
?>