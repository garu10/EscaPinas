<?php
    include_once "php/connect.php";

    $tour_id      = isset($_GET['tour_id']) ? intval($_GET['tour_id']) : 1;
    $pax          = isset($_GET['pax']) ? intval($_GET['pax']) : 1;
    $voucher_code = isset($_GET['voucher']) ? trim($_GET['voucher']) : "";

    $tourQuery = "SELECT t.*, d.destination_name, r.island_name
              FROM tour_packages t
              JOIN destinations d ON t.destination_id = d.destination_id
              JOIN regions r ON d.island_id = r.island_id
              WHERE t.tour_id = $tour_id";
    $tourResult = executeQuery($tourQuery);
    $tour       = ($tourResult) ? $tourResult->fetch_assoc() : null;

    if (! $tour) {
        die("Tour not found.");
    }

    $status = isset($tour['booking_status']) ? $tour['booking_status'] : 'Pending';

    switch ($status) {
        case 'Confirmed':
            $badge_class = "bg-success-subtle text-success border-success-subtle";
            $icon        = "fa-check-circle";
            break;
        case 'Cancelled':
            $badge_class = "bg-danger-subtle text-danger border-danger-subtle";
            $icon        = "fa-times-circle";
            break;
        default:
            $badge_class = "bg-warning-subtle text-warning border-warning-subtle";
            $icon        = "fa-clock";
            break;
    }

    // scheds & inclusions
    $schedules  = executeQuery("SELECT * FROM tour_schedules WHERE tour_id = $tour_id");
    $inclusions = executeQuery("SELECT * FROM tour_inclusions WHERE tour_id = $tour_id");

    // computationss
    $base_price = $tour['price'];
    $rating     = "4.8 (120 reviews)";
    $subtotal   = $base_price * $pax;
    $vat        = $subtotal * 0.12;

    // forda vouchers
    $discount        = 0.00;
    $voucher_error   = "";
    $voucher_success = "";

    if (! empty($voucher_code)) {
        $vQuery  = "SELECT * FROM vouchers WHERE code = '$voucher_code' AND is_redeemed = 0 AND expires_at > NOW()";
        $vResult = executeQuery($vQuery);

        if ($vResult && $vResult->num_rows > 0) {
            $vData           = $vResult->fetch_assoc();
            $discount        = $vData['discount_amount'];
            $voucher_success = "Voucher applied: ₱" . number_format($discount, 2) . " off!";
        } else {
            $voucher_error = "Invalid, used, or expired voucher code.";
        }
    }

    $total = ($subtotal + $vat) - $discount;
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
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
        .tour-img { width: 100%; border-radius: 15px; height: 180px; object-fit: cover; }
    </style>
</head>
<body>

<?php include "components/navbar.php"; ?>

<div class="container my-5">
    <div class="h5 text-success fw-bold mb-3">Travel Information</div>
    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
        <div class="row">
            <div class="col-md-4">
                <img src="<?php echo $tour['image']; ?>" class="tour-img shadow-sm" style="height: auto; width:350px; object-fit: cover;">
            </div>

            <div class="col-md-8">
                <div class="h4 fw-bold mb-2 text-dark"><?php echo $tour['tour_name']; ?></div>

                <div class="row mb-3 text-muted small">
                    <div class="col">
                        <i class="fas fa-map-marker-alt text-danger me-1"></i>
                        <?php echo $tour['destination_name']; ?>,<?php echo $tour['island_name']; ?>
                    </div>
                    <div class="col">
                        <i class="far fa-clock text-primary me-1"></i>
                        <?php echo $tour['duration_days']; ?>D /<?php echo $tour['duration_nights']; ?>N
                    </div>
                    <div class="col">
                        <i class="fas fa-star text-warning me-1"></i>                                                                                                                                                                                                                <?php echo $rating; ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="small fw-bold text-success">Select Travel Date:</label>
                    <select class="form-select form-select-sm w-50">
                        <?php while ($s = $schedules->fetch_assoc()): ?>
                            <option>
                                <?php echo date('M d, Y', strtotime($s['start_date'])); ?> -<?php echo date('M d, Y', strtotime($s['end_date'])); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="small text-muted mb-3 border-start border-success border-3 ps-3">
                    <strong>Inclusions:</strong><br>
                    <?php
                        mysqli_data_seek($inclusions, 0);
                    while ($inc = $inclusions->fetch_assoc()): ?>
                        <div class="mb-1">
                            <i class="fas fa-check text-success me-2 small"></i>
                            <?php echo htmlspecialchars($inc['inclusion_detail']); ?>
                        </div>
                    <?php endwhile; ?>
                </div>

                <div class="d-flex align-items-center gap-4">
                    <div>
                        <span class="small text-muted">Price per pax:</span>
                        <div class="h5 fw-bold text-dark mb-0">₱<?php echo number_format($base_price, 2); ?></div>
                    </div>
                    <div class="bg-light rounded-pill px-3 py-2 d-flex align-items-center gap-3">
                        <a href="?tour_id=<?php echo $tour_id; ?>&pax=<?php echo max(1, $pax - 1); ?>" class="btn btn-sm btn-light rounded-circle shadow-sm fw-bold">-</a>
                        <span class="fw-bold px-2"><?php echo $pax; ?></span>
                        <a href="?tour_id=<?php echo $tour_id; ?>&pax=<?php echo $pax + 1; ?>" class="btn btn-sm btn-light rounded-circle shadow-sm fw-bold">+</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="row">

