<?php
include_once("../../../../frontend/php/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['island_name']);
    $desc = mysqli_real_escape_string($conn, $_POST['description']);

    $sql = "INSERT INTO regions (island_name, description) VALUES ('$name', '$desc')";
    
    if (executeQuery($sql)) {
        header("Location: ../../../adminDashboard.php?page=adminRegions&status=success");
    }
}
?>