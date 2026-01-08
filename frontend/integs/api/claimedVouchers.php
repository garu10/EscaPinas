<?php
session_start();
include '../../php/connect.php';

// check for template_id instead of individual voucher details
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['template_id']) && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // clean inputs
    $template_id = mysqli_real_escape_string($conn, $_POST['template_id']);

    // check if the user has already claimed this voucher template
    $check_query = "SELECT claim_id FROM user_vouchers WHERE user_id = '$user_id' AND template_id = '$template_id'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "already_claimed";
        exit();
    }

    // insert claim record
    $sql = "INSERT INTO user_vouchers (
                user_id, 
                template_id, 
                is_redeemed, 
                claimed_at
            ) VALUES (
                '$user_id', 
                '$template_id', 
                0, 
                NOW()
            )";

    if (executeQuery($sql)) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "invalid_request";
}
exit();
