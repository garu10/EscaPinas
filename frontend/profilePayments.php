<?php
session_start();

$profileImage = $_SESSION['profile_image'] ?? "assets/images/logo2.jpg";
$userName = $_SESSION['username'] ?? "EscaPinas";

// eme na data
$bookings = [
    ["id" => 1, "title" => "Baguio and Sagada Tour Package", "status" => "Completed", "price" => "5500", "date" => "2025-12-30", "image" => "assets/images/baguio1.jpg"],
    ["id" => 2, "title" => "Baguio and Sagada Tour Package", "status" => "Pending", "price" => "4200", "date" => "2026-01-05", "image" => "assets/images/baguio1.jpg"],
    ["id" => 3, "title" => "Baguio and Sagada Tour Package", "status" => "Cancelled", "price" => "3000", "date" => "2025-11-15", "image" => "assets/images/baguio1.jpg"],
    ["id" => 4, "title" => "Baguio and Sagada Tour Package", "status" => "Completed", "price" => "3000", "date" => "2025-12-15", "image" => "assets/images/baguio1.jpg"]
];

$upcomingBookings = [];
$pastBookings = [];

foreach ($bookings as $booking) {
    if ($booking['status'] == "Pending") {
        $upcomingBookings[] = $booking;
    } else {
        $pastBookings[] = $booking;
    }
}

function renderPaymentCard($booking) {
    $statusColor = "#6c757d";
    if ($booking['status'] == "Completed") $statusColor = "#198754";
    elseif ($booking['status'] == "Pending") $statusColor = "#fd7e14";
    elseif ($booking['status'] == "Cancelled") $statusColor = "#dc3545";
    ?>
    <div class="payment-item mb-4">
        <div class="container-fluid p-3 payment-card-wrapper">
            <div class="row align-items-center">
                <div class="col-8 d-flex align-items-center gap-3">
                    <div class="payment-thumb">
                        <img src="<?= $booking['image'] ?>" class="rounded-3 shadow-sm payment-img" alt="Tour">
                    </div>
                    <div>
                        <h5 class="fw-bold m-0 tour-title"><?= $booking['title'] ?></h5>
                        <p class="text-muted small mb-0"><?= date('M d, Y', strtotime($booking['date'])) ?></p>
                    </div>
                </div>
                <div class="col-4 text-end">
                    <div class="d-flex flex-column align-items-end gap-2">
                        <div class="d-flex align-items-center gap-2">
                            <small class="fw-bold" style="color: <?= $statusColor ?>;"><?= $booking['status'] ?></small>
                            <span class="status-dot" style="background-color: <?= $statusColor ?>;"></span>
                        </div>
                        <button type="button" class="btn btn-outline-success btn-sm rounded-pill px-4 fw-bold shadow-sm" 
                                data-bs-toggle="modal" data-bs-target="#viewDetails<?= $booking['id'] ?>">
                            View Details
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EscaPinas - My Payments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/profilePayments.css">
</head>

<body>
    <?php include "components/navbar.php"; ?>

    <div class="container my-5">
        <div class="row g-4">
            <div class="col-md-3 col-sm-12">
                <div class="account-sidebar shadow-sm">
                    <div class="profile-image-wrapper">
                        <img src="<?= $profileImage; ?>">
                    </div>
                    <h4 class="profile-name mt-3"><?= $userName; ?></h4>
                    <a href="profile.php" class="text-center d-block text-decoration-none text-dark small mb-4">Update personal info ></a>
                    <div class="sidebar-links">
                        <a href="#"><i class="bi bi-ticket-perforated"></i> Vouchers</a>
                        <a href="tour_booking/booking.php"><i class="bi bi-book"></i> Bookings</a>
                        <a href="#" class="active"><i class="bi bi-wallet2"></i> Payment</a>
                        <a href="#"><i class="bi bi-star"></i> Reviews</a>
                        <a href="#"><i class="bi bi-gear"></i> Settings</a>
                        <a href="login.php" class="logout"><i class="bi bi-box-arrow-right"></i> Log Out</a>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="account-details bg-white">
                    <h3 class="details-title mb-4">My Payments</h3>
                    
                    <ul class="nav nav-pills mb-4" id="paymentTab" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active shadow-sm btn-tab-upcoming" id="upcoming-tab" data-bs-toggle="pill" data-bs-target="#upcoming" type="button">
                                Upcoming
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link shadow-sm btn-tab-past" id="past-tab" data-bs-toggle="pill" data-bs-target="#past" type="button">
                                Past
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="paymentTabContent">
                        <div class="tab-pane fade show active" id="upcoming" role="tabpanel">
                            <?php if (empty($upcomingBookings)): ?>
                                <div class="text-center py-5"><p class="text-muted">No upcoming payments found.</p></div>
                            <?php else: ?>
                                <?php foreach ($upcomingBookings as $booking) renderPaymentCard($booking); ?>
                            <?php endif; ?>
                        </div>

                        <div class="tab-pane fade" id="past" role="tabpanel">
                            <?php if (empty($pastBookings)): ?>
                                <div class="text-center py-5"><p class="text-muted">No past payments found.</p></div>
                            <?php else: ?>
                                <?php foreach ($pastBookings as $booking) renderPaymentCard($booking); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php foreach ($bookings as $booking): 
        $statusColor = ($booking['status'] == "Completed") ? "#198754" : (($booking['status'] == "Pending") ? "#fd7e14" : "#dc3545");
    ?>
        <div class="modal fade" id="viewDetails<?= $booking['id'] ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content booking-modal">
                    <div class="modal-header text-white border-0">
                        <h5 class="modal-title fw-bold">Booking Summary</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4 text-center">
                        <img src="<?= $booking['image'] ?>" class="img-fluid rounded-4 shadow mb-3 modal-tour-img">
                        <h4 class="fw-bold mb-3 tour-modal-title"><?= $booking['title'] ?></h4>
                        <div class="row text-start bg-light p-3 rounded-4 mx-1">
                            <div class="col-6 mb-2">
                                <p class="text-muted mb-0 small text-uppercase fw-bold">Amount Paid</p>
                                <p class="fw-bold text-success mb-0">₱<?= number_format($booking['price'], 2) ?></p>
                            </div>
                            <div class="col-6 mb-2 text-end">
                                <p class="text-muted mb-0 small text-uppercase fw-bold">Tour Date</p>
                                <p class="fw-bold mb-0"><?= date('M d, Y', strtotime($booking['date'])) ?></p>
                            </div>
                            <div class="col-12 mt-2 border-top pt-2">
                                <p class="text-muted mb-0 small text-uppercase fw-bold">Payment Status</p>
                                <span class="badge rounded-pill" style="background-color: <?= $statusColor ?>;"><?= $booking['status'] ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <?php include "components/footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>