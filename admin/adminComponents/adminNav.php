<link rel="stylesheet" href="../admin/adminComponents/css/adminNav.css">
<div class="container-fluid p-4 mb-2 shadow-sm sticky-top bg-white admin-nav-container border-bottom">
    <div class="row align-items-center">
        <div class="col d-flex flex-row justify-content-between align-items-center">
            <div class="h4 mb-0">
                <a href="adminOverview.php" class="text-decoration-none text-success fw-bold brand-link d-flex align-items-center">
                    <span class="d-none d-sm-inline">EscaPinas Admin</span>
                </a>
            </div>

            <div class="d-flex flex-row align-items-center">
                <?php
                $current_page = basename($_SERVER['PHP_SELF']);
                ?>
                <div class="ms-4">
                    <a href="adminDashboard.php" class="nav-link-item <?= ($current_page == 'adminDashboard.php') ? 'active-nav' : '' ?>">
                        <i class="fas fa-chart-pie me-1"></i> <span>Dashboard</span>
                    </a>
                </div>
                <div class="ms-4">
                    <a href="adminEmail.php" class="nav-link-item <?= ($current_page == 'adminEmail.php') ? 'active-nav' : '' ?>" onclick="showLoadingToast()">
                        <i class="fas fa-envelope me-1"></i> <span>Email</span>
                    </a>
                </div>

                <div class="ms-4 border-start ps-4">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#logoutConfirmModal" class="nav-link-item logout-item text-danger fw-bold">
                        <i class="fas fa-sign-out-alt me-1"></i> <span>Logout</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="logoutConfirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">

            <div class="modal-body text-center p-5">
                <div class="text-danger mb-4">
                    <i class="fas fa-door-open fa-3x"></i>
                </div>

                <h3 class="fw-bold text-dark">Leaving so soon?</h3>
                <p class="text-muted mb-4">Are you sure you want to log out? You will need to login again to manage EscaPinas.</p>

                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <button type="button" class="btn btn-light px-4 py-2 fw-semibold" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <a href="adminComponents/logout.php" class="btn btn-danger px-4 py-2 fw-semibold">
                        Yes, Log me out
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    function showLoadingToast() {
        console.log("Connecting to Mail Server...");
    }

    function confirmLogout() {
        if (confirm("Are you sure you want to log out? Any unsaved changes may be lost.")) {
            window.location.href = "adminComponents/logout.php";
        }
    }
</script>