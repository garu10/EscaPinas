<?php
include_once("../frontend/php/connect.php");

$query = "SELECT * FROM destinations ORDER BY destination_id DESC";
$result = executeQuery($query);
?>

<div class="container-fluid p-0">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold text-success mb-1">Destinations Management</h4>
                <p class="text-muted small mb-0">Add and manage travel regions and major destinations.</p>
            </div>
            <button class="btn btn-success rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#addDestModal">
                <i class="bi bi-plus-lg me-2"></i>Add Destination
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
                                    <th class="ps-4 py-3">ID</th>
                                    <th class="py-3">Destination Name</th>
                                    <th class="py-3">Description</th>
                                    <th class="py-3 text-center">Status</th>
                                    <th class="py-3 pe-4 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(mysqli_num_rows($result) > 0): ?>
                                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td class="ps-4 text-muted">#<?= $row['destination_id'] ?></td>
                                        <td class="fw-bold text-dark"><?= $row['destination_name'] ?></td>
                                        <td>
                                            <small class="text-muted d-inline-block text-truncate" style="max-width: 300px;">
                                                <?= $row['description'] ?>
                                            </small>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge rounded-pill <?= $row['status'] == 'Active' ? 'bg-success' : 'bg-danger' ?>">
                                                <?= $row['status'] ?>
                                            </span>
                                        </td>
                                        <td class="pe-4 text-end">
                                            <button class="btn btn-light btn-sm rounded-circle shadow-sm me-1" data-bs-toggle="modal" data-bs-target="#editDest<?= $row['destination_id'] ?>">
                                                <i class="bi bi-pencil-square text-primary"></i>
                                            </button>
                                            <a href="dashboardLinks/adminDestinations/crud/deleteDest.php?id=<?= $row['destination_id'] ?>" 
                                               class="btn btn-light btn-sm rounded-circle shadow-sm" 
                                               onclick="return confirm('Permanently delete this destination?')">
                                                <i class="bi bi-trash3 text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php include 'editDestModal.php'; ?>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr><td colspan="5" class="text-center py-5 text-muted">No destinations found.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'addDestModal.php'; ?>