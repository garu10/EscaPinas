<?php
include_once("../../../../frontend/php/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tour_id = $_POST['tour_id'];
    $desc = mysqli_real_escape_string($conn, $_POST['description']);

    $sql = "INSERT INTO tour_about (tour_id, description) VALUES ('$tour_id', '$desc')";
    
    if (executeQuery($sql)) {
        header("Location: ../../../adminDashboard.php?page=adminTourAbout&status=success");
    }
}
?>