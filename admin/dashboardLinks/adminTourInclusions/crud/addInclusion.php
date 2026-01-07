<?php
include_once("../../../../frontend/php/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tour_id = intval($_POST['tour_id']);
    $detail = mysqli_real_escape_string($conn, $_POST['inclusion_detail']);

    $sql = "INSERT INTO tour_inclusions (tour_id, inclusion_detail) VALUES ($tour_id, '$detail')";
    
    if (executeQuery($sql)) {
        header("Location: ../../../adminDashboard.php?page=adminTourInclusions&status=created");
    }
}
?>