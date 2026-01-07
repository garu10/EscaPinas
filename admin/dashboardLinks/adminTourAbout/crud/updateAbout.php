<?php
include_once("../../../../frontend/php/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['about_id'];
    $desc = mysqli_real_escape_string($conn, $_POST['description']);

    $sql = "UPDATE tour_about SET description = '$desc' WHERE about_id = $id";
    
    if (executeQuery($sql)) {
        header("Location: ../../../adminDashboard.php?page=adminTourAbout&status=updated");
    }
}
?>