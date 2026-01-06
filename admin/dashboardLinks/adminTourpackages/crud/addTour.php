<?php
include_once("../../../../frontend/php/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['tour_name']);
    $price = $_POST['price'];
    $days = $_POST['duration_days'];
    $nights = $_POST['duration_nights'];
    $desc = mysqli_real_escape_string($conn, $_POST['description']);
    $status = $_POST['status'];
    
    $image = "assets/images/" . $_POST['image_name']; 

    $sql = "INSERT INTO tour_packages (tour_name, price, duration_days, duration_nights, description, status, image) 
            VALUES ('$name', '$price', '$days', '$nights', '$desc', '$status', '$image')";

    if (executeQuery($sql)) {
        header("Location: ../../../adminDashboard.php?page=adminTourPackages&status=success");
    }
}
?>