<?php
//harcoded lang ito papalitan ito ng API url at iCURL pa, kapag okay na at ready iconnect kila adrian
$partner_vouchers = [
    [
        "title" => "Partner Welcome Gift",
        "type" => "fixed",
        "amount" => 100.00,
        "min_spend" => 500.00,
        "code" => "code1-PARTNER-100",
        "expiry" => "2024-12-31 23:59:59",
        "system" => "ebook_store"
    ],
    [
        "title" => "Reader's Discount",
        "type" => "percentage",
        "amount" => 10.00,
        "min_spend" => 0.00,
        "code" => "cod2-READ-10",
        "expiry" => "2024-11-30 23:59:59",
        "system" => "ebook_store" 
    ],
    [
        "title" => "wow's Discount",
        "type" => "fixed",
        "amount" => 10.00,
        "min_spend" => 30.00,
        "code" => "cod3-READ-10",
        "expiry" => "2024-11-30 23:59:59",
        "system" => "ebook_store" 
    ]
];
?>

<style>
</style>

<?php if (isset($_SESSION['user_id'])): 
    $user_id = $_SESSION['user_id'];
?>
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
        <?php foreach ($partner_vouchers as $v): 
            $v_code = $v['code'];
            $check_sql = "SELECT 1 FROM vouchers WHERE user_id = '$user_id' AND code = '$v_code' LIMIT 1";
            $check_res = mysqli_query($conn, $check_sql);
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
                            <?php echo ($v['type'] == 'percentage') ? $v['amount'].'%' : '₱'.$v['amount']; ?>
                        </h2>
                        <small class="fw-bold">OFF</small>
                    </div>

                    <div class="col-8 border-dashed-start bg-white">
                        <div class="card-body d-flex flex-column h-100 p-3">
                            <h6 class="fw-bold text-dark mb-1 text-truncate"><?php echo $v['title']; ?></h6>
                            <p class="small text-muted mb-2">Min. Spend: ₱<?php echo number_format($v['min_spend'], 2); ?></p>
                            
                            <div class="text-danger fw-bold mb-3" style="font-size: 0.75rem;">
                                <i class="bi bi-clock-history"></i> Expires: <?php echo date('M d, Y', strtotime($v['expiry'])); ?>
                            </div>

                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <small class="text-muted" style="font-size: 0.7rem;">
                                    <?php echo $is_claimed ? 'Saved to Wallet' : 'Limited Offer'; ?>
                                </small>
                                
                                <form class="claim-form">
                                    <input type="hidden" name="v_code" value="<?php echo $v['code']; ?>">
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
    </div>
</div>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<script src="/Escapinas/frontend/assets/js/vouchers.js"></script>