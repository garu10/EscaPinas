<?php
// Sample lang
$myVouchers = [
    [
        "code" => "NEWEXPLORER",
        "description" => "15% off your very first booking after account registration",
        "link" => "/EscaPinas/frontend/packages.php"
    ],
    [
        "code" => "GROUPGOALS",
        "description" => "₱3,000 flat discount for corporate or barkada bookings (10+ pax)",
        "link" => "/EscaPinas/frontend/packages.php"
    ],
    [
        "code" => "PAYPALPROMO",
        "description" => "₱400 cashback when paying via PayPal",
        "link" => "/EscaPinas/frontend/packages.php"
    ],
    [
        "code" => "APPYBIRTHDAY",
        "description" => "A special voucher sent via SMS during the user's birth month",
        "link" => "/EscaPinas/frontend/packages.php"
    ]
];
?>

<h4 class="fw-bold text-success">My Vouchers</h4>
<p class="text-muted small">These are the vouchers you've collected. Use them on your next booking!</p>

<div class="mt-2">
    <?php if (!empty($myVouchers)): ?>
        <?php foreach ($myVouchers as $voucher): ?>
            <div class="d-flex justify-content-between align-items-center border p-3 mb-3 shadow-sm"
                style="border-radius: 15px; background: #ffffff; border-left: 6px solid #1aa866 !important;">
                <div style="flex: 1;">
                    <div class="fw-bold text-success small mb-1">PROMO CODE: <?= $voucher['code']; ?></div>
                    <p class="mb-0 text-dark fw-semibold" style="font-size: 14px;"><?= $voucher['description']; ?></p>
                </div>
                <div class="ms-3">
                    <a href="<?= $voucher['link']; ?>" onclick="copyAndGo('<?= $voucher['code']; ?>', '<?= $voucher['link']; ?>'); return false;"
                        class="btn btn-success fw-bold px-4" style="border-radius: 10px; font-size: 13px;">
                        Use Now
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="text-center py-5 border" style="border-radius: 15px; background: #f9f9f9; border-style: dashed !important;">
            <i class="bi bi-ticket-perforated text-muted" style="font-size: 40px;"></i>
            <p class="text-muted mt-2 fw-semibold">You don't have any vouchers at the moment.</p>
            <p class="text-muted small">Check back later for exclusive promos and deals!</p>
        </div>
    <?php endif; ?>
</div>

<div id="toast" style="display:none; position:fixed; bottom:20px; left:50%; transform:translateX(-50%); background: #333333ff; color: #ffffff; padding:8px 16px; border-radius:20px; z-index:99; font-size:13px;">
    Code Copied! Use It Now!
</div>

<script>
    function copyAndGo(code, link) {
        navigator.clipboard.writeText(code);

        var t = document.getElementById('toast');
        t.style.display = 'block';

        setTimeout(() => window.location.href = link, 800);
    }
</script>