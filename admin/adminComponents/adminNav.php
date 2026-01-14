<div class="container-fluid p-4 shadow sticky-top admin-nav-container">
    <div class="row">
        <div class="col d-flex flex-row justify-content-between">
            <div class="h4 text-start mb-0">
                <a href="adminOverview.php" class="text-decoration-none text-success fw-bold brand-link">
                    <i class="fas fa-map-marked-alt me-2"></i>EscaPinas Admin
                </a>
            </div>
            <div class="d-flex flex-row align-items-center">
                <div class="ms-3">
                    <a href="adminDashboard.php" class="nav-link-item">
                        <i class="fas fa-chart-pie me-1"></i> Dashboard
                    </a>
                </div>
                <div class="ms-3">
                    <a href="adminEmail.php" class="nav-link-item" onclick="showLoadingToast()">
                        <i class="fas fa-envelope me-1"></i> Email
                    </a>
                </div>
                <!-- add ako ng log out -->
                <div class="ms-3"> 
                    <a href="adminComponents\logout.php" class="nav-link-item logout-item">
                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showLoadingToast() {
        console.log("Redirecting to Email... Connecting to IMAP server.");
    }
</script>