<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$partner_vouchers = [];
$user_id = $_SESSION['user_id'] ?? 0;

if ($user_id > 0) {
    // This query selects templates that DO NOT have a matching entry in user_vouchers for this user
    $fetchVoucher = "SELECT template_id, code, discount_type as type, discount_amount as amount, 
                         min_order_amount as min_spend, expires_at as expiry, 
                         System_type as system, title 
                  FROM voucher_templates t
                  WHERE expires_at > NOW() 
                  AND NOT EXISTS (
                      SELECT 1 FROM user_vouchers uv 
                      WHERE uv.template_id = t.template_id 
                      AND uv.user_id = '$user_id'
                  )
                  ORDER BY created_at DESC 
                  LIMIT 4";

    $resultVoucher = executeQuery($fetchVoucher);

    if ($resultVoucher) {
        while ($row = mysqli_fetch_assoc($resultVoucher)) {
            $partner_vouchers[] = $row;
        }
    }
}
?>

<style>
    .ticket-card {
        border: none;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.08));
        transition: transform 0.2s;
    }

    .ticket-hover:hover {
        transform: translateY(-5px);
    }

    .border-dashed-start {
        border-left: 2px dashed #dee2e6 !important;
        position: relative;
    }

    .already-claimed {
        opacity: 0.7;
        filter: grayscale(0.5);
    }
</style>

<?php if (isset($_SESSION['user_id'])): ?>
    <div class="container mt-5 p-3">
        <div class="row mb-4 align-items-end">
            <div class="col-md-8 col-12 text-center text-md-start">
                <h3 class="fw-bold text-success mb-1">
                    <i class="bi bi-ticket-perforated-fill me-2"></i> Vouchers for You!
                </h3>
                <p class="text-muted mb-0">Claim exclusive rewards from EscaPinas and our trusted partners.</p>
            </div>
            <div class="col-md-4 col-12 text-md-end mt-2 mt-md-0">
                <a href="/Escapinas/frontend/showVouchers.php" class="text-decoration-none text-success fw-semibold">
                    View My Wallet <i class="bi bi-arrow-right-short"></i>
                </a>
            </div>
        </div>

        <div class="row g-4">
            <?php if (!empty($partner_vouchers)): ?>
                <?php foreach ($partner_vouchers as $v):
                    $template_id = $v['template_id'];
                    $check_sql = "SELECT 1 FROM user_vouchers WHERE user_id = '$user_id' AND template_id = '$template_id' LIMIT 1";
                    $check_res = executeQuery( $check_sql);
                    $is_claimed = (mysqli_num_rows($check_res) > 0);
                ?>
                    <div class="col-lg-6">
                        <div class="card ticket-card rounded-4 overflow-hidden ticket-hover <?php echo $is_claimed ? 'already-claimed' : ''; ?>">
                            <div class="row g-0 align-items-stretch">
                                <div class="col-4 text-center p-3 <?php echo $is_claimed ? 'bg-secondary' : 'bg-success'; ?> text-white d-flex flex-column justify-content-center">
                                    <small class="text-uppercase fw-bold opacity-75" style="font-size: 0.6rem;">
                                        <?php echo ($v['system'] == 'ebook_store') ? 'E-Book Store' : 'Travel Agency'; ?>
                                    </small>
                                    <h2 class="fw-bold mb-0">
                                        <?php echo ($v['type'] == 'percentage') ? $v['amount'] . '%' : '₱' . number_format($v['amount'], 0); ?>
                                    </h2>
                                    <small class="fw-bold">OFF</small>
                                </div>

                                <div class="col-8 border-dashed-start bg-white">
                                    <div class="card-body d-flex flex-column h-100 p-3">
                                        <h6 class="fw-bold text-dark mb-1 text-truncate"><?php echo htmlspecialchars($v['title']); ?></h6>
                                        <p class="small text-muted mb-2">Min. Spend: ₱<?php echo number_format($v['min_spend'], 2); ?></p>

                                        <div class="text-danger fw-bold mb-3" style="font-size: 0.75rem;">
                                            <i class="bi bi-clock-history"></i> Expires: <?php echo date('M d, Y', strtotime($v['expiry'])); ?>
                                        </div>

                                        <div class="mt-auto d-flex justify-content-between align-items-center">
                                            <small class="text-muted" style="font-size: 0.7rem;">
                                                <?php echo $is_claimed ? 'Saved to Wallet' : 'Limited Offer'; ?>
                                            </small>

                                            <form class="claim-form">
                                                <input type="hidden" name="template_id" value="<?php echo $v['template_id']; ?>">
                                                <input type="hidden" name="v_code" value="<?php echo htmlspecialchars($v['code']); ?>">
                                                <input type="hidden" name="v_type" value="<?php echo $v['type']; ?>">
                                                <input type="hidden" name="v_amount" value="<?php echo $v['amount']; ?>">
                                                <input type="hidden" name="v_min" value="<?php echo $v['min_spend']; ?>">
                                                <input type="hidden" name="v_expiry" value="<?php echo $v['expiry']; ?>">
                                                <input type="hidden" name="v_system" value="<?php echo $v['system']; ?>">

                                                <?php if ($is_claimed): ?>
                                                    <button type="button" class="btn btn-secondary btn-sm rounded-pill px-4 fw-bold" disabled>
                                                        Claimed
                                                    </button>
                                                <?php else: ?>
                                                    <button type="button" class="btn btn-success btn-sm rounded-pill px-4 fw-bold btn-claim-ajax">
                                                        Claim
                                                    </button>
                                                <?php endif; ?>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="text-center p-5 bg-light  rounded-4 shadow-sm">
                        <div class="display-4 text-warning mb-3">
                            <i class="bi bi-stars"></i>
                        </div>
                        <div class="h4 fw-bold text-dark">You're all caught up!</div>
                        <div class="text-muted mb-4">
                            You've claimed all available vouchers. We'll notify you when new <br class="d-none d-md-block">
                            exclusive discounts from our partners are available.
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/Escapinas/frontend/assets/js/vouchers.js"></script>