<?php
include_once("../../../../frontend/php/connect.php");

if (isset($_GET['id'])) {
    $user_id = (int)$_GET['id'];
    
    session_start();
    if ($user_id == $_SESSION['user_id']) {
        header("Location: ../../../adminDashboard.php?page=adminUsers&error=selfdelete");
        exit();
    }

    // GUMAMIT NG TRANSACTION PARA SIGURADONG MALINIS ANG PAGBURA
    mysqli_begin_transaction($conn);

    try {
        // 1. Burahin muna ang mga Vouchers ng user
        executeQuery("DELETE FROM vouchers WHERE user_id = $user_id");

        // 2. Burahin ang Payments na nakakabit sa bookings ng user na ito
        // Ginagamitan ito ng subquery para mahanap ang tamang payment records
        executeQuery("DELETE FROM payments WHERE user_id = $user_id");

        // 3. Burahin ang Bookings ng user
        executeQuery("DELETE FROM bookings WHERE user_id = $user_id");

        // 4. NGAYON, pwede na burahin ang mismong User record
        $sql_user = "DELETE FROM users WHERE user_id = $user_id";
        
        if (executeQuery($sql_user)) {
            mysqli_commit($conn); // I-save ang lahat ng pagbabago
            header("Location: ../../../adminDashboard.php?page=adminUsers&status=deleted");
            exit();
        } else {
            throw new Exception("Could not delete user.");
        }

    } catch (Exception $e) {
        mysqli_rollback($conn); // I-cancel ang lahat kung may isang nag-error
        header("Location: ../../../adminDashboard.php?page=adminUsers&error=db_error");
        exit();
    }
}
?>