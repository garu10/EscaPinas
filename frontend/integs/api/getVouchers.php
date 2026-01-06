<?php
header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8");
include '../../php/connect.php'; 

// ito ay if tayo ang maglalagay ng vouchers then kukunin nila adrian
$query = "SELECT code, discount_type, discount_amount, min_order_amount, expires_at 
          FROM vouchers 
          WHERE external_system = 'travel_agency' 
          AND is_redeemed = FALSE 
          AND expires_at > NOW() 
          LIMIT 10";

$result = mysqli_query($conn, $query);
$vouchers = [];

while ($row = mysqli_fetch_assoc($result)) {
    $vouchers[] = [
        "title" => "EscaPinas Discount",
        "code"  => $row['code'],
        "type"  => $row['discount_type'],
        "amount" => $row['discount_amount'],
        "min_spend" => $row['min_order_amount'],
        "expiry" => $row['expires_at'],
        "provider" => "travel_agency"
    ];
}

echo json_encode($vouchers);