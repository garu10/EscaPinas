<?php
include_once("../../../../frontend/php/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $middle_initial = mysqli_real_escape_string($conn, $_POST['middle_initial']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $contact_num = mysqli_real_escape_string($conn, $_POST['contact_num']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $region = mysqli_real_escape_string($conn, $_POST['region']);
    $province = mysqli_real_escape_string($conn, $_POST['province']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $sql = "UPDATE users SET 
                first_name = '$first_name',
                middle_initial = '$middle_initial',
                last_name = '$last_name',
                contact_num = '$contact_num',
                email = '$email',
                region = '$region',
                province = '$province',
                city = '$city',
                role = '$role'
            WHERE user_id = $user_id";
    
    if (executeQuery($sql)) {
        header("Location: ../../../adminDashboard.php?page=adminUsers&status=updated");
        exit();
    } else {
        echo "Error: Could not update user details. " . mysqli_error($conn);
    }
}
?>