<?php
session_start();
include '../../php/connect.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['v_code']) && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    $code    = mysqli_real_escape_string($conn, $_POST['v_code']);
    $type    = mysqli_real_escape_string($conn, $_POST['v_type']);
    $amount  = mysqli_real_escape_string($conn, $_POST['v_amount']);
    $min     = mysqli_real_escape_string($conn, $_POST['v_min'] ?? 0);
    $expiry  = mysqli_real_escape_string($conn, $_POST['v_expiry']);
    $system  = mysqli_real_escape_string($conn, $_POST['v_system']);

    $check_query = "SELECT voucher_id FROM vouchers WHERE user_id = '$user_id' AND code = '$code'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "already_claimed"; 
        exit();
    }

    $sql = "INSERT INTO vouchers (
                user_id, 
                external_system, 
                code, 
                discount_type, 
                discount_amount, 
                min_order_amount, 
                expires_at, 
                is_redeemed
            ) VALUES (
                '$user_id', 
                '$system', 
                '$code', 
                '$type', 
                '$amount', 
                '$min', 
                '$expiry', 
                0
            )";

    if (mysqli_query($conn, $sql)) {
        echo "success"; 
    } else {
        echo "error";
    }
} else {
    echo "invalid_request";
}
exit();