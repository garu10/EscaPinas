<?php
session_start();
include_once("../../../../frontend/php/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // collect the form data and sanitize
    $title            = trim(mysqli_real_escape_string($conn, $_POST['title']));
    $code             = trim(mysqli_real_escape_string($conn, $_POST['code']));
    $system_type      = mysqli_real_escape_string($conn, $_POST['System_type']);
    $discount_type    = mysqli_real_escape_string($conn, $_POST['discount_type']);
    $discount_amount  = floatval($_POST['discount_amount']);
    $min_order_amount = floatval($_POST['min_order_amount']);
    $expires_at       = mysqli_real_escape_string($conn, $_POST['expires_at']);

    // for error catching 
    $errors = [];

    // chechk required fields
    if (empty($title) || empty($code) || empty($expires_at)) {
        $errors[] = "All required fields must be filled.";
    }

    // check if discount amount is greater than zero
    if ($discount_amount <= 0) {
        $errors[] = "Discount amount must be greater than zero.";
    }

    // prevent past expiry dates
    if (strtotime($expires_at) < strtotime(date('Y-m-d'))) {
        $errors[] = "Expiry date cannot be in the past.";
    }

    // check for duplicate voucher code
    $checkCode = mysqli_query($conn, "SELECT code FROM voucher_templates WHERE code = '$code' LIMIT 1");
    if (mysqli_num_rows($checkCode) > 0) {
        $errors[] = "The voucher code '$code' already exists.";
    }

    //handle errors if any
    if (!empty($errors)) {
        // redirect back with the first error found
        $errorMessage = urlencode($errors[0]);
        header("Location: ../../../adminDashboard.php?page=adminVouchers&status=error&msg=$errorMessage");
        exit();
    }

    $sql = "INSERT INTO voucher_templates (
                code, 
                discount_type, 
                discount_amount, 
                min_order_amount, 
                expires_at, 
                System_type, 
                title, 
                created_at
            ) VALUES (
                '$code', 
                '$discount_type', 
                $discount_amount, 
                $min_order_amount, 
                '$expires_at', 
                '$system_type', 
                '$title', 
                NOW()
            )";

    try {
        if (mysqli_query($conn, $sql)) {
            header("Location: ../../../adminDashboard.php?page=adminVouchers&status=success&msg=Voucher+Created+Successfully");
        } else {
            throw new Exception(mysqli_error($conn));
        }
    } catch (Exception $e) {
        $error = urlencode("Database Error: " . $e->getMessage());
        header("Location: ../../../adminDashboard.php?page=adminVouchers&status=error&msg=$error");
    }
    exit();
} else {
    header("Location: ../../../adminDashboard.php?page=adminVouchers");
    exit();
}
