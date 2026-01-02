<?php
session_start();
include_once "../php/connect.php"; 

header('Content-Type: application/json');

$clientId = "AUFm83PF0D4DzFwlx6OfKVsry3C5e1gyFgN3rATp7lGjNRVhxVrdcRLAqTy7ZXbuLiP5d0O769_gFu2H";
$secret = "EPPCj52zDcZjVYDfv3vrEkvchOMXyXYNHjQbg73XhQvIOYFOY6nIE_qhOwAtkmZut5nq5U_Gr6Wrm9q9"; 
$baseUrl = "https://api-m.sandbox.paypal.com";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "$baseUrl/v1/oauth2/token");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, "$clientId:$secret");
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
$auth = json_decode(curl_exec($ch));
$token = $auth->access_token;

$tour_id = intval($_POST['tour_id']);
$pax = intval($_POST['pax']);
$res = executeQuery("SELECT price FROM tour_packages WHERE tour_id = $tour_id");
$tour = $res->fetch_assoc();
$total_amount = ($tour['price'] * $pax) * 1.12; 

$orderData = [
    "intent" => "CAPTURE",
    "purchase_units" => [[
        "amount" => ["currency_code" => "PHP", "value" => number_format($total_amount, 2, '.', '')]
    ]]
];

curl_setopt($ch, CURLOPT_URL, "$baseUrl/v2/checkout/orders");
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json", "Authorization: Bearer $token"]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($orderData));
$response = curl_exec($ch);
curl_close($ch);

echo $response;