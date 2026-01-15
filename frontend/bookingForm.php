<?php
$_title="Book Tour";
session_start();
include_once "php/connect.php";

// prefer POST, fallback to GET
$tour_id = isset($_POST['tour_id']) ? intval($_POST['tour_id']) : (isset($_GET['tour_id']) ? intval($_GET['tour_id']) : 1);
$pax = isset($_POST['pax']) ? max(1, intval($_POST['pax'])) : (isset($_GET['pax']) ? max(1, intval($_GET['pax'])) : 1);
$client_region = isset($_POST['client_region']) ? $_POST['client_region'] : (isset($_GET['client_region']) ? $_GET['client_region'] : '');

if (!isset($_SESSION['user_id'])) {
    $redirect = '?tour_id=' . $tour_id; // keep simple redirect to login
    header("Location: login.php$redirect");
    exit;
}

$user_id = $_SESSION['user_id'];

$availableVouchers = [];

$vQuery = "SELECT t.code, t.discount_amount, t.discount_type 
           FROM user_vouchers uv
           JOIN voucher_templates t ON uv.voucher_id = t.voucher_id
           WHERE uv.user_id = ? AND uv.is_redeemed = 0 AND t.expires_at > NOW()";

$stmtV = $conn->prepare($vQuery);
$stmtV->bind_param("i", $user_id);
$stmtV->execute();
$vRes = $stmtV->get_result();

if ($vRes) {
    while ($row = $vRes->fetch_assoc()) {
        $availableVouchers[] = $row;
    }
}

$js_voucher_list = [];
foreach ($availableVouchers as $v) {
    $js_voucher_list[$v['code']] = floatval($v['discount_amount']);
}

$userResult = executeQuery("SELECT * FROM users WHERE user_id = $user_id");
$user = ($userResult) ? $userResult->fetch_assoc() : null;



// Get user's wallet balance
$walletQuery = "SELECT running_balance FROM refund_wallet 
                WHERE user_id = $user_id 
                ORDER BY updated_at DESC LIMIT 1";
$walletResult = executeQuery($walletQuery);
$walletData = mysqli_fetch_assoc($walletResult);
$userWalletBalance = $walletData['running_balance'] ?? 0.00;

$tour_id = isset($_GET['tour_id']) ? intval($_GET['tour_id']) : 1;
$pax = isset($_GET['pax']) ? max(1, intval($_GET['pax'])) : 1;
$client_region = isset($_GET['client_region']) ? $_GET['client_region'] : "";


$tourQuery = "SELECT t.*, d.destination_name, r.island_name FROM tour_packages t 
                  JOIN destinations d ON t.destination_id = d.destination_id 
                  JOIN regions r ON d.island_id = r.island_id WHERE t.tour_id = $tour_id";
$tourResult = executeQuery($tourQuery);
$tour = ($tourResult) ? $tourResult->fetch_assoc() : null;
if (!$tour) {
    die("Tour not found.");
}

$base_price = floatval($tour['price']);
$subtotal = $base_price * $pax;
$airfare_fee = 0.00;
if (!empty($client_region)) {
    $stmtF = $conn->prepare("SELECT additional_fee FROM region_fees WHERE origin_island=? AND destination_island=?");
    $stmtF->bind_param("ss", $client_region, $tour['island_name']);
    $stmtF->execute();
    $feeRes = $stmtF->get_result();
    if ($f = $feeRes->fetch_assoc()) {
        $airfare_fee = floatval($f['additional_fee']) * $pax;
    }
}
$vat = ($subtotal + $airfare_fee) * 0.12;
$total = ($subtotal + $airfare_fee + $vat);

