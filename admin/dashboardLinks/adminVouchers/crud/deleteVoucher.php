<?php
session_start();
include_once("../../../../frontend/php/connect.php");

if (isset($_GET['id'])) {
    // Cast to integer for security
    $id = intval($_GET['id']);

    $sql = "DELETE FROM voucher_templates WHERE template_id = $id";

    try {
        if (executeQuery( $sql)) {
            // check if a row was actually deleted
            if (mysqli_affected_rows($conn) > 0) {
                header("Location: ../../../adminDashboard.php?page=adminVouchers&status=success&msg=Voucher+Deleted");
            } else {
                header("Location: ../../../adminDashboard.php?page=adminVouchers&status=error&msg=Voucher+not+found");
            }
        } else {
            throw new Exception(mysqli_error($conn));
        }
    } catch (Exception $e) {
        // catch foreign key constraint errors (example: voucher is already in use)
        $errorCode = mysqli_errno($conn);
        if ($errorCode == 1451) {
            $msg = "Cannot delete this voucher because it is currently linked to active bookings or user claims.";
        } else {
            $msg = "Database Error: " . $e->getMessage();
        }
        header("Location: ../../../adminDashboard.php?page=adminVouchers&status=error&msg=" . urlencode($msg));
    }
    exit();
} else {
    // If no ID is provided, just go back
    header("Location: ../../../adminDashboard.php?page=adminVouchers");
    exit();
}
