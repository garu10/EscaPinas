<?php
require_once "php/connect.php";

// Use the credentials found in your uploaded file
$clientId = "AR_ityCiAr_1l5CInno8S9b7EVE0xZMxuGTaky01nSU3vZUi4DH2UuKmQyCkVs-SDiDondbdcl8VZM4I";
$secret   = "EJtqCdoK7GXAlZi7RQAtEugsKQkD7ZmHCs7kJ23lGhed5mAfz9HdfU1CoaphjYrUAj1RyE-igi209atk";

function generateAccessToken($clientId, $secret) {
    $ch = curl_init("https://api-m.sandbox.paypal.com/v1/oauth2/token");
    curl_setopt_array($ch, [
        CURLOPT_HTTPHEADER => ["Accept: application/json", "Accept-Language: en_US"],
        CURLOPT_USERPWD => "$clientId:$secret",
        CURLOPT_POSTFIELDS => "grant_type=client_credentials",
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true
    ]);
    $response = curl_exec($ch);
    return json_decode($response, true)["access_token"];
}

/* ===== RECEIVE DATA FROM JS ===== */
$tour_id       = isset($_POST['tour_id']) ? (int)$_POST['tour_id'] : 0;
$pax           = isset($_POST['pax']) ? (int)$_POST['pax'] : 1;
// Note: Based on your previous code, these tables (region_fees, vouchers) were implied. 
// If they are not in your SQL dump, these values will default to 0.
$client_region = isset($_POST['client_region']) ? $_POST['client_region'] : '';
$voucher_code  = isset($_POST['voucher_code']) ? $_POST['voucher_code'] : '';

/* ===== RECOMPUTE TOTAL SERVER-SIDE ===== */
// Fetch base price from tour_packages
$query = "SELECT t.price, t.tour_name, d.island_name 
          FROM tour_packages t 
          LEFT JOIN destinations d ON t.destination_id = d.destination_id 
          LEFT JOIN regions r ON d.island_id = r.island_id 
          WHERE t.tour_id = $tour_id";
$result = executeQuery($query);
$tour   = $result->fetch_assoc();

if (!$tour) { die(json_encode(["error" => "Tour not found"])); }

$base_price = $tour['price'];
$subtotal   = $base_price * $pax;
$vat        = $subtotal * 0.12;
$airfare    = 0.00;
$discount   = 0.00;

// Logic from your bookingForm.php
if (!empty($client_region)) {
    // Assuming region_fees table exists as per your original code
    $tour_island = $tour['island_name'];
    $fQuery = "SELECT additional_fee FROM region_fees WHERE origin_island = '$client_region' AND destination_island = '$tour_island'";
    $fRes = executeQuery($fQuery);
    if ($fRes && $row = $fRes->fetch_assoc()) {
        $airfare = $row['additional_fee'] * $pax;
    }
}

if (!empty($voucher_code)) {
    // Assuming vouchers table exists as per your original code
    $vQuery = "SELECT discount_amount FROM vouchers WHERE code = '$voucher_code' AND is_redeemed = 0 AND expires_at > NOW()";
    $vRes = executeQuery($vQuery);
    if ($vRes && $row = $vRes->fetch_assoc()) {
        $discount = $row['discount_amount'];
    }
}

$final_total = ($subtotal + $vat + $airfare) - $discount;
$final_total_formatted = number_format($final_total, 2, '.', '');

/* ===== CREATE PAYPAL ORDER ===== */
$token = generateAccessToken($clientId, $secret);

$data = [
    "intent" => "CAPTURE",
    "purchase_units" => [[
        "amount" => [
            "currency_code" => "PHP",
            "value" => $final_total_formatted
        ],
        "description" => "Booking: " . $tour['tour_name'] . " ($pax Pax)"
    ]]
];

$ch = curl_init("https://api-m.sandbox.paypal.com/v2/checkout/orders");
curl_setopt_array($ch, [
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "Authorization: Bearer $token"
    ],
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_RETURNTRANSFER => true
]);

echo curl_exec($ch);
?>