<div class="col-md-7">
    <div class="h5 text-success fw-bold mb-3">Booking Summary</div>
    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
        <div class="row g-4">
            <div class="col-6">
                <div class="text-muted small">Tour Name</div>
                <div class="fw-bold text-dark"><?php echo htmlspecialchars($tour['tour_name']); ?></div>
            </div>

            <div class="col-6">
                <div class="text-muted small">No. of Pax</div>
                <div class="fw-bold text-dark"><?php echo $pax; ?> Person(s)</div>
            </div>

            <div class="col-6">
                <div class="text-muted small">Travel Date & Duration</div>
                <div class="fw-bold text-dark">
                    <?php echo isset($_GET['date']) ? htmlspecialchars($_GET['date']) : 'To be selected'; ?>
                    <div class="small text-muted fw-normal"><?php echo $tour['duration_days']; ?>D /<?php echo $tour['duration_nights']; ?>N</div>
                </div>
            </div>

        <div class="col-6">
            <div class="text-muted small mb-1">Booking Status</div>
            <span class="badge                               <?php echo $badge_class; ?> border fw-bold rounded-pill px-3 shadow">
                <i class="fas                              <?php echo $icon; ?> me-1"></i><?php echo $status; ?>
            </span>
        </div>
        </div>
    </div>

    <div class="h5 text-success fw-bold mb-3">Personal Information</div>
    <div class="mb-3 text-muted small">
        <i class="fas fa-lock text-success me-1"></i>
        I understand that any ID information provided will only be used for booking travel and leisure activities that require name registration. I also understand that EscaPinas will protect this information using encryption and other security methods, and EscaPinas will only authorize its use to relevant third parties for specific transactions.
    </div>

    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
        <form id="bookingForm">
            <div class="row g-3 mb-3">
                <div class="col-md-5">
                    <label class="form-label small fw-bold">First Name</label>
                    <input type="text" class="form-control rounded-3 shadow-sm border-light">
                </div>
                <div class="col-md-5">
                    <label class="form-label small fw-bold">Last Name</label>
                    <input type="text" class="form-control rounded-3 shadow-sm border-light">
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-bold">M.I.</label>
                    <input type="text" class="form-control rounded-3 shadow-sm border-light">
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Email</label>
                    <input type="email" class="form-control rounded-3 shadow-sm border-light">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Contact Number</label>
                    <input type="text" class="form-control rounded-3 shadow-sm border-light">
                </div>
            </div>
        </form>
    </div>
</div>


    <div class="col-md-5">
        <div class="h5 text-success fw-bold mb-3">Purchase Summary</div>
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">

            <div class="d-flex justify-content-between mb-2">
                <span class="text-muted">Price per pax</span>
                <span>₱<?php echo number_format($base_price, 2); ?></span>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <span class="text-muted">Subtotal (<?php echo $pax; ?> pax)</span>
                <span class="fw-bold">₱<?php echo number_format($subtotal, 2); ?></span>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <span class="text-muted">VAT (12%)</span>
                <span>₱<?php echo number_format($vat, 2); ?></span>
            </div>

            <hr class="my-3">
            <label class="small fw-bold text-success mb-2">Apply Promo Code / Voucher</label>
            <form action="" method="GET" class="d-flex gap-2 mb-2">
                <input type="hidden" name="tour_id" value="<?php echo $tour_id; ?>">
                <input type="hidden" name="pax" value="<?php echo $pax; ?>">
                <input type="text" name="voucher" class="form-control form-control-sm"
                    placeholder="Enter code" value="<?php echo htmlspecialchars($voucher_code); ?>">
                <button type="submit" class="btn btn-success btn-sm px-3">Apply</button>
            </form>

            <?php if ($discount > 0): ?>
                <div class="d-flex justify-content-between text-success small fw-bold">
                    <span>Voucher Discount:</span>
                    <span>- ₱<?php echo number_format($discount, 2); ?></span>
                </div>
            <?php elseif (! empty($voucher_error)): ?>
                <div class="text-danger small" style="font-size: 0.75rem;"><?php echo $voucher_error; ?></div>
            <?php endif; ?>

            <hr class="my-3">
            <div class="d-flex justify-content-between align-items-center">
                <span class="h5 fw-bold mb-0">Total Amount</span>
                <span class="h4 fw-bold text-success mb-0">₱<?php echo number_format($total, 2); ?></span>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 p-4 text-center">
            <div class="small text-muted mb-3 text-uppercase fw-bold" style="letter-spacing: 1px;">Secure Payment via</div>
            <div class="d-flex justify-content-center gap-3 mb-4">
                <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" width="80">
                <img src="https://upload.wikimedia.org/wikipedia/commons/b/b7/MasterCard_Logo.svg" width="40">
                <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" width="40">
            </div>

            <button class="btn btn-success w-100 py-3 fw-bold rounded-3 shadow-sm border-0"
                    style="background: linear-gradient(45deg, #198754, #20c997);">
                CONFIRM AND PAY ₱<?php echo number_format($total, 2); ?>
            </button>
    </div>
    </div>
    </div>
    </div>

    <?php include "components/footer.php"; ?>
</body>
</html>