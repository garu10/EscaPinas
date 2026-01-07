<?php
include_once("../../../../frontend/php/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['schedule_id']);
    $tour_id = intval($_POST['tour_id']);
    $start = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end = mysqli_real_escape_string($conn, $_POST['end_date']);
    $slots = intval($_POST['available_slots']);

    $sql = "UPDATE tour_schedules SET 
            tour_id = $tour_id, 
            start_date = '$start', 
            end_date = '$end', 
            available_slots = $slots 
            WHERE schedule_id = $id";
    
    if (executeQuery($sql)) {
        header("Location: ../../../adminDashboard.php?page=adminTourSchedules&status=updated");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>