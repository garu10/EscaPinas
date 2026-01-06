<?php
include_once("../../../../frontend/php/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['payment_id'];
    $status = mysqli_real_escape_string($conn, $_POST['payment_status']);
    $amount = $_POST['amount'];

    $sql = "UPDATE payments SET payment_status = '$status', amount = '$amount' WHERE payment_id = $id";
    
    if (executeQuery($sql)) {
        header("Location: ../../../adminDashboard.php?page=adminPayments&status=updated");
    }
}
?>