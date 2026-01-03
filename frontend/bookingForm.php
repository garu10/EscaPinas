<?php
session_start();
include_once "php/connect.php";

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1;
$user    = null;
if ($user_id) {
    $userQuery  = "SELECT * FROM users WHERE user_id = $user_id";
    $userResult = executeQuery($userQuery);
    $user       = ($userResult) ? $userResult->fetch_assoc() : null;
}

$tour_id       = isset($_GET['tour_id']) ? intval($_GET['tour_id']) : 1;
$pax           = isset($_GET['pax']) ? max(1, intval($_GET['pax'])) : 1;
$voucher_code  = isset($_GET['voucher']) ? trim($_GET['voucher']) : "";
$client_region = isset($_GET['client_region']) ? $_GET['client_region'] : "";

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

$status = $tour['booking_status'] ?? 'Pending';
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

$base_price = $tour['price'];
$subtotal   = $base_price * $pax;
$vat        = $subtotal * 0.12;

$tour_island = $tour['island_name'];
$airfare_fee = 0.00;
if (! empty($client_region)) {
    $feeQuery  = "SELECT additional_fee FROM region_fees WHERE origin_island='$client_region' AND destination_island='$tour_island'";
    $feeResult = executeQuery($feeQuery);
    if ($feeResult && $feeRow = $feeResult->fetch_assoc()) {
        $airfare_fee = $feeRow['additional_fee'] * $pax;
    }
}

$discount      = 0.00;
$voucher_error = "";
if (! empty($voucher_code)) {
    $vQuery  = "SELECT * FROM vouchers WHERE code='$voucher_code' AND is_redeemed=0 AND expires_at>NOW()";
    $vResult = executeQuery($vQuery);
    if ($vResult && $vResult->num_rows > 0) {
        $vData    = $vResult->fetch_assoc();
        $discount = $vData['discount_amount'];
    } else {
        $voucher_error = "Invalid or expired voucher code.";
    }
}

$total = ($subtotal + $vat + $airfare_fee) - $discount;

$schedules  = executeQuery("SELECT * FROM tour_schedules WHERE tour_id = $tour_id");
$inclusions = executeQuery("SELECT * FROM tour_inclusions WHERE tour_id = $tour_id");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Checkout - EscaPinas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .tour-img {
            width: 100%;
            max-width: 400px;
            border-radius: 15px;
            object-fit: cover;
        }

        .btn-light:hover {
            background-color: #e6f5ea;
        }
    </style>
</head>

