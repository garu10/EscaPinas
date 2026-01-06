<?php
include_once("../../../../frontend/php/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['destination_name']);
    $desc = mysqli_real_escape_string($conn, $_POST['description']);
    $status = $_POST['status'];

    $sql = "INSERT INTO destinations (destination_name, description, status) VALUES ('$name', '$desc', '$status')";
    
    if (executeQuery($sql)) {
        header("Location: ../../../adminDashboard.php?page=adminDestinations&status=success");
    }
}
?>