<?php
$bookings = [
    [
        "id" => 4, 
        "tour_name" => "Baguio and Sagada Tour Package", 
        "price" => "5500", 
        "date" => "2026-01-15",
        "days" => "3 Days, 2 Nights",
        "pickup" => "SM North EDSA (Main Entrance)",
        "dropoff" => "SM North EDSA",
        "image" => "assets/images/baguio1.jpg"
    ],
    [
        "id" => 2, 
        "tour_name" => "Baguio and Sagada Tour Package", 
        "price" => "3000", 
        "date" => "2025-11-15", 
        "days" => "3 Days, 2 Nights",
        "pickup" => "Centris Station",
        "dropoff" => "Centris Station",
        "image" => "assets/images/baguio1.jpg"
    ],
    [
        "id" => 3, 
        "tour_name" => "Baguio and Sagada Tour Package", 
        "price" => "3000", 
        "date" => "2025-12-15",
        "days" => "3 Days, 2 Nights",
        "pickup" => "Greenfield District",
        "dropoff" => "Greenfield District",
        "image" => "assets/images/baguio1.jpg"
    ]
];

// sa date yung magiging basis ng Upcoming at Past na button
$today = date('Y-m-d');

// filter base sa date
$upcomingBookings = array_filter($bookings, fn($b) => $b['date'] >= $today);
$pastBookings     = array_filter($bookings, fn($b) => $b['date'] < $today);

if (!function_exists('renderPaymentCard')) {
    function renderPaymentCard($booking) {
?>
        <div class="payment-item mb-4">
            <div class="payment-card container-fluid p-3 shadow-sm bg-white">
                <div class="row align-items-center">
                    <div class="col-8 d-flex align-items-center gap-3">
                        <div class="payment">
                            <img src="<?= $booking['image'] ?>" class="shadow-sm" alt="Tour">
                        </div>
                        <div>
                            <h5 class="fw-bold m-0 text-success" style="font-size: 1rem;"><?= $booking['tour_name'] ?></h5>
                            <p class="text-muted small mb-0">
                                <i class="bi bi-calendar3 me-1"></i><?= date('M d, Y', strtotime($booking['date'])) ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <button type="button" class="btn btn-success fw-bold px-4 shadow-sm rounded-pill"
                                style="background-color: #0ca458; border: none;"
                                data-bs-toggle="modal" data-bs-target="#v<?= $booking['id'] ?>">
                            View Details
                        </button>
                    </div>
                </div>
            </div>
        </div>
<?php }
} ?>

<h4 class="fw-bold text-success">My Booking History</h4>

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
                <div class="text-center py-5"><p class="text-muted">No upcoming trips scheduled.</p></div>
            <?php else: ?>
                <?php foreach ($upcomingBookings as $booking) renderPaymentCard($booking); ?>
            <?php endif; ?>
        </div>

        <div class="tab-pane fade" id="past" role="tabpanel">
            <?php if (empty($pastBookings)): ?>
                <div class="text-center py-5"><p class="text-muted">No past trips found.</p></div>
            <?php else: ?>
                <?php foreach ($pastBookings as $booking) renderPaymentCard($booking); ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php foreach ($bookings as $booking): ?>
    <div class="modal fade" id="v<?= $booking['id'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 24px; overflow: hidden;">
                <div class="modal-header text-white border-0" style="background-color: #0ca458;">
                    <h5 class="fw-bold m-0">Booking Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <img src="<?= $booking['image'] ?>" class="img-fluid rounded-4 shadow mb-3" style="height: 180px; width: 100%; object-fit: cover;">
                    
                    <h4 class="fw-bold text-success mb-1"><?= $booking['tour_name'] ?></h4>
                    <p class="text-muted small mb-3"><i class="bi bi-clock"></i> <?= $booking['days'] ?></p>

                    <div class="row g-3 bg-light p-3 rounded-4 mx-0 border">
                        <div class="col-6">
                            <small class="text-muted text-uppercase fw-bold d-block" style="font-size: 0.7rem;">Total Price</small>
                            <span class="fw-bold text-success">₱<?= number_format($booking['price'], 2) ?></span>
                        </div>
                        <div class="col-6 text-end">
                            <small class="text-muted text-uppercase fw-bold d-block" style="font-size: 0.7rem;">Tour Date</small>
                            <span class="fw-bold"><?= date('M d, Y', strtotime($booking['date'])) ?></span>
                        </div>
                        
                        <div class="col-12 border-top pt-2">
                            <div class="mb-2">
                                <small class="text-muted text-uppercase fw-bold d-block" style="font-size: 0.7rem;">Pick-up Location</small>
                                <span class="small fw-bold"><i class="bi bi-geo-alt text-danger"></i> <?= $booking['pickup'] ?></span>
                            </div>
                            <div>
                                <small class="text-muted text-uppercase fw-bold d-block" style="font-size: 0.7rem;">Drop-off Location</small>
                                <span class="small fw-bold"><i class="bi bi-geo text-primary"></i> <?= $booking['dropoff'] ?></span>
                            </div>
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