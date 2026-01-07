<?php
include_once("../../../../frontend/php/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['inclusion_id']);
    $tour_id = intval($_POST['tour_id']);
    $detail = mysqli_real_escape_string($conn, $_POST['inclusion_detail']);

    $sql = "UPDATE tour_inclusions SET tour_id = $tour_id, inclusion_detail = '$detail' WHERE inclusion_id = $id";
    
    if (executeQuery($sql)) {
        header("Location: ../../../adminDashboard.php?page=adminTourInclusions&status=updated");
    }
}
?>