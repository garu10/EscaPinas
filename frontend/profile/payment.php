<?php
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

if (!function_exists('renderPaymentCard')) {
    function renderPaymentCard($booking)
    {
        $statusColor = "#6c757d";
        if ($booking['status'] == "Completed") $statusColor = "#198754";
        elseif ($booking['status'] == "Pending") $statusColor = "#fd7e14";
        elseif ($booking['status'] == "Cancelled") $statusColor = "#dc3545";
?>
        <div class="payment-item mb-4">
            <div class="container-fluid p-3 shadow-sm" style="background: linear-gradient(to right, #f0fff4, #fff); border: 2px solid #0ca458; border-radius: 25px; transition: transform 0.2s;">
                <div class="row align-items-center">
                    <div class="col-8 d-flex align-items-center gap-3">
                        <div class="payment-thumb">
                            <img src="<?= $booking['image'] ?>" class="rounded-3 shadow-sm" style="width: 100px; height: 75px; object-fit: cover;" alt="Tour">
                        </div>
                        <div>
                            <h5 class="fw-bold m-0" style="color: #1aa866; font-weight: 700; font-size: 1rem;"><?= $booking['title'] ?></h5>
                            <p class="text-muted small mb-0"><?= date('M d, Y', strtotime($booking['date'])) ?></p>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="d-flex flex-column align-items-end gap-2">
                            <div class="d-flex align-items-center gap-2">
                                <small class="fw-bold" style="color: <?= $statusColor ?>;"><?= $booking['status'] ?></small>
                                <span style="height: 12px; width: 12px; border-radius: 50%; display: inline-block; background-color: <?= $statusColor ?>;"></span>
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
<?php }
} ?>

<h4 class="fw-bold text-success">My Payments</h4>

<div class="mt-4">
    <ul class="nav nav-pills mb-4" id="paymentTab" role="tablist">
        <li class="nav-item">
            <button class="nav-link active rounded-pill me-2 px-4 shadow-sm" id="upcoming-tab" data-bs-toggle="pill" data-bs-target="#upcoming" type="button"
                onclick="this.style.backgroundColor='#1aa866'; this.style.color='white'; document.getElementById('past-tab').style.backgroundColor='transparent'; document.getElementById('past-tab').style.color='#1aa866';"
                style="background-color: #1aa866; color: white; font-weight: bold; border: 1px solid #1aa866;">
                Upcoming
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link rounded-pill px-4 shadow-sm border" id="past-tab" data-bs-toggle="pill" data-bs-target="#past" type="button"
                onclick="this.style.backgroundColor='#1aa866'; this.style.color='white'; document.getElementById('upcoming-tab').style.backgroundColor='transparent'; document.getElementById('upcoming-tab').style.color='#1aa866';"
                style="color: #1aa866; border: 1px solid #1aa866; background: transparent; font-weight: bold;">
                Past
            </button>
        </li>
    </ul>

    <div class="tab-content" id="paymentTabContent">
        <div class="tab-pane fade show active" id="upcoming" role="tabpanel">
            <?php if (empty($upcomingBookings)): ?>
                <div class="text-center py-5">
                    <p class="text-muted">No upcoming payments found.</p>
                </div>
            <?php else: ?>
                <?php foreach ($upcomingBookings as $booking) renderPaymentCard($booking); ?>
            <?php endif; ?>
        </div>

        <div class="tab-pane fade" id="past" role="tabpanel">
            <?php if (empty($pastBookings)): ?>
                <div class="text-center py-5">
                    <p class="text-muted">No past payments found.</p>
                </div>
            <?php else: ?>
                <?php foreach ($pastBookings as $booking) renderPaymentCard($booking); ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php foreach ($bookings as $booking):
    $statusColor = ($booking['status'] == "Completed") ? "#198754" : (($booking['status'] == "Pending") ? "#fd7e14" : "#dc3545");
?>
    <div class="modal fade" id="viewDetails<?= $booking['id'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 24px; overflow: hidden;">
                <div class="modal-header text-white border-0" style="background-color: #0ca458;">
                    <h5 class="modal-title fw-bold">Booking Summary</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 text-center">
                    <img src="<?= $booking['image'] ?>" class="img-fluid rounded-4 shadow mb-3" style="width: 100%; height: 180px; object-fit: cover;">
                    <h4 class="fw-bold text-success mb-3"><?= $booking['title'] ?></h4>
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
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-secondary rounded-pill px-5" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>