<?php
include_once(__DIR__ . "/../php/connect.php");

$isLoggedIn = isset($_SESSION['user_id']);
$userName = "Guest";

if ($isLoggedIn) {
    $uid = $_SESSION['user_id'];
    $userQuery = "SELECT first_name, last_name FROM users WHERE user_id = $uid";
    $userResult = executeQuery($userQuery);
    if ($userData = mysqli_fetch_assoc($userResult)) {
        $userName = $userData['first_name'] . " " . $userData['last_name'];
    }
}
?>

<div class="container-fluid bg-white border-bottom sticky-top py-2" style="font-family: 'Poppins', sans-serif;">
    <div class="container">
        <div class="row align-items-center g-0 d-flex">
            <div class="col-6 col-lg-auto d-flex align-items-center justify-content-start">
                <a class="text-decoration-none" href="/EscaPinas/index.php">
                    <img src="/EscaPinas/frontend/assets/images/landscapeLogo.png" height="60">
                </a>
            </div>

            <div class="col-12 col-lg d-flex justify-content-center align-items-center order-3 order-lg-2 mt-2 mt-lg-0">
                <div class="d-flex flex-row gap-3 gap-lg-4 py-2">
                    <a class="text-decoration-none fw-semibold text-dark fs-6 fs-lg-5" href="/EscaPinas/index.php">Home</a>
                    <a class="text-decoration-none fw-semibold text-dark fs-6 fs-lg-5" href="/EscaPinas/frontend/packages.php">Packages</a>
                    <a class="text-decoration-none fw-semibold text-dark fs-6 fs-lg-5" href="/EscaPinas/frontend/components/infoLinks/about.php">About</a>
                </div>
            </div>

            <div class="col-6 col-lg-auto d-flex justify-content-end align-items-center gap-3 order-2 order-lg-3">
                <a href="/EscaPinas/frontend/integs/chatbot/chatbotUI.php" class="text-dark fs-4 lh-1">
                    <i class="bi bi-chat-dots"></i>
                </a>

                <div class="dropdown">
                    <a href="#" class="text-dark fs-4 lh-1" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i>
                    </a>

                    <ul class="dropdown-menu shadow border-0 dropdown-menu-end" style="min-width: 200px;">
                        <?php if ($isLoggedIn): ?>
                            <li class="px-3 py-2 small text-muted fw-semibold">
                                <i class="bi bi-person-fill me-1"></i> <?php echo htmlspecialchars($userName); ?>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/EscaPinas/frontend/profile.php"><i class="bi bi-person"></i> Profile Settings</a></li>
                            <li><a class="dropdown-item" href="/EscaPinas/frontend/profile.php?page=booking"><i class="bi bi-book"></i> My Bookings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-danger" href="/EscaPinas/frontend/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                        <?php else: ?>
                            <li class="px-3 py-2 small text-muted fw-semibold">Welcome, <?php echo htmlspecialchars($userName); ?></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/EscaPinas/frontend/login.php"><i class="bi bi-box-arrow-in-right"></i> Login</a></li>
                            <li><a class="dropdown-item" href="/EscaPinas/frontend/registerAccount.php"><i class="bi bi-pencil-square"></i> Sign Up</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
        var dropdownList = dropdownElementList.map(function(dropdownToggleEl) {
            return new bootstrap.Dropdown(dropdownToggleEl)
        });
    });
</script>