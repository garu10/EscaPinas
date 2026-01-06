<?php
include_once("../frontend/php/connect.php");

$query = "SELECT * FROM location_points ORDER BY origin_island ASC";
$result = executeQuery($query);
?>

<div class="container-fluid p-0">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold text-success mb-1">Transit Location Points</h4>
                <p class="text-muted small mb-0">Manage pickup and drop-off hubs across different regions.</p>
            </div>
            <button class="btn btn-success rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#addLocModal">
                <i class="bi bi-plus-lg me-2"></i>New Location Point
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
                                    <th class="ps-4 py-3">Island Group</th>
                                    <th class="py-3">Pickup Hubs</th>
                                    <th class="py-3">Drop-off Hubs</th>
                                    <th class="py-3 pe-4 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(mysqli_num_rows($result) > 0): ?>
                                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td class="ps-4">
                                            <span class="badge bg-secondary rounded-pill"><?= $row['origin_island'] ?></span>
                                        </td>
                                        <td class="text-dark small fw-semibold"><?= $row['pickup_points'] ?></td>
                                        <td class="text-dark small fw-semibold"><?= $row['dropoff_points'] ?></td>
                                        <td class="pe-4 text-end">
                                            <button class="btn btn-light btn-sm rounded-circle shadow-sm me-1" 
                                                    data-bs-toggle="modal" data-bs-target="#editLoc<?= $row['locpoints_id'] ?>">
                                                <i class="bi bi-pencil-square text-primary"></i>
                                            </button>
                                            <a href="dashboardLinks/adminLocationPoints/crud/deleteLoc.php?id=<?= $row['locpoints_id'] ?>" 
                                               class="btn btn-light btn-sm rounded-circle shadow-sm" 
                                               onclick="return confirm('Delete these location points?')">
                                                <i class="bi bi-trash3 text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php include 'editLocModal.php'; ?>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr><td colspan="4" class="text-center py-5 text-muted">No location points defined.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'addLocModal.php'; ?>