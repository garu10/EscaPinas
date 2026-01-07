<?php
    session_start();
    include_once "php/connect.php";

    if (!isset($_SESSION['user_id'])) {
        $redirect = isset($_GET['tour_id']) ? '?tour_id=' . intval($_GET['tour_id']) : '';
        header("Location: login.php$redirect");
        exit;
    }

    $user_id = $_SESSION['user_id'];

    $availableVouchers = [];
    $vQuery = "SELECT * FROM vouchers WHERE user_id = ? AND is_redeemed = 0"; 
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

    $tour_id = isset($_GET['tour_id']) ? intval($_GET['tour_id']) : 1;
    $pax = isset($_GET['pax']) ? max(1, intval($_GET['pax'])) : 1;
    $client_region = isset($_GET['client_region']) ? $_GET['client_region'] : "";

    $tourQuery = "SELECT t.*, d.destination_name, r.island_name FROM tour_packages t 
                  JOIN destinations d ON t.destination_id = d.destination_id 
                  JOIN regions r ON d.island_id = r.island_id WHERE t.tour_id = $tour_id";
    $tourResult = executeQuery($tourQuery);
    $tour = ($tourResult) ? $tourResult->fetch_assoc() : null;
    if (!$tour) { die("Tour not found."); }

    $base_price = floatval($tour['price']);
    $subtotal = $base_price * $pax;
    $airfare_fee = 0.00;
    if (!empty($client_region)) {
        $stmtF = $conn->prepare("SELECT additional_fee FROM region_fees WHERE origin_island=? AND destination_island=?");
        $stmtF->bind_param("ss", $client_region, $tour['island_name']);
        $stmtF->execute();
        $feeRes = $stmtF->get_result();
        if ($f = $feeRes->fetch_assoc()) { $airfare_fee = floatval($f['additional_fee']) * $pax; }
    }
    $vat = ($subtotal + $airfare_fee) * 0.12;
    $total = ($subtotal + $airfare_fee + $vat);

    $schedules = executeQuery("SELECT * FROM tour_schedules WHERE tour_id = $tour_id");
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
        .tour-img { width: 100%; max-width: 400px; border-radius: 15px; object-fit: cover; }
        .voucher-card:hover { border-color: #198754 !important; cursor: pointer; background-color: #f0fff4; }
        .sticky-summary { position: sticky; top: 20px; }
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
                        <?php mysqli_data_seek($inclusions, 0); while ($inc = $inclusions->fetch_assoc()): ?>
                        <div class="mb-1"><i class="fas fa-check text-success me-2 small"></i><?php echo htmlspecialchars($inc['inclusion_detail']); ?></div>
                        <?php endwhile; ?>
                    </div>

                    <div class="d-flex align-items-center gap-4">
                        <div>
                            <span class="small text-muted">Price per pax:</span>
                            <div class="h5 fw-bold text-dark">₱<?php echo number_format($base_price, 2); ?></div>
                        </div>
                        <div class="bg-light rounded-pill px-3 py-2 d-flex align-items-center gap-3">
                            <a href="?tour_id=<?php echo $tour_id ?>&pax=<?php echo max(1, $pax - 1) ?>&client_region=<?php echo $client_region ?>" class="btn btn-sm btn-light rounded-circle shadow-sm">-</a>
                            <span class="fw-bold"><?php echo $pax; ?></span>
                            <a href="?tour_id=<?php echo $tour_id ?>&pax=<?php echo $pax + 1 ?>&client_region=<?php echo $client_region ?>" class="btn btn-sm btn-light rounded-circle shadow-sm">+</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-7">
                <div class="h5 text-success fw-bold mb-3">Booking Details</div>
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <form id="bookingForm">
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-success">Where are you traveling from?</label>
                            <div class="d-flex gap-4">
                                <?php foreach (['Luzon', 'Visayas', 'Mindanao'] as $reg): ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="client_region" value="<?php echo $reg ?>" <?php echo ($client_region == $reg) ? 'checked' : ''; ?> onchange="window.location.href='?tour_id=<?php echo $tour_id ?>&pax=<?php echo $pax ?>&client_region='+this.value">
                                    <label class="form-check-label small"><?php echo $reg ?></label>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold">Select Travel Date:</label>
                            <select id="schedule_id" class="form-select form-select-sm w-50">
                                <?php mysqli_data_seek($schedules, 0); while ($s = $schedules->fetch_assoc()): ?>
                                <option value="<?php echo $s['schedule_id']; ?>"><?php echo date('M d, Y', strtotime($s['start_date'])); ?> - <?php echo date('M d, Y', strtotime($s['end_date'])); ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold">Pickup/Dropoff Point</label>
                            <div class="border rounded-3 p-3 bg-light">
                                <?php
                                if (!empty($client_region)) {
                                    $locQ = ($airfare_fee > 0) ? "SELECT * FROM location_points WHERE origin_island='Tours Requiring AirTravel'" : "SELECT * FROM location_points WHERE origin_island='$client_region'";
                                    $lRes = executeQuery($locQ);
                                    while ($l = $lRes->fetch_assoc()) {
                                        echo "<div class='form-check mb-2'><input class='form-check-input' type='radio' name='locpoints_id' value='{$l['locpoints_id']}' required> <label class='small'>".htmlspecialchars($l['pickup_points'])."</label></div>";
                                    }
                                } else { echo "<small class='text-muted'>Select region first.</small>"; }
                                ?>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-5"><label class="small fw-bold">First Name</label><input type="text" class="form-control" value="<?php echo htmlspecialchars($user['first_name'] ?? ''); ?>" readonly></div>
                            <div class="col-md-5"><label class="small fw-bold">Last Name</label><input type="text" class="form-control" value="<?php echo htmlspecialchars($user['last_name'] ?? ''); ?>" readonly></div>
                            <div class="col-md-2"><label class="small fw-bold">M.I.</label><input type="text" class="form-control" value="<?php echo htmlspecialchars($user['middle_initial'] ?? ''); ?>" readonly></div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-5">
                <div class="sticky-summary">
                    <div class="h5 text-success fw-bold mb-3">Purchase Summary</div>
                    <div class="card border-0 shadow-sm rounded-4 p-4">
                        <div class="d-flex justify-content-between mb-2 small"><span>Subtotal</span> <span class="fw-bold">₱<?php echo number_format($subtotal, 2); ?></span></div>
                        <?php if ($airfare_fee > 0): ?><div class="d-flex justify-content-between mb-2 text-danger small"><span><i class="fas fa-plane"></i> Airfare</span> <span class="fw-bold">+ ₱<?php echo number_format($airfare_fee, 2); ?></span></div><?php endif; ?>
                        <div class="d-flex justify-content-between mb-2 small"><span>VAT (12%)</span> <span>₱<?php echo number_format($vat, 2); ?></span></div>
                        
                        <div id="discountDisplay" class="d-none justify-content-between text-success small fw-bold mt-2"><span>Discount</span> <span id="discountValue">- ₱0.00</span></div>
                        <hr>
                        <label class="small fw-bold text-success mb-2">Apply Voucher</label>
                        <div class="input-group mb-2">
                            <input type="text" id="voucherInput" class="form-control form-control-sm" placeholder="Code">
                            <button class="btn btn-outline-success btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#voucherModal"><i class="fas fa-ticket-alt"></i></button>
                            <button type="button" id="applyVoucherBtn" class="btn btn-success btn-sm">Apply</button>
                        </div>
                        <div id="voucherErrorMessage" class="text-danger d-none" style="font-size:0.7rem;"></div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span class="h5 fw-bold">Total</span>
                            <span class="h4 fw-bold text-success" id="totalAmountText">₱<?php echo number_format($total, 2); ?></span>
                        </div>
                        <div id="paypal-button-container"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="voucherModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white"><h5>Select Voucher</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=AZXarGlWci9EF_NV33Uzb79jiNCHrRaA9WCLLFRpl0Tuzul7OIh5Pgc1Frl114bn2MNsUgR1kphO2D1z&currency=PHP"></script>
    
    <script>
    const vouchersMap = <?php echo json_encode($js_voucher_list); ?>;
    const baseTotalVal = parseFloat("<?php echo $total; ?>");
    let finalTotal = baseTotalVal; // Ito ang gagamitin ng PayPal

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
        const discountDiv = document.getElementById('discountDisplay');
        const totalDisplay = document.getElementById('totalAmountText');
        const errorMsg = document.getElementById('voucherErrorMessage');

        if (amount > 0) {
            finalTotal = Math.max(0, baseTotalVal - amount);
            
            discountDiv.classList.remove('d-none');
            discountDiv.classList.add('d-flex');
            document.getElementById('discountValue').innerText = "- ₱" + amount.toLocaleString(undefined, {minimumFractionDigits: 2});
            errorMsg.classList.add('d-none');
            
            Swal.fire({ icon: 'success', title: 'Voucher Applied!', timer: 800, showConfirmButton: false });
        } else {
            finalTotal = baseTotalVal;
            discountDiv.classList.add('d-none');
            discountDiv.classList.remove('d-flex');
            if(code !== "") {
                errorMsg.innerText = "Invalid code.";
                errorMsg.classList.remove('d-none');
            }
        }

        totalDisplay.innerText = "₱" + finalTotal.toLocaleString(undefined, {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

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
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
            orderID: data.orderID,
            tour_id: '<?php echo $tour_id; ?>',
            pax: '<?php echo $pax; ?>',
            schedule_id: document.getElementById('schedule_id').value,
            total_amount: finalTotal.toFixed(2),
            locpoints_id: document.querySelector('input[name="locpoints_id"]:checked').value,
            voucher_code: document.getElementById('voucherInput').value
        })
    })
    .then(res => res.json())
    .then(res => {
        console.log("Response from PHP:", res); 
        if(res.success) {
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
</script>

</body>
</html>