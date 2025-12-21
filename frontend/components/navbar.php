<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top">
    <div class="container">
        <div class="row w-100 align-items-center g-0">
            
            <div class="col-6 col-lg-2 d-flex align-items-center">
                <a class="navbar-brand fw-bold" href="index.php">
                    <img src="assets/Logo 1.png" height="100" class="d-inline-block align-text-top">
                </a>
            </div>

            <div class="col-6 col-lg-8">
                <div class="d-flex justify-content-end d-lg-none">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse justify-content-center" id="mainNavbar">
                    <ul class="navbar-nav gap-lg-4 text-start py-3 py-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active text-uppercase fw-semibold" href="index.php">Home</a>
                        </li>
                        <li class="nav-item"><a class="nav-link text-uppercase fw-semibold" href="#">Packages</a></li>
                        <li class="nav-item"><a class="nav-link text-uppercase fw-semibold" href="#">Bookings</a></li>
                        <li class="nav-item"><a class="nav-link text-uppercase fw-semibold" href="#">About</a></li>

                        <li class="nav-item d-lg-none border-top mt-3 pt-3">
                            <div class="d-flex justify-content-center gap-4">
                                <a href="chatbot.php" class="text-dark fs-3">
                                    <i class="bi bi-chat-dots"></i>
                                </a>
                                <a href="account.php" class="text-dark fs-3">
                                    <i class="bi bi-person-circle"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
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
                        <li><a class="dropdown-item" href="#">Profile Settings</a></li>
                        <li><a class="dropdown-item" href="#">My Bookings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="#">Logout</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</nav>