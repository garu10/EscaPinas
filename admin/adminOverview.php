<?php
include_once("../frontend/php/connect.php");
include 'adminComponents/head.php';

$tourCountQuery = executeQuery("SELECT COUNT(*) as total FROM tour_packages");
$totalTours = mysqli_fetch_assoc($tourCountQuery)['total'];

$bookingCountQuery = executeQuery("SELECT COUNT(*) as total FROM bookings");
$totalBookings = mysqli_fetch_assoc($bookingCountQuery)['total'];

$clientCountQuery = executeQuery("SELECT COUNT(*) as total FROM users WHERE role = 'user'");
$totalClients = mysqli_fetch_assoc($clientCountQuery)['total'];

$revenueQuery = executeQuery("SELECT SUM(total_amount) as total FROM bookings WHERE booking_status = 'Confirmed'");
$totalRevenue = mysqli_fetch_assoc($revenueQuery)['total'] ?? 0;

$alertQuery = executeQuery("SELECT COUNT(*) as total FROM bookings WHERE booking_status = 'Pending'");
$totalAlerts = mysqli_fetch_assoc($alertQuery)['total'];
?>

<?php include 'adminComponents/head.php'; ?>

<body>
    <?php include 'adminComponents/adminNav.php'; ?>

    <div class="container-fluid bg-success bg-opacity-50 p-5 align-items-center" style="min-height: 50vh;">
        <div class="row">
            <div class="col d-flex flex-column p-5">
                <div class="h1 text-start mb-4 text-success">Dashboard Overview</div>
                <div class="d-flex flex-row justify-content-around gap-3">

                    <button class="h5 p-5 bg-success bg-opacity-25 rounded-5 border border-5 border-success">
                        <div class="h3 fw-bold"><?= $totalTours ?></div>
                        <div class="h6 m-0">Total Tours</div>
                    </button>

                    <button class="h5 p-5 bg-success bg-opacity-25 rounded-5 border border-5 border-success">
                        <div class="h3 fw-bold"><?= $totalBookings ?></div>
                        <div class="h6 m-0">Total Bookings</div>
                    </button>

                    <button class="h5 p-5 bg-success bg-opacity-25 rounded-5 border border-5 border-success">
                        <div class="h3 fw-bold"><?= $totalClients ?></div>
                        <div class="h6 m-0">Total Clients</div>
                    </button>

                    <button class="h5 p-5 bg-success bg-opacity-25 rounded-5 border border-5 border-success">
                        <div class="h3 fw-bold">₱<?= number_format($totalRevenue, 2) ?></div>
                        <div class="h6 m-0">Total Revenue</div>
                    </button>

                    <button class="h5 p-4 bg-<?= $totalAlerts > 0 ? 'danger' : 'success' ?> bg-opacity-25 rounded-5 border border-5 border-<?= $totalAlerts > 0 ? 'danger' : 'success' ?>">
                        <div class="h3 fw-bold"><?= $totalAlerts ?></div>
                        <div class="h6 m-0">System Alert</div>
                    </button>
                    <button id="syncUsersBtn" class="h5 p-4 bg-info bg-opacity-25 rounded-5 border border-5 border-info">
                        <div class="h3 fw-bold"><i class="bi bi-person-sync"></i></div>
                        <div class="h6 m-0">Sync Users</div>
                    </button>

                    <button id="syncVouchersBtn" class="h5 p-4 bg-warning bg-opacity-25 rounded-5 border border-5 border-warning">
                        <div class="h3 fw-bold"><i class="bi bi-ticket-perforated"></i></div>
                        <div class="h6 m-0">Sync Vouchers</div>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('syncUsersBtn').addEventListener('click', function() {
            this.disabled = true; // prevent multiple clicks
            this.innerText = 'Syncing...';

            fetch('frontend\integs\api\getUsers.php') // adjust path if getUsers.php is in a subfolder
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    location.reload(); // refresh to show new counts
                })
                .catch(err => alert('Error syncing users: ' + err))
                .finally(() => {
                    this.disabled = false;
                    this.innerHTML = '<div class="h3 fw-bold">...</div><div class="h6 m-0">Sync Users</div>';
                });
        });

        document.getElementById('syncVouchersBtn').addEventListener('click', function() {
            this.disabled = true;
            this.innerText = 'Syncing...';

            fetch('frontend\integs\api\getVouchers.php') // adjust path if getVouchers.php is in a subfolder
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                })
                .catch(err => alert('Error syncing vouchers: ' + err))
                .finally(() => {
                    this.disabled = false;
                    this.innerHTML = '<div class="h3 fw-bold">...</div><div class="h6 m-0">Sync Vouchers</div>';
                });
        });
    </script>
</body>

</html>