<?php
// eme na data
$bookings = [
    ["id" => 4, "tour_name" => "Baguio and Sagada Tour Package", "status" => "Completed", "price" => "5500", "date" => "2025-12-30", "image" => "assets/images/baguio1.jpg"],
    ["id" => 1, "tour_name" => "Baguio and Sagada Tour Package", "status" => "Completed", "price" => "4200", "date" => "2025-10-10", "image" => "assets/images/baguio1.jpg"],
    ["id" => 2, "tour_name" => "Baguio and Sagada Tour Package", "status" => "Cancelled", "price" => "3000", "date" => "2025-11-15", "image" => "assets/images/baguio1.jpg"],
    ["id" => 3, "tour_name" => "Baguio and Sagada Tour Package", "status" => "Completed", "price" => "3000", "date" => "2025-12-15", "image" => "assets/images/baguio1.jpg"]
];
$status_map = [
    "Completed" => "#0ca458",
    "Pending"   => "#fd7e14",
    "Cancelled" => "#dc3545"
];

$upcomingBookings = array_filter($bookings, fn($b) => $b['status'] === "Pending");
$pastBookings     = array_filter($bookings, fn($b) => $b['status'] !== "Pending");

if (!function_exists('renderPaymentCard')) {
    function renderPaymentCard($booking, $status_map) {
        $statusColor = $status_map[$booking['status']] ?? "#6c757d";
?>
        <div class="payment-item mb-4">
            <div class="payment-card container-fluid p-3 shadow-sm">
                <div class="row align-items-center">
                    <div class="col-8 d-flex align-items-center gap-3">
                        <div class="payment">
                            <img src="<?= $booking['image'] ?>" class="shadow-sm" alt="Tour">
                        </div>
                        <div>
                            <h5 class="fw-bold m-0 text-success" style="font-size: 1rem;"><?= $booking['tour_name'] ?></h5>
                            <p class="text-muted small mb-0"><?= date('M d, Y', strtotime($booking['date'])) ?></p>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="d-flex flex-column align-items-end gap-2">
                            <div class="d-flex align-items-center gap-2">
                                <small class="fw-bold" style="color: <?= $statusColor ?>;"><?= $booking['status'] ?></small>
                                <span class="status-dot" style="background-color: <?= $statusColor ?>;"></span>
                            </div>
                            <button type="button" class="btn btn-success fw-bold px-4 fw-bold shadow-sm"
                                    data-bs-toggle="modal" data-bs-target="#v<?= $booking['id'] ?>">
                                View Details
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php }
} ?>

<h4 class="fw-bold text-success">My Payment History</h4>

<div class="mt-4">
    <ul class="nav nav-pills mb-4" id="paymentTab" role="tablist">
        <li class="nav-item">
            <button class="nav-link active shadow-sm" id="upcoming-tab" data-bs-toggle="pill" data-bs-target="#upcoming" type="button">
                Upcoming
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link shadow-sm" id="past-tab" data-bs-toggle="pill" data-bs-target="#past" type="button">
                Past
            </button>
        </li>
    </ul>

    <div class="tab-content" id="paymentTabContent">
        <div class="tab-pane fade show active" id="upcoming" role="tabpanel">
            <?php if (empty($upcomingBookings)): ?>
                <div class="text-center py-5"><p class="text-muted">No upcoming payments found.</p></div>
            <?php else: ?>
                <?php foreach ($upcomingBookings as $booking) renderPaymentCard($booking, $status_map); ?>
            <?php endif; ?>
        </div>

        <div class="tab-pane fade" id="past" role="tabpanel">
            <?php if (empty($pastBookings)): ?>
                <div class="text-center py-5"><p class="text-muted">No past records found.</p></div>
            <?php else: ?>
                <?php foreach ($pastBookings as $booking) renderPaymentCard($booking, $status_map); ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php foreach ($bookings as $booking): 
    $statusColor = $status_map[$booking['status']] ?? "#6c757d";
?>
    <div class="modal fade" id="v<?= $booking['id'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 24px; overflow: hidden;">
                <div class="modal-header text-white border-0" style="background-color: #0ca458;">
                    <h5 class="fw-bold m-0">Booking Summary</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 text-center">
                    <img src="<?= $booking['image'] ?>" class="img-fluid rounded-4 shadow mb-3" style="height: 180px; width: 100%; object-fit: cover;">
                    <h4 class="fw-bold text-success mb-3"><?= $booking['tour_name'] ?></h4>
                    <div class="row text-start bg-light p-3 rounded-4 mx-1">
                        <div class="col-6 mb-2">
                            <small class="text-muted text-uppercase fw-bold d-block">Amount Paid</small>
                            <span class="fw-bold text-success">₱<?= number_format($booking['price'], 2) ?></span>
                        </div>
                        <div class="col-6 mb-2 text-end">
                            <small class="text-muted text-uppercase fw-bold d-block">Tour Date</small>
                            <span class="fw-bold"><?= date('M d, Y', strtotime($booking['date'])) ?></span>
                        </div>
                        <div class="col-12 mt-2 border-top pt-2">
                            <small class="text-muted text-uppercase fw-bold d-block">Payment Status</small>
                            <span class="badge rounded-pill" style="background-color: <?= $statusColor ?>;"><?= $booking['status'] ?></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>