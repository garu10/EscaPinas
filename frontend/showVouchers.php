<?php
session_start();
include 'php/connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$_title="My Vouchers - Voucher System";
$query = "SELECT 
            t.code, 
            t.discount_type, 
            t.discount_amount, 
            t.expires_at, 
            t.System_type, 
            uv.is_redeemed 
          FROM user_vouchers uv
          JOIN voucher_templates t ON uv.voucher_id = t.voucher_id
          WHERE uv.user_id = '$user_id' 
          ORDER BY uv.claim_id DESC";

$result = executeQuery($query);

if (!$result) {
    die("Error fetching vouchers: " . mysqli_error($conn));
}
?>
<!doctype html>
<html lang="en">

<head>
    <?php include "components/header.php"; ?>
    <link rel="stylesheet" href="/css/voucher.css">
    <style>
        .ticket-card {
            border: none;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.08));
        }

        .border-dashed-start {
            border-left: 2px dashed #dee2e6 !important;
            position: relative;
        }

        .ticket-card::before,
        .ticket-card::after {
            content: '';
            position: absolute;
            left: 33.33%;
            width: 16px;
            height: 16px;
            background: #f8f9fa;
            border-radius: 50%;
            z-index: 10;
            transform: translateX(-50%);
        }

        .ticket-card::before {
            top: -8px;
        }

        .ticket-card::after {
            bottom: -8px;
        }
    </style>
</head>

<body>

    <?php include "components/navbar.php"; ?>

    <div class="container my-5">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="fw-bold text-success">My Voucher Wallet</h2>
                <p class="text-muted">Manage your claimed rewards and discounts here.</p>
            </div>
        </div>

        <div class="row g-4">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($v = mysqli_fetch_assoc($result)):
                    $isUsed = $v['is_redeemed'] == 1;
                ?>
                    <div class="col-lg-6">
                        <div class="card ticket-card rounded-4 overflow-hidden position-relative <?php echo $isUsed ? 'opacity-75' : ''; ?>"
                            style="<?php echo $isUsed ? 'filter: grayscale(1);' : ''; ?>">

                            <div class="row g-0 align-items-stretch">
                                <div class="col-4 p-4 text-center <?php echo $isUsed ? 'bg-secondary' : 'bg-success'; ?> text-white d-flex flex-column justify-content-center">
                                    <small class="text-uppercase opacity-75 d-block mb-1" style="font-size: 0.6rem;">
                                        <?php echo htmlspecialchars(str_replace('_', ' ', $v['System_type'])); ?>
                                    </small>
                                    <h2 class="fw-bold mb-0">
                                        <?php echo ($v['discount_type'] == 'percentage') ? $v['discount_amount'] . '%' : '₱' . number_format($v['discount_amount'], 0); ?>
                                    </h2>
                                    <small class="fw-bold">OFF</small>

                                    <?php if ($isUsed): ?>
                                        <div class="mt-2"><span class="badge bg-dark">USED</span></div>
                                    <?php endif; ?>
                                </div>

                                <div class="col-8 bg-white border-dashed-start">
                                    <div class="card-body p-4 d-flex flex-column h-100">
                                        <h6 class="fw-bold text-muted small mb-2 text-uppercase">Voucher Code</h6>
                                        <div class="bg-light p-2 rounded-3 border text-center mb-3">
                                            <span class="h5 fw-mono fw-bold <?php echo $isUsed ? 'text-muted' : 'text-success'; ?> mb-0">
                                                <?php echo htmlspecialchars($v['code']); ?>
                                            </span>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mt-auto pt-2 border-top">
                                            <small class="text-muted" style="font-size: 0.75rem;">
                                                <i class="bi bi-clock me-1"></i> Exp: <?php echo date('M d, Y', strtotime($v['expires_at'])); ?>
                                            </small>
                                            <?php if (!$isUsed): ?>
                                                <button class="btn btn-sm btn-outline-success rounded-pill px-3 copy-btn" data-code="<?php echo $v['code']; ?>">
                                                    <i class="bi bi-clipboard"></i> Copy
                                                </button>
                                            <?php else: ?>
                                                <span class="badge text-secondary border">Redeemed</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <i class="bi bi-ticket-perforated text-muted display-1"></i>
                    <h4 class="mt-3 text-muted">No vouchers found</h4>
                    <a href="/../index.php" class="btn btn-success rounded-pill mt-3">Browse Vouchers</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php include "components/footer.php"; ?>

    <script>
        document.querySelectorAll('.copy-btn').forEach(button => {
            button.addEventListener('click', function() {
                const code = this.getAttribute('data-code');
                navigator.clipboard.writeText(code).then(() => {
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="bi bi-check"></i> Copied!';
                    this.classList.replace('btn-outline-success', 'btn-success');
                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.classList.replace('btn-success', 'btn-outline-success');
                    }, 2000);
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>