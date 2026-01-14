<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once __DIR__ . "/../php/connect.php";

$user_id = $_SESSION['user_id'] ?? 0;
$myVouchers = [];

if ($user_id > 0) {
    // UPDATED SQL: Ensure we select System_type (or external_system depending on your actual column name)
    // CHANGE: t.template_id TO t.voucher_id
    $fetch_sql = "SELECT t.code, t.title, t.discount_amount, t.discount_type, t.System_type
                FROM user_vouchers uv
                JOIN voucher_templates t ON uv.voucher_id = t.voucher_id
                WHERE uv.user_id = ? AND uv.is_redeemed = 0 AND t.expires_at > NOW()";

    $stmt = $conn->prepare($fetch_sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $amount_str = ($row['discount_type'] == 'percentage')
            ? $row['discount_amount'] . "%"
            : "₱" . number_format($row['discount_amount'], 0);

        // Logic to determine source
        $is_ebook = ($row['System_type'] == 'ebook_store');
        $source_label = $is_ebook ? "E-Book Store" : "Travel Agency";

        $myVouchers[] = [
            "code" => $row['code'],
            "source" => $source_label,
            "is_ebook" => $is_ebook,
            "description" => "$amount_str discount for your next " . ($is_ebook ? "reading adventure" : "trip"),
            "link" => "/EscaPinas/frontend/packages.php"
        ];
    }
}
?>

<h4 class="fw-bold text-success">My Vouchers</h4>
<p class="text-muted small">These are the vouchers you've collected. Use them on your next booking!</p>

<div class="mt-2">
    <?php if (!empty($myVouchers)): ?>
        <?php foreach ($myVouchers as $voucher): ?>
            <div class="d-flex justify-content-between align-items-center border p-3 mb-3 shadow-sm"
                style="border-radius: 15px; background: #ffffff; border-left: 6px solid <?= $voucher['is_ebook'] ? '#0d6efd' : '#1aa866'; ?> !important;">
                <div style="flex: 1;">
                    <div class="mb-1">
                        <span class="badge <?= $voucher['is_ebook'] ? 'bg-primary' : 'bg-success'; ?> bg-opacity-10 <?= $voucher['is_ebook'] ? 'text-primary' : 'text-success'; ?> fw-bold uppercase" style="font-size: 10px; letter-spacing: 0.5px;">
                            <i class="bi <?= $voucher['is_ebook'] ? 'bi-book' : 'bi-airplane'; ?> me-1"></i>
                            <?= $voucher['source']; ?>
                        </span>
                    </div>

                    <div class="fw-bold text-dark small mb-1">PROMO CODE: <?= htmlspecialchars($voucher['code']); ?></div>
                    <p class="mb-0 text-muted fw-semibold" style="font-size: 14px;"><?= htmlspecialchars($voucher['description']); ?></p>
                </div>
                <div class="ms-3">
                    <a href="<?= $voucher['link']; ?>" onclick="copyAndGo('<?= addslashes($voucher['code']); ?>', '<?= $voucher['link']; ?>'); return false;"
                        class="btn <?= $voucher['is_ebook'] ? 'btn-outline-primary' : 'btn-success'; ?> fw-bold px-4" style="border-radius: 10px; font-size: 13px;">
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