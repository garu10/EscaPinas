<?php
include_once("../frontend/php/connect.php");

$query = "SELECT * FROM region_fees ORDER BY origin_island ASC";
$result = executeQuery($query);
?>

<div class="container-fluid p-0">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold text-success mb-1">Region Fee Matrix</h4>
                <p class="text-muted small mb-0">Set surcharges for travel between different island groups.</p>
            </div>
            <button class="btn btn-success rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#addFeeModal">
                <i class="bi bi-plus-lg me-2"></i>Add Fee Rule
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
                                    <th class="ps-4 py-3">Origin</th>
                                    <th class="py-3 text-center"><i class="bi bi-arrow-right"></i></th>
                                    <th class="py-3">Destination</th>
                                    <th class="py-3">Additional Fee</th>
                                    <th class="py-3 pe-4 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(mysqli_num_rows($result) > 0): ?>
                                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td class="ps-4 fw-bold text-dark"><?= $row['origin_island'] ?></td>
                                        <td class="text-center text-muted"><i class="bi bi-airplane"></i></td>
                                        <td class="fw-bold text-dark"><?= $row['destination_island'] ?></td>
                                        <td class="text-success fw-bold">₱<?= number_format($row['additional_fee'], 2) ?></td>
                                        <td class="pe-4 text-end">
                                            <button class="btn btn-light btn-sm rounded-circle shadow-sm me-1" 
                                                    data-bs-toggle="modal" data-bs-target="#editFee<?= $row['fee_id'] ?>">
                                                <i class="bi bi-pencil-square text-primary"></i>
                                            </button>
                                            <a href="dashboardLinks/adminRegionFees/crud/deleteFee.php?id=<?= $row['fee_id'] ?>" 
                                               class="btn btn-light btn-sm rounded-circle shadow-sm" 
                                               onclick="return confirm('Delete this pricing rule?')">
                                                <i class="bi bi-trash3 text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php include 'editFeeModal.php'; ?>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr><td colspan="5" class="text-center py-5 text-muted">No region fees configured.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'addFeeModal.php'; ?>