<div class="container-fluid p-4 shadow sticky-top">
    <div class="row">
        <div class="col d-flex flex-row justify-content-between">
            <div class="h4 text-start">
                <a href="adminOverview.php" class="text-decoration-none text-success fw-bold">
                    EscaPinas Admin
                </a>
            </div>
            <div class="d-flex flex-row align-items-center">
                <div class="ms-3"><a href="adminDashboard.php">Dashboard</a></div>
                <div class="ms-3">
                    <a href="adminEmail.php" onclick="showLoadingToast()">Email</a>
                </div>
                <div class="ms-3"><a>Logout</a></div>
            </div>

        </div>
    </div>
</div>

<script>
function showLoadingToast() {
    // You can use a library like SweetAlert2 or simple Javascript to show a loader
    console.log("Redirecting to Email... Connecting to IMAP server.");
}
</script>