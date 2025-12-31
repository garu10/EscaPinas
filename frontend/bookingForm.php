<?php
/* ================= rough draft of the BE process(will clean this up) ================= */
include 'php/connect.php';

/* ================= GET TOUR ID & PAX ================= */
$tour_id = isset($_GET['tour_id']) ? intval($_GET['tour_id']) : 1;
$pax = isset($_GET['pax']) ? intval($_GET['pax']) : 1;

/* ================= TOUR DETAILS ================= */
$tourQuery = "
SELECT tp.*, d.destination_name, r.island_name
FROM tour_packages tp
JOIN destinations d ON tp.destination_id = d.destination_id
JOIN regions r ON d.island_id = r.island_id
WHERE tp.tour_id = $tour_id
";
$tour = executeQuery($tourQuery)->fetch_assoc();

/* ================= INCLUSIONS ================= */
$inclusions = executeQuery("
SELECT inclusion_detail 
FROM tour_inclusions 
WHERE tour_id = $tour_id
");

/* ================= RATINGS ================= */
$ratingResult = executeQuery("
SELECT COUNT(*) AS total_reviews 
FROM ratings 
WHERE tour_id = $tour_id
");
$rating = $ratingResult->fetch_assoc()['total_reviews'] > 0 ? '5.0' : '0.0';

/* ================= SCHEDULES ================= */
$schedules = executeQuery("
SELECT schedule_id, start_date, end_date 
FROM tour_schedules 
WHERE tour_id = $tour_id
");

/* ================= COMPUTATIONS ================= 
$base_price = $tour['price'];
$subtotal = $base_price * $pax;
$vat = $subtotal * 0.12;
$discount = 0;
$total = $subtotal + $vat - $discount;*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout - EscaPinas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>

<?php include "components/navbar.php"; ?>

<div class="container my-5">

    <!-- Travel Information -->
    <div class="h5 text-success fw-bold mb-3">Travel Information</div>
    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
        <div class="row">
            <div class="col-md-4">
                <img src="" class="tour-img shadow-sm">
            </div>

            <div class="col-md-8">
                <div class="h5 fw-bold mb-2"><?= $tour['tour_name']; ?></div>

                <div class="row mb-2 text-muted small">
                    <div class="col">
                        <i class="fas fa-map-marker-alt"></i>
                        <?= $tour['destination_name']; ?>, <?= $tour['island_name']; ?>
                    </div>

                    <div class="col">
                        <i class="far fa-calendar-alt"></i>
                        <select class="form-select form-select-sm">
                            <?php while($s = $schedules->fetch_assoc()): ?>
                                <option>
                                    <?= date('M d, Y', strtotime($s['start_date'])); ?> -
                                    <?= date('M d, Y', strtotime($s['end_date'])); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="col">
                        <i class="far fa-clock"></i>
                        <?= $tour['duration_days']; ?>D / <?= $tour['duration_nights']; ?>N
                    </div>

                    <div class="col">
                        <i class="fas fa-star text-warning"></i> <?= $rating; ?>
                    </div>
                </div>

                <div class="small text-muted mb-2">
                    <?php while($inc = $inclusions->fetch_assoc()): ?>
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <?= $inc['inclusion_detail']; ?><br>
                    <?php endwhile; ?>
                </div>

                <div class="h6 fw-bold text-dark mb-3">
                    ₱<?= number_format($base_price, 2); ?> / pax
                </div>

                <div class="row bg-light rounded px-2 py-1 w-50">
                    <div class="col text-center">
                        <a href="?tour_id=<?= $tour_id; ?>&pax=<?= max(1, $pax-1); ?>"
                           class="btn btn-sm btn-outline-secondary fw-bold">-</a>
                    </div>
                    <div class="col text-center fw-bold"><?= $pax; ?></div>
                    <div class="col text-center">
                        <a href="?tour_id=<?= $tour_id; ?>&pax=<?= $pax+1; ?>"
                           class="btn btn-sm btn-outline-secondary fw-bold">+</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Personal Information -->
    <div class="h5 text-success fw-bold mb-3">Personal Information</div>
    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
        <form>
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-success">Last Name</label>
                    <input type="text" class="form-control rounded-3">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-success">First Name</label>
                    <input type="text" class="form-control rounded-3">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-success">Middle Initial</label>
                    <input type="text" class="form-control rounded-3">
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-7">
                    <label class="form-label small fw-bold text-success">Email</label>
                    <input type="email" class="form-control rounded-3">
                </div>
                <div class="col-md-5">
                    <label class="form-label small fw-bold text-success">Contact Number</label>
                    <input type="text" class="form-control rounded-3">
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-success">Address</label>
                    <input type="text" class="form-control rounded-3">
                </div>
            </div>
        </form>
    </div>

    <!-- Purchase Summary -->
    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
        <div class="text-center text-success fw-bold mb-4">Purchase Summary</div>

        <div class="row mb-2">
            <div class="col">Price</div>
            <div class="col text-end fw-bold">₱<?= number_format($subtotal,2); ?></div>
        </div>

        <div class="row mb-2">
            <div class="col">Tax VAT</div>
            <div class="col text-end fw-bold">₱<?= number_format($vat,2); ?></div>
        </div>

        <div class="row mb-2 text-success">
            <div class="col">Discount</div>
            <div class="col text-end fw-bold">- ₱<?= number_format($discount,2); ?></div>
        </div>

        <hr>

        <div class="row mt-3 fs-5 fw-bold">
            <div class="col">Total Price</div>
            <div class="col text-end">₱<?= number_format($total,2); ?></div>
        </div>
    </div>

    <!-- Payment -->
    <div class="card border-0 shadow-sm rounded-4 p-4 text-center">
        <div class="h6 text-success fw-bold mb-3">Choose Payment Method</div>

        <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" width="100">

        <div class="row mt-4">
            <div class="col fw-bold">TOTAL PAYMENT:</div>
            <div class="col text-end text-success fs-4 fw-bold">
                ₱<?= number_format($total,2); ?>
            </div>
        </div>

        <button class="btn btn-success w-100 py-3 fw-bold rounded-3 mt-3">
            <i class="fab fa-paypal me-2"></i> Pay with PayPal
        </button>
    </div>

</div>

<?php include "components/footer.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
