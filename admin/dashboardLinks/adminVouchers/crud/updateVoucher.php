<?php
session_start();
include_once("../../../../frontend/php/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_voucher'])) {
    
    // cololect the form data and sanitize
    $id               = intval($_POST['voucher_id']);
    $title            = trim(mysqli_real_escape_string($conn, $_POST['title']));
    $code             = trim(mysqli_real_escape_string($conn, $_POST['code']));
    $system_type      = mysqli_real_escape_string($conn, $_POST['system_type']);
    $discount_type    = mysqli_real_escape_string($conn, $_POST['discount_type']);
    $discount_amount  = floatval($_POST['discount_amount']);
    $min_order_amount = floatval($_POST['min_spend']);
    $expires_at       = mysqli_real_escape_string($conn, $_POST['expires_at']);
    // for error catching
    $errors = [];

    if (empty($title) || empty($code)) {
        $errors[] = "Title and Code cannot be empty.";
    }
    // check the code is unique
    $checkCode = mysqli_query($conn, "SELECT voucher_id FROM voucher_templates WHERE code = '$code' AND voucher_id != $id");
    if (mysqli_num_rows($checkCode) > 0) {
        $errors[] = "The voucher code '$code' is already being used by another template.";
    }

    if (!empty($errors)) {
        header("Location: ../../../adminDashboard.php?page=adminVouchers&status=error&msg=" . urlencode($errors[0]));
        exit();
    }
    // update query
    $sql = "UPDATE voucher_templates SET 
                title = '$title',
                code = '$code',
                System_type = '$system_type',
                discount_type = '$discount_type',
                discount_amount = $discount_amount,
                min_order_amount = $min_order_amount,
                expires_at = '$expires_at'
            WHERE voucher_id = $id";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../../../adminDashboard.php?page=adminVouchers&status=success&msg=Voucher+Updated");
    } else {
        header("Location: ../../../adminDashboard.php?page=adminVouchers&status=error&msg=" . urlencode(mysqli_error($conn)));
    }
    exit();
}