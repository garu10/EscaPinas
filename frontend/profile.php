<?php
session_start();
include_once "php/connect.php"; // Ensure database connection is included

$user_id = $_SESSION['user_id'] ?? 0;

// Fetch User Data for Initials and Name
$firstName = "Esca";
$lastName = "Pinas";
$userName = "EscaPinas";

if ($user_id > 0) {
    $stmt = $conn->prepare("SELECT username, first_name, last_name FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($user = $result->fetch_assoc()) {
        $userName = $user['username'];
        $firstName = $user['first_name'] ?? "";
        $lastName = $user['last_name'] ?? "";
    }
}

// Generate Initials
$initials = "";
if (!empty($firstName) && !empty($lastName)) {
    $initials = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));
} else {
    $initials = strtoupper(substr($userName, 0, 2));
}

$page = $_GET['page'] ?? 'personal';
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EscaPinas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/profile.css">
</head>
<body>
    <?php include "components/navbar.php"; ?>

    <div class="container my-5">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="account-sidebar shadow-sm">
                    <div class="profile-image-wrapper d-flex align-items-center justify-content-center mx-auto" 
                        style="width: 100px; height: 100px; background-color: #198754; border-radius: 50%; color: white; font-size: 40px; font-weight: bold; overflow: hidden; margin-bottom: 15px;">
                        <?php if (isset($_SESSION['profile_image'])): ?>
                            <img src="<?= $_SESSION['profile_image']; ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        <?php else: ?>
                            <?= $initials; ?>
                        <?php endif; ?>
                    </div>
                    <h4 class="profile-name text-center"><?= $userName; ?></h4>
                    <a href="profile.php?page=personal" class="text-center d-block text-decoration-none text-dark small">Update personal info ></a>

                    <div class="sidebar-links">
                        <a href="profile.php?page=voucher" class="<?= $page == 'voucher' ? 'fw-bold text-success' : '' ?>">
                            <i class="bi bi-ticket-perforated"></i> Vouchers
                        </a>
                        <a href="profile.php?page=wishlist" class="<?= $page == 'wishlist' ? 'fw-bold text-success' : '' ?>">
                            <i class="bi bi-heart"></i> Wishlists
                        </a>
                        <a href="profile.php?page=booking" class="<?= $page == 'booking' ? 'fw-bold text-success' : '' ?>">
                            <i class="bi bi-wallet2"></i> Bookings
                        </a>
                        <a href="profile.php?page=payment" class="<?= $page == 'payment' ? 'fw-bold text-success' : '' ?>">
                            <i class="bi bi-wallet2"></i> Payment
                        </a>
                        <a href="profile.php?page=review" class="<?= $page == 'review' ? 'fw-bold text-success' : '' ?>">
                            <i class="bi bi-wallet2"></i> My Ratings
                        </a>
                        <a href="profile.php?page=wallet" class="<?= $page == 'wallet' ? 'fw-bold text-success' : '' ?>">
                            <i class="bi bi-wallet2"></i> Wallet
                        </a>
                        <a href="/EscaPinas/frontend/components/infolinks/about.php">
                            <i class="bi bi-info-circle"></i> About Us
                        </a>
                        <a href="login.php" class="logout"><i class="bi bi-box-arrow-right"></i> Log Out</a>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="box-details">
                    <?php
                    switch ($page) {
                        case 'voucher':
                            include "profile/voucher.php";
                            break;
                        case 'wishlist':
                            include "profile/wishlist.php";
                            break;
                        case 'booking':
                            include "profile/booking.php";
                            break;
                        case 'payment':
                            include "profile/payment.php";
                            break;
                        case 'review':
                            include "profile/myRating.php";
                            break;
                        case 'personal':
                        default:
                            include "profile/personal.php";
                            break;
                        case 'wallet':
                            include "profile/wallet.php";
                            break;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php include "components/footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>