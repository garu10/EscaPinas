<?php
include_once("../frontend/php/connect.php");

// Fetching all voucher templates
$query = "SELECT * FROM voucher_templates ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<div class="container-fluid p-0">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold text-success mb-1">Voucher Management</h4>
                <p class="text-muted small mb-0">Create and manage discount templates for partners.</p>
            </div>
            <button class="btn btn-success rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#addVoucherModal">
                <i class="bi bi-plus-lg me-2"></i>Add New Voucher
            </button>
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
                                    <th class="ps-4 py-3">Code</th>
                                    <th class="py-3">Title & Min. Spend</th>
                                    <th class="py-3">Discount</th>
                                    <th class="py-3">System Type</th>
                                    <th class="py-3">Expiry</th>
                                    <th class="py-3 pe-4 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (mysqli_num_rows($result) > 0): ?>
                                    <?php while ($v = mysqli_fetch_assoc($result)): ?>
                                        <tr>
                                            <td class="ps-4">
                                                <code class="fw-bold text-success bg-light px-2 py-1 rounded"><?= $v['code'] ?></code>
                                            </td>
                                            <td>
                                                <span class="fw-bold text-dark"><?= htmlspecialchars($v['title']) ?></span>
                                                <div class="small text-muted">Min: ₱<?= number_format($v['min_order_amount'], 2) ?></div>
                                            </td>
                                            <td>
                                                <span class="badge bg-white text-success border border-success-subtle px-3">
                                                    <?= ($v['discount_type'] == 'percentage') ? $v['discount_amount'] . '%' : '₱' . number_format($v['discount_amount'], 0) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?php if ($v['System_type'] == 'travel_agency'): ?>
                                                    <span class="badge rounded-pill bg-success px-3">
                                                        <i class="bi bi-airplane-fill me-1"></i> Travel Agency
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge rounded-pill border border-success text-success px-3">
                                                        <i class="bi bi-book-fill me-1"></i> E-Book Store
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="small text-muted">
                                                <i class="bi bi-calendar-event me-1"></i>
                                                <?= date('M d, Y', strtotime($v['expires_at'])) ?>
                                            </td>
                                            <td class="pe-4 text-end">
                                                <button class="btn btn-light btn-sm rounded-circle shadow-sm me-1" data-bs-toggle="modal" data-bs-target="#editVoucher<?= $v['template_id'] ?>">
                                                    <i class="bi bi-pencil-square text-primary"></i>
                                                </button>
                                                <a href="dashboardLinks/adminVouchers/crud/deleteVoucher.php?id=<?= $v['template_id'] ?>"
                                                    class="btn btn-light btn-sm rounded-circle shadow-sm"
                                                    onclick="return confirm('Delete this voucher template permanently?')">
                                                    <i class="bi bi-trash3 text-danger"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        <?php include 'updateVouchermodal.php'; ?>

                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center py-5 text-muted">No vouchers found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'voucherModal.php'; ?>