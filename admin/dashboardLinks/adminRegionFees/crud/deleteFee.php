<?php
include_once("../../../../frontend/php/connect.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM region_fees WHERE fee_id = $id";

    if (executeQuery($sql)) {
        header("Location: ../../../adminDashboard.php?page=adminRegionFees&status=deleted");
    }
}
?>