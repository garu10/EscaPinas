<?php
include_once("../../../../frontend/php/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['island_id'];
    $name = mysqli_real_escape_string($conn, $_POST['island_name']);
    $desc = mysqli_real_escape_string($conn, $_POST['description']);

    $sql = "UPDATE regions SET island_name='$name', description='$desc' WHERE island_id=$id";
    
    if (executeQuery($sql)) {
        header("Location: ../../../adminDashboard.php?page=adminRegions&status=updated");
    }
}
?>