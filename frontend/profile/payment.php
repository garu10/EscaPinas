<?php
include_once __DIR__ . "/../php/connect.php";

$uid = $_SESSION['user_id'] ?? null;

if (!$uid) {
    echo "<div class='text-center py-5'><p class='text-muted'>Please log in to view your payment history.</p></div>";
    return;
}

$paymentQuery = "SELECT 
                    p.payment_id, 
                    p.amount, 
                    p.payment_status, 
                    p.created_at,
                    b.booking_reference,
                    tp.tour_name, 
                    tp.image,
                    ts.start_date
                 FROM payments p
                 JOIN bookings b ON p.booking_id = b.booking_id
                 JOIN tour_packages tp ON b.tour_id = tp.tour_id
                 JOIN tour_schedules ts ON b.schedule_id = ts.schedule_id
                 WHERE p.user_id = $uid
                 ORDER BY p.created_at DESC";

$paymentResult = executeQuery($paymentQuery);

$upcomingBookings = [];
$pastBookings     = [];

$status_map = [
    "COMPLETED" => "#0ca458",
    "PENDING"   => "#fd7e14",
    "CANCELLED" => "#dc3545",
    "REFUNDED"  => "#0dcaf0"
];

if ($paymentResult && mysqli_num_rows($paymentResult) > 0) {
    while ($row = mysqli_fetch_assoc($paymentResult)) {
        $tourDate = strtotime($row['start_date']);
        $today = strtotime(date('Y-m-d'));

        if ($tourDate >= $today && $row['payment_status'] == 'COMPLETED') {
            $upcomingBookings[] = $row;
        } else {
            $pastBookings[] = $row;
        }
    }
}

if (!function_exists('renderPaymentCard')) {
    function renderPaymentCard($payment, $status_map) {
        $statusColor = $status_map[strtoupper($payment['payment_status'])] ?? "#6c757d";
?>
        <div class="payment-item mb-4">
            <div class="activity-card container-fluid p-3 shadow-sm bg-white border rounded">
                <div class="row align-items-center">
                    <div class="col-8 d-flex align-items-center gap-3">
                        <div class="payment">
                            <img src="<?= htmlspecialchars($payment['image']) ?>" class="shadow-sm" alt="Tour" style="width: 80px; height: 60px; object-fit: cover; border-radius: 8px;">
                        </div>
                        <div>
                            <h5 class="fw-bold m-0 text-success" style="font-size: 1rem;"><?= htmlspecialchars($payment['tour_name']) ?></h5>
                            <p class="text-muted small mb-0">Paid on: <?= date('M d, Y', strtotime($payment['created_at'])) ?></p>
                            <small class="text-primary fw-bold"><?= $payment['booking_reference'] ?></small>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="d-flex flex-column align-items-end gap-2">
                            <div class="d-flex align-items-center gap-2">
                                <small class="fw-bold" style="color: <?= $statusColor ?>;"><?= $payment['payment_status'] ?></small>
                                <span class="status-dot" style="background-color: <?= $statusColor ?>; width: 10px; height: 10px; border-radius: 50%; display: inline-block;"></span>
                            </div>
                            <button type="button" class="btn btn-success fw-bold px-4 shadow-sm rounded-pill"
                                    style="background-color: #0ca458; border: none;"
                                    data-bs-toggle="modal" data-bs-target="#pay<?= $payment['payment_id'] ?>">
                                View Receipt
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
                Upcoming Trips
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link shadow-sm" id="past-tab" data-bs-toggle="pill" data-bs-target="#past" type="button">
                Past / Completed
            </button>
        </li>
    </ul>

    <div class="tab-content" id="paymentTabContent">
        <div class="tab-pane fade show active" id="upcoming" role="tabpanel">
            <?php if (empty($upcomingBookings)): ?>
                <div class="text-center py-5"><p class="text-muted">No upcoming payments found.</p></div>
            <?php else: ?>
                <?php foreach ($upcomingBookings as $payment) renderPaymentCard($payment, $status_map); ?>
            <?php endif; ?>
        </div>

        <div class="tab-pane fade" id="past" role="tabpanel">
            <?php if (empty($pastBookings)): ?>
                <div class="text-center py-5"><p class="text-muted">No past records found.</p></div>
            <?php else: ?>
                <?php foreach ($pastBookings as $payment) renderPaymentCard($payment, $status_map); ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php 
$allRecords = array_merge($upcomingBookings, $pastBookings);
foreach ($allRecords as $payment): 
    $statusColor = $status_map[strtoupper($payment['payment_status'])] ?? "#6c757d";
?>
    <div class="modal fade" id="pay<?= $payment['payment_id'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 24px; overflow: hidden;">
                <div class="modal-header text-white border-0" style="background-color: #0ca458;">
                    <h5 class="fw-bold m-0">Payment Summary</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 text-center">
                    <div class="mb-3 text-start border-bottom pb-2">
                        <small class="text-muted">Transaction Date: <?= date('M d, Y h:i A', strtotime($payment['created_at'])) ?></small>
                    </div>
                    <h4 class="fw-bold text-success mb-3"><?= htmlspecialchars($payment['tour_name']) ?></h4>
                    <div class="row text-start bg-light p-3 rounded-4 mx-1 border">
                        <div class="col-6 mb-2">
                            <small class="text-muted text-uppercase fw-bold d-block" style="font-size: 0.7rem;">Amount Paid</small>
                            <span class="fw-bold text-success" style="font-size: 1.2rem;">₱<?= number_format($payment['amount'], 2) ?></span>
                        </div>
                        <div class="col-6 mb-2 text-end">
                            <small class="text-muted text-uppercase fw-bold d-block" style="font-size: 0.7rem;">Tour Date</small>
                            <span class="fw-bold"><?= date('M d, Y', strtotime($payment['start_date'])) ?></span>
                        </div>
                        <div class="col-12 mt-2 border-top pt-2 d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted text-uppercase fw-bold d-block" style="font-size: 0.7rem;">Reference</small>
                                <span class="fw-bold text-primary"><?= $payment['booking_reference'] ?></span>
                            </div>
                            <span class="badge rounded-pill px-3 py-2" style="background-color: <?= $statusColor ?>;"><?= $payment['payment_status'] ?></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-secondary px-5 rounded-pill" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>