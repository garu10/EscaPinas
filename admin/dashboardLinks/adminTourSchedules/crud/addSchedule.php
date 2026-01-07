<?php
include_once("../../../../frontend/php/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tour_id = $_POST['tour_id'];
    $start = $_POST['start_date'];
    $end = $_POST['end_date'];
    $slots = $_POST['available_slots'];

    $sql = "INSERT INTO tour_schedules (tour_id, start_date, end_date, available_slots) 
            VALUES ('$tour_id', '$start', '$end', '$slots')";
    
    if (executeQuery($sql)) {
        header("Location: ../../../adminDashboard.php?page=adminTourSchedules&status=success");
    }
}
?>