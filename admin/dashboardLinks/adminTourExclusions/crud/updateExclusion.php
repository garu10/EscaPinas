<?php
include_once("../../../../frontend/php/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['exclusion_id']);
    $tour_id = intval($_POST['tour_id']);
    $detail = mysqli_real_escape_string($conn, $_POST['exclusion_detail']);

    $sql = "UPDATE tour_exclusions SET tour_id = $tour_id, exclusion_detail = '$detail' WHERE exclusion_id = $id";
    
    if (executeQuery($sql)) {
        header("Location: ../../../adminDashboard.php?page=adminTourExclusions&status=updated");
    }
}
?>