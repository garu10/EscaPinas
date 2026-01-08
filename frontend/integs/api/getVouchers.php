<?php // api ito na ibato ng voucher templates na hindi pa expired  sa ibang user
    // parang endpoint lang ito 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include '../../php/connect.php';

$query = "SELECT * FROM voucher_templates WHERE expires_at > NOW()";

$result = mysqli_query($conn, $query);
$vouchers = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Use the actual column names from your database
        $vouchers[] = [
            "title"    => "EscaPinas Discount",
            "code"     => $row['code'],
            "type"     => $row['discount_type'],
            "amount"   => $row['discount_amount'],
            "min_spend"=> $row['min_order_amount'],
            "expiry"   => $row['expires_at'],
            "provider" => $row['system_type'] ?? 'unknown' 
        ];
    }
} else {
    // If the query fails, show the error
    echo json_encode(["error" => mysqli_error($conn)]);
    exit;
}

echo json_encode($vouchers);