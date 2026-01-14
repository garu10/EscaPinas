<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include '../../php/connect.php';

// URL for Voucher API
$externalUrl = "http://192.168.1.15/EscaPinas\frontend\integs\api\sendVouchers.php"; // palitan na lang ito ng tamang URL ng external system

$json_data = @file_get_contents($externalUrl);

if ($json_data === FALSE) {
    echo json_encode(["status" => "error", "message" => "Could not connect to Voucher API."]);
    exit;
}

$externalVouchers = json_decode($json_data, true);

if (!empty($externalVouchers) && is_array($externalVouchers)) {
    $count = 0;

    foreach ($externalVouchers as $v) {
        $sys_type     = mysqli_real_escape_string($conn, $v['System_type']);
        $code         = mysqli_real_escape_string($conn, $v['code']);
        $title        = mysqli_real_escape_string($conn, $v['title']);
        $disc_type    = mysqli_real_escape_string($conn, $v['discount_type']);
        $disc_amount  = (float)$v['discount_amount'];
        $min_order    = (float)$v['min_order_amount'];
        $expires_at   = mysqli_real_escape_string($conn, $v['expires_at']);

        $sql = "INSERT INTO voucher_templates 
                (System_type, code, title, discount_type, discount_amount, min_order_amount, expires_at) 
                VALUES 
                ('$sys_type', '$code', '$title', '$disc_type', $disc_amount, $min_order, '$expires_at')
                ON DUPLICATE KEY UPDATE 
                title = '$title',
                discount_amount = $disc_amount,
                expires_at = '$expires_at'";

        if (executeQuery( $sql)) {
            $count++;
        }
    }

    echo json_encode([
        "status" => "success",
        "message" => "$count vouchers synced successfully."
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "No voucher data received."]);
}
