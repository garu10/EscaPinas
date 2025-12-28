<!doctype html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top py-1">
        <div class="container">
            <div class="col-6 col-lg-2 d-flex align-items-center">
            <a class="navbar-brand fw-bold" href="index.php">
                <img src="frontend/assets/images/Logo 1.png" height="60" class="d-inline-block align-text-top">
            </a>
            </div>

            <div class="col-6 col-lg-8 d-flex justify-content-end d-lg-none">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            </div>

            <div class="collapse navbar-collapse justify-content-center" id="mainNavbar">
            <ul class="navbar-nav gap-lg-4 text-center text-lg-start py-2 py-lg-0">
                <li class="nav-item">
                <a class="nav-link active fw-semibold text-dark" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link fw-semibold text-dark" href="#">Packages</a>
                </li>
                <li class="nav-item">
                <a class="nav-link fw-semibold text-dark" href="#">Bookings</a>
                </li>
                <li class="nav-item">
                <a class="nav-link fw-semibold text-dark" href="#">About</a>
                </li>

                <li class="nav-item d-lg-none border-top mt-3 pt-3">
                <div class="d-flex justify-content-center gap-4">
                <a href="chatbot.php" class="fs-3" style="color:#000000;">
                    <i class="bi bi-chat-dots"></i>
                    </a>
                    <a href="account.php" class="fs-3" style="color:#000000;">
                    <i class="bi bi-person-circle"></i>
                    </a>
                </div>
                </li>
            </ul>
            </div>

            <div class="col-lg-2 d-none d-lg-flex justify-content-end align-items-center gap-3">
            <a href="#" class="text-dark fs-4 lh-1">
                <i class="bi bi-chat-dots"></i>
            </a>
            <div class="dropdown">
                <a href="#" class="text-dark fs-4 lh-1" id="profileDropdown" data-bs-toggle="dropdown">
                <i class="bi bi-person-circle"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                <li><a class="dropdown-item text-dark" href="#">Profile Settings</a></li>
                <li><a class="dropdown-item text-dark" href="#">My Bookings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="#">Logout</a></li>
                </ul>
            </div>
            </div>
        </div>
        </nav>
</body>
</html>