$schedules = executeQuery("SELECT * FROM tour_schedules 
                            WHERE tour_id = $tour_id 
                            AND available_slots >= $pax 
                            AND start_date >= CURDATE()");
$inclusions = executeQuery("SELECT * FROM tour_inclusions WHERE tour_id = $tour_id");
?>

<?php include "components/header.php"; ?>

<link rel="stylesheet" href="..\frontend\assets\css\bookingForm.css">


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

        .voucher-card:hover {
            border-color: #198754 !important;
            cursor: pointer;
            background-color: #f0fff4;
        }

        .sticky-summary {
            position: sticky;
            top: 20px;
        }

        .payment-methods .form-check-input:checked {
            background-color: #198754;
            border-color: #198754;
        }

        .payment-methods .form-check-label {
            cursor: pointer;
            transition: color 0.2s;
        }

        .payment-methods .form-check-label:hover {
            color: #198754;
        }

        #payWithWalletBtn {
            position: relative;
            z-index: 10;
            cursor: pointer;
        }

        #payWithWalletBtn:disabled {
            cursor: not-allowed;
            opacity: 0.6;
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
                    <img src="<?php echo htmlspecialchars($tour['image']); ?>" class="tour-img shadow-sm">
                </div>
                <div class="col-md-8">
                    <div class="h4 fw-bold mb-2"><?php echo htmlspecialchars($tour['tour_name']); ?></div>
                    <div class="row mb-3 text-muted small">
                        <div class="col"><i class="fas fa-map-marker-alt text-danger me-1"></i><?php echo htmlspecialchars($tour['destination_name']); ?></div>
                        <div class="col"><i class="far fa-clock text-primary me-1"></i><?php echo $tour['duration_days']; ?>D/<?php echo $tour['duration_nights']; ?>N</div>
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
                            <div class="h5 fw-bold text-dark">₱<?php echo number_format($base_price, 2); ?></div>
                        </div>
                        <div class="bg-light rounded-pill px-3 py-2 d-flex align-items-center gap-3">
                            <!-- buttons will submit the POST form -->
                            <button type="button" class="btn btn-sm btn-light rounded-circle shadow-sm" onclick="changePax(-1)">-</button>
                            <span class="fw-bold" id="paxDisplay"><?php echo $pax; ?></span>
                            <button type="button" class="btn btn-sm btn-light rounded-circle shadow-sm" onclick="changePax(1)">+</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-7">
                <div class="h5 text-success fw-bold mb-3">Booking Details</div>
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <form id="bookingForm" method="post">
                        <input type="hidden" name="tour_id" id="tour_id" value="<?= $tour_id ?>">
                        <input type="hidden" name="pax" id="pax" value="<?= $pax ?>">
                        <input type="hidden" name="client_region" id="client_region" value="<?= htmlspecialchars($client_region) ?>">

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-success">
                                Where are you traveling from?
                            </label>
                            <div class="d-flex gap-4">
                                <?php foreach (['Luzon', 'Visayas', 'Mindanao'] as $reg):
                                    $regId = "region_" . strtolower($reg);
                                ?>
                                    <div class="form-check">
                                        <input
                                            class="form-check-input region-radio"
                                            type="radio"
                                            name="client_region_radio"
                                            id="<?= $regId ?>"
                                            value="<?= $reg ?>"
                                            <?= ($client_region === $reg) ? 'checked' : '' ?>
                                            onchange="loadLocationPoints('<?= $reg ?>')">
                                        <label class="form-check-label small" for="<?= $regId ?>">
                                            <?= $reg ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold">Select Travel Date:</label>
                            <select id="schedule_id" name="schedule_id" class="form-select form-select-sm w-50" required>
                                <?php if (mysqli_num_rows($schedules) > 0): ?>
                                    <?php mysqli_data_seek($schedules, 0); while ($s = $schedules->fetch_assoc()): ?>
                                        <option value="<?php echo $s['schedule_id']; ?>">
                                            <?php echo date('M d, Y', strtotime($s['start_date'])); ?> 
                                            (<?php echo $s['available_slots']; ?> slots left)
                                        </option>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <option disabled selected>No available dates for <?php echo $pax; ?> pax</option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold">
                                Pickup / Dropoff Point
                            </label>
                            <div class="border rounded-3 p-3 bg-light" id="locationPointsContainer">
                                <small class='text-muted'>Select region first.</small>
                            </div>
                        </div>

                        <!-- USER INFO -->
                        <div class="row g-3">
                            <div class="col-md-5">
                                <label for="first_name" class="small fw-bold">First Name</label>
                                <input
                                    id="first_name"
                                    type="text"
                                    class="form-control"
                                    value="<?= htmlspecialchars($user['first_name'] ?? ''); ?>"
                                    readonly>
                            </div>

                            <div class="col-md-5">
                                <label for="last_name" class="small fw-bold">Last Name</label>
                                <input
                                    id="last_name"
                                    type="text"
                                    class="form-control"
                                    value="<?= htmlspecialchars($user['last_name'] ?? ''); ?>"
                                    readonly>
                            </div>

                            <div class="col-md-2">
                                <label for="middle_initial" class="small fw-bold">M.I.</label>
                                <input
                                    id="middle_initial"
                                    type="text"
                                    class="form-control"
                                    value="<?= htmlspecialchars($user['middle_initial'] ?? ''); ?>"
                                    readonly>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            <div class="col-md-5">
                <div class="sticky-summary">
                    <div class="h5 text-success fw-bold mb-3">Purchase Summary</div>
                    <div class="card border-0 shadow-sm rounded-4 p-4">
                        <div class="d-flex justify-content-between mb-2 small">
                            <span>Subtotal</span>
                            <span class="fw-bold">₱<?= number_format($subtotal, 2); ?></span>
                        </div>

                        <?php if ($airfare_fee > 0): ?>
                            <div class="d-flex justify-content-between mb-2 text-danger small">
                                <span><i class="fas fa-plane"></i> Airfare</span>
                                <span class="fw-bold">+ ₱<?= number_format($airfare_fee, 2); ?></span>
                            </div>
                        <?php endif; ?>

                        <div class="d-flex justify-content-between mb-2 small">
                            <span>VAT (12%)</span>
                            <span>₱<?= number_format($vat, 2) ?></span>
                        </div>

                        <div id="discountDisplay" class="d-none justify-content-between text-success small fw-bold mt-2">
                            <span>Discount</span>
                            <span id="discountValue">- ₱0.00</span>
                        </div>

                        <hr>

                        <label for="voucherInput" class="small fw-bold text-success mb-2">
                            Apply Voucher
                        </label>
                        <div class="input-group mb-2">
                            <input
                                type="text"
                                id="voucherInput"
                                class="form-control form-control-sm"
                                placeholder="Code">
                            <button class="btn btn-outline-success btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#voucherModal">
                                <i class="fas fa-ticket-alt"></i>
                            </button>
                            <button type="button" id="applyVoucherBtn" class="btn btn-success btn-sm">
                                Apply
                            </button>
                        </div>

                        <div id="voucherErrorMessage" class="text-danger d-none" style="font-size:0.7rem;"></div>

                        <hr>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span class="h5 fw-bold">Total</span>
                            <span class="h4 fw-bold text-success" id="totalAmountText">
                                ₱<?= number_format($total, 2); ?>
                            </span>
                        </div>

                        <!-- Payment Method Selection -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Payment Method</label>
                            <div class="payment-methods">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="payment_method" id="wallet_payment" value="wallet" checked>
                                    <label class="form-check-label d-flex align-items-center" for="wallet_payment">
                                        <i class="bi bi-wallet2 me-2"></i>
                                        Wallet Balance (₱<?= number_format($userWalletBalance, 2) ?>)
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="payment_method" id="paypal_payment" value="paypal">
                                    <label class="form-check-label d-flex align-items-center" for="paypal_payment">
                                        <i class="bi bi-paypal me-2"></i>
                                        PayPal / Credit Card
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Wallet Payment Button -->
                        <div id="wallet-payment-section">
                            <button type="button" id="payWithWalletBtn" class="btn btn-success w-100 mb-2">
                                <i class="bi bi-wallet2 me-2"></i>Pay with Wallet Balance
                            </button>
                            <div id="wallet-balance-warning" class="alert alert-warning py-2 small d-none">
                                <i class="bi bi-exclamation-triangle me-1"></i>
                                Insufficient wallet balance.
                            </div>
                        </div>

                        <!-- PayPal Payment Section -->
                        <div id="paypal-payment-section" style="display: none;">
                            <div id="paypal-button-container"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="voucherModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5>Select Voucher</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <?php foreach ($availableVouchers as $av): ?>
                        <div class="card mb-2 voucher-card p-3" onclick="selectVoucher('<?php echo $av['code']; ?>')">
                            <div class="fw-bold text-success"><?php echo $av['code']; ?></div>
                            <div class="small">₱<?php echo number_format($av['discount_amount'], 2); ?> OFF</div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <?php include "components/footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=AZXarGlWci9EF_NV33Uzb79jiNCHrRaA9WCLLFRpl0Tuzul7OIh5Pgc1Frl114bn2MNsUgR1kphO2D1z&currency=PHP"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

    <script>
        const vouchersMap = <?php echo json_encode($js_voucher_list); ?>;
        const baseTotalVal = parseFloat("<?php echo $total; ?>");
        let finalTotal = baseTotalVal; // Ito ang gagamitin ng PayPal

        // Load location points dynamically when region is selected
        function loadLocationPoints(region) {
            const container = document.getElementById('locationPointsContainer');
            const airfareFee = <?php echo $airfare_fee; ?>;
            
            // Prepare the query
            let query = '';
            if (airfareFee > 0) {
                query = "Tours Requiring AirTravel";
            } else {
                query = region;
            }
            
            // Fetch location points via AJAX
            fetch('api/get_location_points.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'region=' + encodeURIComponent(query)
            })
            .then(res => res.json())
            .then(data => {
                if (data.success && data.locations.length > 0) {
                    let html = '';
                    data.locations.forEach(loc => {
                        html += `
                            <div class='form-check mb-2'>
                                <input
                                    class='form-check-input'
                                    type='radio'
                                    name='locpoints_id'
                                    id='loc_${loc.locpoints_id}'
                                    value='${loc.locpoints_id}'
                                    required
                                >
                                <label class='form-check-label small' for='loc_${loc.locpoints_id}'>
                                    ${loc.pickup_points}
                                </label>
                            </div>`;
                    });
                    container.innerHTML = html;
                } else {
                    container.innerHTML = "<small class='text-muted'>No location points available for this region.</small>";
                }
            })
            .catch(err => {
                console.error('Error loading locations:', err);
                container.innerHTML = "<small class='text-danger'>Error loading locations.</small>";
            });
        }

        function changePax(delta) {
            const paxInput = document.getElementById('pax');
            let newPax = Math.max(1, parseInt(paxInput.value || '1') + delta);
            paxInput.value = newPax;
            document.getElementById('paxDisplay').innerText = newPax;
            document.getElementById('bookingForm').submit();
        }

        function setRegionAndSubmit(region) {
            document.getElementById('client_region').value = region;
            document.getElementById('bookingForm').submit();
        }

        function selectVoucher(code) {
            document.getElementById('voucherInput').value = code;

            const modalElement = document.getElementById('voucherModal');
            const modalInstance = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
            modalInstance.hide();

            const backdrops = document.querySelectorAll('.modal-backdrop');
            backdrops.forEach(b => b.remove());
            document.body.classList.remove('modal-open');
            document.body.style.paddingRight = '';

            applyVoucherLogic(code);
        }

        document.getElementById('applyVoucherBtn').addEventListener('click', function() {
            applyVoucherLogic(document.getElementById('voucherInput').value.trim());
        });

        function applyVoucherLogic(code) {
            const amount = vouchersMap[code] || 0;
            const amountNum = Number(amount);
            const discountDiv = document.getElementById('discountDisplay');
            const totalDisplay = document.getElementById('totalAmountText');
            const errorMsg = document.getElementById('voucherErrorMessage');

            if (amountNum > 0) {
                finalTotal = Math.max(0, baseTotalVal - amountNum);

                discountDiv.classList.remove('d-none');
                discountDiv.classList.add('d-flex');
                document.getElementById('discountValue').innerText = "- ₱" + amountNum.toLocaleString(undefined, {
                    minimumFractionDigits: 2
                });
                errorMsg.classList.add('d-none');

                Swal.fire({
                    icon: 'success',
                    title: 'Voucher Applied!',
                    timer: 800,
                    showConfirmButton: false
                });
            } else {
                finalTotal = baseTotalVal;
                discountDiv.classList.add('d-none');
                discountDiv.classList.remove('d-flex');
                if (code !== "") {
                    errorMsg.innerText = "Invalid code.";
                    errorMsg.classList.remove('d-none');
                }
            }

            totalDisplay.innerText = "₱" + finalTotal.toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            // Update wallet payment button state
            updateWalletPaymentButton();
        }

        function updateWalletPaymentButton() {
            const walletBalance = parseFloat("<?php echo $userWalletBalance; ?>");
            const payWithWalletBtn = document.getElementById('payWithWalletBtn');
            const warningDiv = document.getElementById('wallet-balance-warning');

            if (walletBalance < finalTotal) {
                payWithWalletBtn.disabled = true;
                payWithWalletBtn.innerHTML = '<i class="bi bi-wallet2 me-2"></i>Insufficient Balance';
                warningDiv.innerHTML = '<i class="bi bi-exclamation-triangle me-1"></i>Insufficient wallet balance. You need ₱' + (finalTotal - walletBalance).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2}) + ' more.';
                warningDiv.classList.remove('d-none');
            } else {
                payWithWalletBtn.disabled = false;
                payWithWalletBtn.innerHTML = '<i class="bi bi-wallet2 me-2"></i>Pay with Wallet Balance';
                warningDiv.classList.add('d-none');
            }
        }

        // Payment Method Switching
        document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const walletSection = document.getElementById('wallet-payment-section');
                const paypalSection = document.getElementById('paypal-payment-section');
                
                if (this.value === 'wallet') {
                    walletSection.style.display = 'block';
                    paypalSection.style.display = 'none';
                } else {
                    walletSection.style.display = 'none';
                    paypalSection.style.display = 'block';
                }
            });
        });

        // Wallet Payment Functionality
        document.getElementById('payWithWalletBtn').addEventListener('click', function() {
            const loc = document.querySelector('input[name="locpoints_id"]:checked');
            if (!loc) {
                Swal.fire('Requirement', 'Please select a Pickup Point first.', 'warning');
                return;
            }

            const walletBalance = parseFloat("<?php echo $userWalletBalance; ?>");
            if (walletBalance < finalTotal) {
                Swal.fire('Insufficient Balance', 'Your wallet balance is not enough to complete this payment.', 'error');
                return;
            }

            // Confirm payment
            Swal.fire({
                title: 'Confirm Payment',
                text: `Pay ₱${finalTotal.toLocaleString()} using wallet balance?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, Pay Now',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Process wallet payment
                    fetch('backend/process_wallet_payment.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: new URLSearchParams({
                            tour_id: '<?php echo $tour_id; ?>',
                            schedule_id: document.getElementById('schedule_id').value,
                            total_amount: finalTotal.toFixed(2),
                            locpoints_id: document.querySelector('input[name="locpoints_id"]:checked').value,
                            voucher_code: document.getElementById('voucherInput').value
                        })
                    })
                    .then(res => res.json())
                    .then(res => {
                        if (res.success) {
                            Swal.fire('Success!', 'Payment completed successfully!', 'success')
                            .then(() => {
                                window.location.href = "confirmation.php?ref=" + res.ref;
                            });
                        } else {
                            Swal.fire('Error', res.message, 'error');
                        }
                    })
                    .catch(err => {
                        console.error("Wallet Payment Error:", err);
                        Swal.fire('Error', 'Failed to process payment. Please try again.', 'error');
                    });
                }
            });
        });

        paypal.Buttons({
            createOrder: (data, actions) => {
                const loc = document.querySelector('input[name="locpoints_id"]:checked');
                if (!loc) {
                    Swal.fire('Requirement', 'Please select a Pickup Point first.', 'warning');
                    return;
                }

                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            currency_code: 'PHP',
                            value: finalTotal.toFixed(2)
                        }
                    }]
                });
            },
            onApprove: (data, actions) => {
                return fetch('integs/paypal/captureOrder.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: new URLSearchParams({
                            orderID: data.orderID,
                            tour_id: document.getElementById('tour_id').value,
                            pax: document.getElementById('pax').value,
                            schedule_id: document.getElementById('schedule_id').value,
                            total_amount: finalTotal.toFixed(2),
                            locpoints_id: document.querySelector('input[name="locpoints_id"]:checked').value,
                            voucher_code: document.getElementById('voucherInput').value
                        })
                    })
                    .then(res => res.json())
                    .then(res => {
                        console.log("Response from PHP:", res);
                        if (res.success) {
                            window.location.href = "confirmation.php?ref=" + res.ref;
                        } else {
                            Swal.fire('Error', res.message, 'error');
                        }
                    })
                    .catch(err => {
                        console.error("Fetch Error:", err);
                    });
            }
        }).render('#paypal-button-container');

        // Initialize wallet payment button state after DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            updateWalletPaymentButton();
        });
    </script>

</body>

</html>
