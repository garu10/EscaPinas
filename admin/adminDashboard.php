<?php
session_start();
include_once("../frontend/php/connect.php"); 


// Temporary placeholders (mapapaltan base sa DB data)
$profileImage = $_SESSION['profile_image'] ?? "assets/images/logo2.jpg";
$userName = $_SESSION['username'] ?? "EscaPinas";
$page = $_GET['page'] ?? 'personal';

$css = "../admin/assets/css/adminProfile.css";
?>

<?php include 'adminComponents/head.php'; ?>

<body>
    <?php include 'adminComponents/adminNav.php'; ?>

    <div class="container my-5">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="account-sidebar shadow-sm">
                    <h4 class="profile-name"><?= $userName; ?></h4>
                    <a href="profile.php?page=personal" class="text-center d-block text-decoration-none text-dark small">Update personal info</a>

                    <div class="sidebar-links">
                        <a href="adminDashboard.php?page=adminBookings" class="fw-bold text-success" >Bookings</a>
                        <a href="adminDashboard.php?page=adminDestinations" class="fw-bold text-success" >Destinations</a>
                        <a href="adminDashboard.php?page=adminLocationPoints" class="fw-bold text-success" >Location Points</a>
                        <a href="adminDashboard.php?page=adminPayments" class="fw-bold text-success" >Payments</a>
                        <a class="fw-bold text-success" >Pickup & Dropoff</a>
                        <a href="adminDashboard.php?page=adminRatings" class="fw-bold text-success" >Ratings</a>
                        <a href="adminDashboard.php?page=adminRegions" class="fw-bold text-success" >Regions</a>
                        <a href="adminDashboard.php?page=adminRegionFees" class="fw-bold text-success" >Region Fees</a>
                        <a class="fw-bold text-success" >Tour About</a>
                        <a class="fw-bold text-success" >Tour Exclusions</a>
                        <a class="fw-bold text-success" >Tour Inclusions</a>
                        <a class="fw-bold text-success" >Tour Itenerary</a>
                        <a href="adminDashboard.php?page=adminTourPackages" class="fw-bold text-success" >Tour Packages</a>
                        <a href="adminDashboard.php?page=adminTourPlaces" class="fw-bold text-success" >Tour Place</a>
                        <a href="adminDashboard.php?page=adminTourSchedules" class="fw-bold text-success" >Tour Schedules</a>
                        <a href="adminDashboard.php?page=adminUsers" class="fw-bold text-success" >Users</a>
                        <a class="fw-bold text-success" >Vouchers</a>
                        <a href="adminDashboard.php?page=adminWishlists" class="fw-bold text-success" >Wishlist</a>

                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="box-details">
                    <?php
                    switch ($page) {
                        case 'adminBookings':
                            include "dashboardLinks/adminBookings/bookingsUI.php";
                            break;
                        case 'adminUsers':
                            include "dashboardLinks/adminUsers/usersUI.php";
                            break;
                        case 'adminTourPackages':
                            include "dashboardLinks/adminTourpackages/tourpackagesUI.php";
                            break;
                        case 'adminPayments':
                            include "dashboardLinks/adminPayments/paymentsUI.php";
                            break;
                        case 'adminWishlists':
                            include "dashboardLinks/adminWishlists/wishlistsUI.php";
                            break;
                        case 'personal':
                        default:
                        case 'adminRatings':
                            include "dashboardLinks/adminRatings/ratingsUI.php";
                            break;
                        case 'adminDestinations':
                            include "dashboardLinks/adminDestinations/destinationsUI.php";
                            break;
                        case 'adminLocationPoints':
                            include "dashboardLinks/adminLocationPoints/locationPointsUI.php";
                            break;
                        case 'adminRegions':
                            include "dashboardLinks/adminRegions/regionsUI.php";
                            break;
                        case 'adminRegionFees':
                            include "dashboardLinks/adminRegionFees/regionFeesUI.php";
                            break;
                        case 'adminTourSchedules':
                            include "dashboardLinks/adminTourSchedules/tourSchedulesUI.php";
                            break;
                        case 'adminTourPlaces':
                            include "dashboardLinks/adminTourPlaces/tourPlacesUI.php";
                            break;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php include "components/footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>