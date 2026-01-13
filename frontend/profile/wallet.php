<?php
include_once __DIR__ . "/../php/connect.php";

$uid = $_SESSION['user_id'] ?? null;

if (!$uid) {
    echo "<div class='text-center py-5'><p class='text-muted'>Please log in to view your wallet.</p></div>";
    return;
}

// 1. Calculate Balance by Summing all transactions
$balanceQuery = "SELECT SUM(amount) AS total_balance FROM wallet_transactions WHERE user_id = $uid";
$balanceResult = executeQuery($balanceQuery);
$balanceData = mysqli_fetch_assoc($balanceResult);
$currentBalance = $balanceData['total_balance'] ?? 0.00;

// 2. Fetch Transaction History
$historyQuery = "SELECT * FROM wallet_transactions 
                  WHERE user_id = $uid 
                  ORDER BY created_at DESC";
$historyResult = executeQuery($historyQuery);
?>

<div class="mb-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-success m-0">My E-Wallet</h4>
        <span class="text-muted small">Updated as of <?= date('M d, Y') ?></span>
    </div>

    <div class="card border-0 shadow-sm rounded-4 bg-success text-white p-4 mb-4" 
         style="background: linear-gradient(45deg, #198754, #1ea362);">
        <div class="row align-items-center">
            <div class="col-8">
                <p class="mb-1 opacity-75">Available Balance</p>
                <h1 class="display-5 fw-bold mb-0">₱<?= number_format($currentBalance, 2) ?></h1>
            </div>
            <div class="col-4 text-end">
                <i class="bi bi-wallet2 display-3 opacity-25"></i>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white py-3 border-0">
            <h6 class="fw-bold m-0 text-dark">Transaction History</h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-muted small text-uppercase">
                    <tr>
                        <th class="ps-4">Details</th>
                        <th class="text-center">Type</th>
                        <th class="text-end pe-4">Amount</th>
                    </tr>
                </thead>
                <tbody class="small">
                    <?php if (mysqli_num_rows($historyResult) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($historyResult)): ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold text-dark"><?= htmlspecialchars($row['description']) ?></div>
                                    <div class="text-muted" style="font-size: 0.75rem;">
                                        <?= date('M d, Y • h:i A', strtotime($row['created_at'])) ?>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <?php 
                                        $badgeClass = 'bg-secondary';
                                        if($row['type'] == 'Refund') $badgeClass = 'bg-success-subtle text-success';
                                        if($row['type'] == 'Payment') $badgeClass = 'bg-danger-subtle text-danger';
                                    ?>
                                    <span class="badge rounded-pill <?= $badgeClass ?>"><?= $row['type'] ?></span>
                                </td>
                                <td class="text-end pe-4 fw-bold <?= $row['amount'] >= 0 ? 'text-success' : 'text-danger' ?>">
                                    <?= $row['amount'] >= 0 ? '+' : '' ?>₱<?= number_format($row['amount'], 2) ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center py-5 text-muted">
                                <i class="bi bi-clock-history d-block mb-2 h3"></i>
                                No transactions yet.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>