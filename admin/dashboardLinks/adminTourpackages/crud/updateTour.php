<?php
include_once("../../../../frontend/php/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['tour_id'];
    $name = mysqli_real_escape_string($conn, $_POST['tour_name']);
    $price = $_POST['price'];
    $status = $_POST['status'];

    $sql = "UPDATE tour_packages SET tour_name='$name', price='$price', status='$status' WHERE tour_id=$id";
    
    if (executeQuery($sql)) {
        header("Location: ../../../adminDashboard.php?page=adminTourPackages&status=updated");
    }
}
?>