<body>

    <?php include "components/navbar.php"; ?>

    <div class="container my-5">
        <div class="h5 text-success fw-bold mb-3">Travel Information</div>
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
            <div class="row">
                <div class="col-md-4">
                    <img src="<?php echo $tour['image']; ?>" class="tour-img shadow-sm">
                </div>
                <div class="col-md-8">
                    <div class="h4 fw-bold mb-2 text-dark"><?php echo $tour['tour_name']; ?></div>
                    <div class="row mb-3 text-muted small">
                        <div class="col"><i class="fas fa-map-marker-alt text-danger me-1"></i> <?php echo $tour['destination_name']; ?>,<?php echo $tour['island_name']; ?></div>
                        <div class="col"><i class="far fa-clock text-primary me-1"></i> <?php echo $tour['duration_days']; ?>D /<?php echo $tour['duration_nights']; ?>N</div>
                    </div>

                    <div class="mb-3">
                        <label class="small fw-bold text-success">Select Travel Date:</label>
                        <select name="schedule_id" class="form-select form-select-sm w-50" form="bookingForm">
                            <?php mysqli_data_seek($schedules, 0);
                            while ($s = $schedules->fetch_assoc()): ?>
                                <option value="<?php echo $s['schedule_id']; ?>">
                                    <?php echo date('M d, Y', strtotime($s['start_date'])); ?> -<?php echo date('M d, Y', strtotime($s['end_date'])); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="small text-muted mb-3 border-start border-success border-3 ps-3">
                        <strong>Inclusions:</strong><br>
                        <?php mysqli_data_seek($inclusions, 0);
                        while ($inc = $inclusions->fetch_assoc()): ?>
                            <div class="mb-1"><i class="fas fa-check text-success me-2 small"></i><?php echo htmlspecialchars($inc['inclusion_detail']); ?></div>
                        <?php endwhile; ?>
                    </div>

                    <div class="d-flex align-items-center gap-4">
                        <div>
                            <span class="small text-muted">Price per pax:</span>
                            <div class="h5 fw-bold text-dark mb-0">₱<?php echo number_format($base_price, 2); ?></div>
                        </div>
                        <div class="bg-light rounded-pill px-3 py-2 d-flex align-items-center gap-3">
                            <a href="?tour_id=<?php echo $tour_id ?>&pax=<?php echo max(1, $pax - 1) ?>&client_region=<?php echo $client_region ?>&voucher=<?php echo $voucher_code ?>" class="btn btn-sm btn-light rounded-circle fw-bold shadow-sm">-</a>
                            <span class="fw-bold px-2"><?php echo $pax; ?></span>
                            <a href="?tour_id=<?php echo $tour_id ?>&pax=<?php echo $pax + 1 ?>&client_region=<?php echo $client_region ?>&voucher=<?php echo $voucher_code ?>" class="btn btn-sm btn-light rounded-circle fw-bold shadow-sm">+</a>
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
                            <div class="text-muted small">Island Destination</div>
                            <div class="fw-bold text-dark"><?php echo $tour['island_name']; ?></div>
                        </div>
                        <div class="col-6">
                            <div class="text-muted small mb-1">Booking Status</div>
                            <span class="badge                                           <?php echo $badge_class; ?> border fw-bold rounded-pill px-3 shadow-sm">
                                <i class="fas                                          <?php echo $icon; ?> me-1"></i><?php echo $status; ?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="h5 text-success fw-bold mb-3">Personal & Pickup Information</div>
                <div class="mb-3 text-muted small">
                    <i class="fas fa-lock text-success me-1"></i> Secure and encrypted data handling.
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <form id="bookingForm" method="GET">
                        <input type="hidden" name="tour_id" value="<?php echo $tour_id; ?>">
                        <input type="hidden" name="pax" value="<?php echo $pax; ?>">
                        <input type="hidden" name="voucher" value="<?php echo $voucher_code; ?>">
                        <input type="hidden" name="schedule_id" value="1">
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-success">Where are you traveling from?</label>
                            <div class="d-flex gap-4">
                                <?php foreach (['Luzon', 'Visayas', 'Mindanao'] as $reg): ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="client_region" value="<?php echo $reg ?>"
                                            <?php echo ($client_region == $reg) ? 'checked' : ''; ?>
                                            onchange="this.form.submit()">
                                        <label class="form-check-label small"><?php echo $reg ?></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-12">
                                <label class="form-label small fw-bold">Pickup Location Name (e.g. NAIA T3)</label>
                                <input type="text" name="loc_name" class="form-control rounded-3 shadow-sm border-light" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label small fw-bold">Detailed Pickup Address</label>
                                <textarea name="loc_addr" class="form-control rounded-3 shadow-sm border-light" rows="2" required></textarea>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-5">
                                <label class="form-label small fw-bold">First Name</label>
                                <input type="text" class="form-control" value="<?php echo $user['first_name'] ?? ''; ?>" readonly>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label small fw-bold">Last Name</label>
                                <input type="text" class="form-control" value="<?php echo $user['last_name'] ?? ''; ?>" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label small fw-bold">M.I.</label>
                                <input type="text" class="form-control" value="<?php echo $user['middle_initial'] ?? ''; ?>" readonly>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-7">
                                <label class="form-label small fw-bold">Email Address</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $user['email'] ?? ''; ?>" readonly>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label small fw-bold">Contact Number</label>
                                <input type="text" name="contact_no" class="form-control" value="<?php echo $user['contact_no'] ?? ''; ?>" readonly>
                            </div>
                        </div>
                        <div class="mt-2 small text-muted">
                            <i class="fas fa-info-circle me-1"></i> These details are pulled from your profile.
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-5">
                <div class="h5 text-success fw-bold mb-3">Purchase Summary</div>
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <div class="d-flex justify-content-between mb-2 small">
                        <span class="text-muted">Subtotal (<?php echo $pax ?> pax)</span>
                        <span class="fw-bold text-dark">₱<?php echo number_format($subtotal, 2); ?></span>
                    </div>

                    <?php if ($airfare_fee > 0): ?>
                        <div class="d-flex justify-content-between mb-2 text-danger small">
                            <span><i class="fas fa-plane me-1"></i> Additional Airfare Fee</span>
                            <span class="fw-bold">+ ₱<?php echo number_format($airfare_fee, 2); ?></span>
                        </div>
                    <?php endif; ?>

                    <div class="d-flex justify-content-between mb-2 small">
                        <span class="text-muted">VAT (12%)</span>
                        <span class="text-dark">₱<?php echo number_format($vat, 2); ?></span>
                    </div>

                    <hr class="my-3">

                    <label class="small fw-bold text-success mb-2">Apply Promo Code</label>
                    <form action="" method="GET" class="d-flex gap-2 mb-2">
                        <input type="hidden" name="tour_id" value="<?php echo $tour_id; ?>">
                        <input type="hidden" name="pax" value="<?php echo $pax; ?>">
                        <input type="hidden" name="client_region" value="<?php echo $client_region; ?>">
                        <input type="text" name="voucher" class="form-control form-control-sm" placeholder="Enter code" value="<?php echo htmlspecialchars($voucher_code); ?>">
                        <button type="submit" class="btn btn-success btn-sm px-3">Apply</button>
                    </form>

                    <?php if ($discount > 0): ?>
                        <div class="d-flex justify-content-between text-success small fw-bold mt-2">
                            <span>Voucher Discount:</span>
                            <span>- ₱<?php echo number_format($discount, 2); ?></span>
                        </div>
                    <?php elseif (! empty($voucher_error)): ?>
                        <div class="text-danger" style="font-size:0.7rem;"><?php echo $voucher_error; ?></div>
                    <?php endif; ?>

                    <hr class="my-3">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="h5 fw-bold mb-0 text-dark">Total Amount</span>
                        <span class="h4 fw-bold text-success mb-0">₱<?php echo number_format($total, 2); ?></span>
                    </div>

                    <div class="card border-0 shadow-none bg-light p-3 text-center mb-4 rounded-3">
                        <div class="small text-muted mb-2 text-uppercase fw-bold" style="letter-spacing:1px;">Secure Payment</div>
                        <div class="d-flex justify-content-center gap-3">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" width="60">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/b/b7/MasterCard_Logo.svg" width="30">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" width="35">
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <div id="paypal-button-container"></div>
                        <a href="tour_details.php?tour_id=<?php echo $tour_id ?>" class="btn btn-outline-danger w-100 py-3 fw-bold rounded-3 shadow-sm border-2">
                            CANCEL BOOKING
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://www.paypal.com/sdk/js?client-id=AZXarGlWci9EF_NV33Uzb79jiNCHrRaA9WCLLFRpl0Tuzul7OIh5Pgc1Frl114bn2MNsUgR1kphO2D1z&currency=PHP"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const form = document.getElementById('bookingForm');

                paypal.Buttons({
                    style: {
                        layout: 'vertical',
                        color: 'gold',
                        shape: 'rect',
                        label: 'pay'
                    },

                    createOrder: function(data, actions) {
                        const scheduleInput = document.querySelector('select[name="schedule_id"]');
                        const schedule_id = scheduleInput ? scheduleInput.value : 1;

                        return fetch('paypal/createOrder.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded'
                                },
                                body: new URLSearchParams({
                                    tour_id: '<?php echo $tour_id ?>',
                                    pax: '<?php echo $pax ?>',
                                    client_region: '<?php echo $client_region ?>',
                                    voucher_code: '<?php echo $voucher_code ?>',
                                    schedule_id: schedule_id
                                })
                            })
                            .then(res => res.json())
                            .then(orderData => {
                                if (orderData.id) return orderData.id;
                                else throw new Error('Order creation failed');
                            });
                    },

                    onApprove: function(data, actions) {
                        const locName = document.querySelector('input[name="loc_name"]').value;
                        const locAddr = document.querySelector('textarea[name="loc_addr"]').value;
                        const schedId = document.querySelector('select[name="schedule_id"]').value;

                        if (!locName.trim() || !locAddr.trim()) {
                            alert("Please fill in your Pickup Location Name and Address first.");
                            return;
                        }

                        return fetch('paypal/captureOrder.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded'
                                },
                                body: new URLSearchParams({
                                    orderID: data.orderID,
                                    tour_id: '<?php echo $tour_id; ?>',
                                    pax: '<?php echo $pax; ?>',
                                    schedule_id: schedId,
                                    total_amount: '<?php echo $total; ?>'
                                })
                            })
                            .then(res => res.text())
                            .then(text => {
                                try {
                                    const details = JSON.parse(text);
                                    console.log("Server Response:", details);

                                    if (details.success) {
                                        //ayaw gumana n2 idk why huhu
                                        window.location.href = "confirmation.php?ref=" + details.ref;
                                    } else {
                                        alert('Booking Error: ' + details.message);
                                    }
                                } catch (e) {
                                    console.error("Non-JSON response received:", text);
                                    alert("Fatal Error: Check your Network Tab for the PHP error message.");
                                }
                            })
                            .catch(err => {
                                console.error('Fetch Error:', err);
                                alert("Cannot connect to server.");
                            });
                    },

                    onCancel: function(data) {
                        alert("Payment cancelled.");
                    },

                    onError: function(err) {
                        console.error("PayPal Error:", err);
                        alert("An error occurred with the PayPal integration.");
                    }

                }).render('#paypal-button-container');
            });
        </script>
    </div>
    <?php include "components/footer.php"; ?>
</body>

</html>