<?php
require_once "php/connect.php";

function generateAccessToken()
{
    $client = "AR_ityCiAr_1l5CInno8S9b7EVE0xZMxuGTaky01nSU3vZUi4DH2UuKmQyCkVs-SDiDondbdcl8VZM4I";
    $secret = "EJtqCdoK7GXAlZi7RQAtEugsKQkD7ZmHCs7kJ23lGhed5mAfz9HdfU1CoaphjYrUAj1RyE-igi209atk";

    $ch = curl_init("https://api-m.sandbox.paypal.com/v1/oauth2/token");
    curl_setopt_array($ch, [
        CURLOPT_HTTPHEADER => ["Accept: application/json"],
        CURLOPT_USERPWD => "$client:$secret",
        CURLOPT_POSTFIELDS => "grant_type=client_credentials",
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true
    ]);

    $response = curl_exec($ch);
    return json_decode($response, true)["access_token"];
}

/* ===== RECEIVE BOOKING DATA ===== */
$tour_id = (int) $_POST['tour_id'];
$pax     = (int) $_POST['pax'];

/* ===== RECOMPUTE TOTAL (SERVER-SIDE) ===== */
$getID = executeQuery("SELECT price FROM tour_packages WHERE tour_id = $tour_id");
$tour = $q->fetch_assoc();

$subtotal = $tour['price'] * $pax;
$vat      = $subtotal * 0.12;
$total    = number_format($subtotal + $vat, 2, '.', '');

/* ===== CREATE PAYPAL ORDER ===== */
$token = generateAccessToken();

$data = [
    "intent" => "CAPTURE",
    "purchase_units" => [[
        "amount" => [
            "currency_code" => "PHP",
            "value" => $total
        ],
        "description" => "EscaPinas Tour Booking"
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
