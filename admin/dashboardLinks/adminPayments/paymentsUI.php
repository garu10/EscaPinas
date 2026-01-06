<?php
include_once("../frontend/php/connect.php");

$query = "SELECT p.*, u.first_name, u.last_name, b.booking_reference 
          FROM payments p
          JOIN users u ON p.user_id = u.user_id
          JOIN bookings b ON p.booking_id = b.booking_id
          ORDER BY p.created_at DESC";
$result = executeQuery($query);
?>

<div class="container-fluid p-0">
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold text-success mb-1">Payment Transactions</h4>
            <p class="text-muted small mb-0">Monitor all incoming PayPal transactions and payment statuses.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr class="text-secondary small">
                                    <th class="ps-4 py-3">Date</th>
                                    <th class="py-3">Reference</th>
                                    <th class="py-3">Client</th>
                                    <th class="py-3">PayPal ID</th>
                                    <th class="py-3">Amount</th>
                                    <th class="py-3">Status</th>
                                    <th class="py-3 pe-4 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(mysqli_num_rows($result) > 0): ?>
                                    <?php while($pay = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td class="ps-4 small"><?= date('M d, Y', strtotime($pay['created_at'])) ?></td>
                                        <td class="fw-bold"><?= $pay['booking_reference'] ?></td>
                                        <td><?= $pay['first_name'] . " " . $pay['last_name'] ?></td>
                                        <td class="small text-muted"><?= $pay['paypal_capture_id'] ?? 'N/A' ?></td>
                                        <td class="fw-bold text-success">₱<?= number_format($pay['amount'], 2) ?></td>
                                        <td>
                                            <span class="badge rounded-pill bg-<?= $pay['payment_status'] == 'COMPLETED' ? 'success' : 'warning' ?>">
                                                <?= $pay['payment_status'] ?>
                                            </span>
                                        </td>
                                        <td class="pe-4 text-end d-flex flex-row">
                                            <button class="btn btn-light btn-sm rounded-circle shadow-sm me-1" data-bs-toggle="modal" data-bs-target="#editPayment<?= $pay['payment_id'] ?>">
                                                <i class="bi bi-pencil-square text-primary"></i>
                                            </button>
                                            <a href="dashboardLinks/adminPayments/crud/deletePayment.php?id=<?= $pay['payment_id'] ?>" 
                                               class="btn btn-light btn-sm rounded-circle shadow-sm" onclick="return confirm('Delete this payment record?')">
                                                <i class="bi bi-trash3 text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php include 'editPaymentModal.php'; ?>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr><td colspan="7" class="text-center py-5 text-muted">No payment records found.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>