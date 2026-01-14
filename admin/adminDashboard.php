<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (!isset($_SESSION['role']) || strtolower($_SESSION['role']) !== 'admin') {
    header("Location: adminLogin.php");
    exit();
}
include_once("../frontend/php/connect.php");

$userName = $_SESSION['username'] ?? "EscaPinas Admin";
$page = $_GET['page'] ?? 'adminBookings';
$title = "| " . ucwords(str_replace('admin', '', $page));
function navActive($currentPage, $targetPage)
{
    return ($currentPage === $targetPage) ? 'active-link shadow-sm' : '';
}
?>

<?php include 'adminComponents/head.php'; ?>
<link rel="stylesheet" href="..\admin\adminComponents\css\adminDashboard.css">


<body>
    <?php include 'adminComponents/adminNav.php'; ?>

    <div class="container-fluid my-4">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="account-sidebar shadow-sm">
                    <div class="text-center mb-4">
                        <div class="h4 fw-bold text-success mb-0"><?= $userName; ?></div>
                        <span class="badge bg-light text-success border border-success px-3">Administrator</span>
                    </div>

                    <div class="mb-3">
                        <input type="text" id="menuSearch" class="form-control border-success-subtle" placeholder="Search menu...">
                    </div>

                    <div class="sidebar-links" id="sidebarMenu">
                        <div class="group-title">Operations</div>
                        <a href="?page=adminSMS" class="<?= navActive($page, 'adminSMS') ?>"><i class="fas fa-sms me-2"></i> SMS</a>
                        <a href="?page=adminBookings" class="<?= navActive($page, 'adminBookings') ?>"><i class="fas fa-calendar-alt me-2"></i> Bookings</a>
                        <a href="?page=adminPayments" class="<?= navActive($page, 'adminPayments') ?>"><i class="fas fa-money-check-alt me-2"></i> Payments</a>
                        <a href="?page=adminVouchers" class="<?= navActive($page, 'adminVouchers') ?>"><i class="fas fa-ticket-alt me-2"></i> Vouchers</a>

                        <div class="group-title">Inventory & Locations</div>
                        <a href="?page=adminDestinations" class="<?= navActive($page, 'adminDestinations') ?>"><i class="fas fa-map-marked-alt me-2"></i> Destinations</a>
                        <a href="?page=adminTourPackages" class="<?= navActive($page, 'adminTourPackages') ?>"><i class="fas fa-box-open me-2"></i> Tour Packages</a>
                        <a href="?page=adminRegions" class="<?= navActive($page, 'adminRegions') ?>"><i class="fas fa-globe-asia me-2"></i> Regions</a>
                        <a href="?page=adminLocationPoints" class="<?= navActive($page, 'adminLocationPoints') ?>"><i class="fas fa-thumbtack me-2"></i> Location Points</a>

                        <div class="group-title">Tour Details</div>
                        <a href="?page=adminTourItinerary" class="<?= navActive($page, 'adminTourItinerary') ?>"><i class="fas fa-route me-2"></i> Itinerary</a>
                        <a href="?page=adminTourSchedules" class="<?= navActive($page, 'adminTourSchedules') ?>"><i class="fas fa-clock me-2"></i> Schedules</a>
                        <a href="?page=adminTourAbout" class="<?= navActive($page, 'adminTourAbout') ?>"><i class="fas fa-info-circle me-2"></i> About Tours</a>

                        <div class="group-title">Management</div>
                        <a href="?page=adminUsers" class="<?= navActive($page, 'adminUsers') ?>"><i class="fas fa-users-cog me-2"></i> Users</a>
                        <a href="?page=adminRatings" class="<?= navActive($page, 'adminRatings') ?>"><i class="fas fa-star me-2"></i> Ratings</a>
                        <a href="?page=adminWishlists" class="<?= navActive($page, 'adminWishlists') ?>"><i class="fas fa-heart me-2"></i> Wishlist</a>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="box-details shadow-sm">
                    <?php
                    $allowedPages = [
                        'adminSMS' => 'adminSMS/smsUI.php',
                        'adminBookings' => 'adminBookings/bookingsUI.php',
                        'adminUsers' => 'adminUsers/usersUI.php',
                        'adminVouchers' => 'adminVouchers/voucherUI.php',
                        'adminTourPackages' => 'adminTourpackages/tourpackagesUI.php',
                        'adminPayments' => 'adminPayments/paymentsUI.php',
                        'adminWishlists' => 'adminWishlists/wishlistsUI.php',
                        'adminRatings' => 'adminRatings/ratingsUI.php',
                        'adminDestinations' => 'adminDestinations/destinationsUI.php',
                        'adminLocationPoints' => 'adminLocationPoints/locationPointsUI.php',
                        'adminRegions' => 'adminRegions/regionsUI.php',
                        'adminRegionFees' => 'adminRegionFees/regionFeesUI.php',
                        'adminTourSchedules' => 'adminTourSchedules/tourSchedulesUI.php',
                        'adminTourPlaces' => 'adminTourPlaces/tourPlacesUI.php',
                        'adminTourAbout' => 'adminTourAbout/tourAboutUI.php',
                        'adminTourExclusions' => 'adminTourExclusions/tourExclusionsUI.php',
                        'adminTourInclusions' => 'adminTourInclusions/tourInclusionsUI.php',
                        'adminTourItinerary' => 'adminTourItinerary/tourItineraryUI.php',
                    ];

                    $fileToInclude = $allowedPages[$page] ?? 'adminBookings/bookingsUI.php';
                    $fullPath = "dashboardLinks/" . $fileToInclude;

                    if (file_exists($fullPath)) {
                        include $fullPath;
                    } else {
                        echo "<div class='text-center py-5'><i class='fas fa-exclamation-triangle fa-3x text-warning mb-3'></i><h4>Page not found</h4></div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php include('../frontend/components/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // real time search bar
        document.getElementById('menuSearch').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let links = document.querySelectorAll('#sidebarMenu a');
            let titles = document.querySelectorAll('.group-title');

            links.forEach(link => {
                let text = link.textContent || link.innerText;
                link.style.display = text.toLowerCase().indexOf(filter) > -1 ? "" : "none";
            });

            if (filter === "") {
                titles.forEach(t => t.style.display = "");
            } else {
                titles.forEach(t => t.style.display = "none");
            }
        });

        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>