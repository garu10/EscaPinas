<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EscaPinas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top py-1">
        <div class="container">
            <div class="col-6 col-lg-2 d-flex align-items-center">
                <a class="navbar-brand fw-bold" href="/EscaPinas/index.php">
                    <img src="/EscaPinas/frontend/assets/images/Logo 1.png" height="60" class="d-inline-block align-text-top">
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
                        <a class="nav-link active fw-semibold text-dark" href="/EscaPinas/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold text-dark" href="/EscaPinas/packages.php">Packages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold text-dark" href="/EscaPinas/bookings.php">Bookings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold text-dark" href="/EscaPinas/about.php">About</a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-2 d-none d-lg-flex justify-content-end align-items-center gap-3">
                <a href="frontend/chatbot.php" class="text-dark fs-4">
                    <i class="bi bi-chat-dots"></i>
                </a>
                <div class="dropdown">
                    <a href="#" class="text-dark fs-4 lh-1" id="profileDropdown" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i> <!-- papaltan, magbbase sa profile ng user -->
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                        <li class="px-3 py-2 small text-muted fw-semibold"> <!-- papaltan, magbbase sa username ng user -->
                            Kween Yasmin
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="frontend/profile.php">
                                <i class="bi bi-person"></i> Profile Settings
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-book"></i> My Bookings
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item text-danger" href="#">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" 
    crossorigin="anonymous"></script>
</body>

</html>