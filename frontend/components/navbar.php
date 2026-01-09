<?php
    include_once(__DIR__ . "/../php/connect.php");

    $isLoggedIn = isset($_SESSION['user_id']);
    $userName = "Guest";

    if ($isLoggedIn) {
        $uid = $_SESSION['user_id'];
        $userQuery = "SELECT first_name, last_name FROM users WHERE user_id = $uid";
        $userResult = mysqli_query($conn, $userQuery);
        if ($userData = mysqli_fetch_assoc($userResult)) {
            $userName = $userData['first_name'] . " " . $userData['last_name'];
        }
    }
?>

<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top py-1" style="font-family: 'Poppins', sans-serif;">
    <div class="container">
        <div class="col-6 col-lg-2 d-flex align-items-center">
            <a class="navbar-brand fw-bold" href="/EscaPinas/index.php" style="font-family: 'Poppins', sans-serif;">
                <img src="/EscaPinas/frontend/assets/images/landscapeLogo.png" height="60" class="d-inline-block align-text-top">
            </a>
        </div>

        <div class="col-6 d-flex justify-content-end d-lg-none">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse justify-content-center" id="mainNavbar">
            <ul class="navbar-nav gap-lg-4 text-center text-lg-start py-2 py-lg-0">
                <li class="nav-item">
                    <a class="nav-link active fw-semibold text-dark" href="/EscaPinas/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-dark" href="/EscaPinas/frontend/packages.php">Packages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-dark" href="/EscaPinas/frontend/components/infoLinks/about.php">About</a>
                </li>
            </ul>
        </div>

        <div class="col-lg-2 d-none d-lg-flex justify-content-end align-items-center gap-3" style="font-family: 'Poppins', sans-serif;">
            <a href="/EscaPinas/frontend/integs/chatbot/chatbotUI.php" class="text-dark fs-4">
                <i class="bi bi-chat-dots"></i>
            </a>
            
        <div class="dropdown">
                <a href="#" class="text-dark fs-4 lh-1" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle"></i>
                </a>

                <ul class="dropdown-menu shadow border-0" style="right: 0; left: auto; min-width: 200px;">
                    <?php if ($isLoggedIn): ?>
                        <li class="px-3 py-2 small text-muted fw-semibold">
                            <i class="bi bi-person-fill me-1"></i> <?php echo htmlspecialchars($userName); ?>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/EscaPinas/frontend/profile.php"><i class="bi bi-person"></i> Profile Settings</a></li>
                        <li><a class="dropdown-item" href="/EscaPinas/frontend/my-bookings.php"><i class="bi bi-book"></i> My Bookings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="/EscaPinas/frontend/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                    
                    <?php else: ?>
                        <li class="px-3 py-2 small text-muted fw-semibold">Welcome, <?php echo htmlspecialchars($userName); ?></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/EscaPinas/frontend/login.php"><i class="bi bi-box-arrow-in-right"></i> Login</a></li>
                        <li><a class="dropdown-item" href="/EscaPinas/frontend/registerAccount.php"><i class="bi bi-pencil-square"></i> Sign Up</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
        var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
            return new bootstrap.Dropdown(dropdownToggleEl)
        });
    });
</script>