<?php
include_once("../frontend/php/connect.php");

$query = "SELECT * FROM regions ORDER BY island_id ASC";
$result = executeQuery($query);
?>

<div class="container-fluid p-0">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold text-success mb-1">Regions & Island Groups</h4>
                <p class="text-muted small mb-0">Manage the high-level geographical classifications for tours.</p>
            </div>
            <button class="btn btn-success rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#addRegionModal">
                <i class="bi bi-plus-lg me-2"></i>Add New Region
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
                                    <th class="ps-4 py-3" style="width: 100px;">ID</th>
                                    <th class="py-3" style="width: 250px;">Island Name</th>
                                    <th class="py-3">Description</th>
                                    <th class="py-3 pe-4 text-end" style="width: 150px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(mysqli_num_rows($result) > 0): ?>
                                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td class="ps-4 text-muted">#<?= $row['island_id'] ?></td>
                                        <td><span class="fw-bold text-dark"><?= $row['island_name'] ?></span></td>
                                        <td>
                                            <p class="text-muted small mb-0 text-truncate" style="max-width: 400px;">
                                                <?= $row['description'] ?>
                                            </p>
                                        </td>
                                        <td class="pe-4 text-end">
                                            <button class="btn btn-light btn-sm rounded-circle shadow-sm me-1" 
                                                    data-bs-toggle="modal" data-bs-target="#editRegion<?= $row['island_id'] ?>">
                                                <i class="bi bi-pencil-square text-primary"></i>
                                            </button>
                                            <a href="dashboardLinks/adminRegions/crud/deleteRegion.php?id=<?= $row['island_id'] ?>" 
                                               class="btn btn-light btn-sm rounded-circle shadow-sm" 
                                               onclick="return confirm('Deleting this region may affect linked destinations. Proceed?')">
                                                <i class="bi bi-trash3 text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php include 'editRegionModal.php'; ?>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr><td colspan="4" class="text-center py-5 text-muted">No regions found.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'addRegionModal.php'; ?>