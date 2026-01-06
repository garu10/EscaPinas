<?php
include_once("../../../../frontend/php/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['destination_id'];
    $name = mysqli_real_escape_string($conn, $_POST['destination_name']);
    $desc = mysqli_real_escape_string($conn, $_POST['description']);
    $status = $_POST['status'];

    $sql = "UPDATE destinations SET destination_name='$name', description='$desc', status='$status' WHERE destination_id=$id";
    
    if (executeQuery($sql)) {
        header("Location: ../../../adminDashboard.php?page=adminDestinations&status=updated");
    }
}
?>