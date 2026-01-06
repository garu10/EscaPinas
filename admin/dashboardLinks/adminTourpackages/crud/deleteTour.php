<?php
include_once("../../../../frontend/php/connect.php");

if (isset($_GET['id'])) {
    $tour_id = intval($_GET['id']);

    $checkBookings = "SELECT COUNT(*) as total FROM bookings WHERE tour_id = $tour_id";
    $checkResult = executeQuery($checkBookings);
    $bookingData = mysqli_fetch_assoc($checkResult);

    if ($bookingData['total'] > 0) {
        header("Location: ../../../adminDashboard.php?page=adminTourPackages&error=has_bookings");
        exit();
    }

    $sql = "DELETE FROM tour_packages WHERE tour_id = $tour_id";

    if (executeQuery($sql)) {
        header("Location: ../../../adminDashboard.php?page=adminTourPackages&status=deleted");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    header("Location: ../../../adminDashboard.php?page=adminTourPackages");
    exit();
}
?>