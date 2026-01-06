<?php
include_once("../frontend/php/connect.php");
$query = "SELECT * FROM tour_packages ORDER BY tour_id DESC";
$result = executeQuery($query);
?>

<div class="container-fluid p-0">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold text-success mb-1">Tour Packages</h4>
                <p class="text-muted small mb-0">Manage your travel offerings and pricing.</p>
            </div>
            <button class="btn btn-success rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#addTourModal">
                <i class="bi bi-plus-lg me-2"></i>Add New Package
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
                                    <th class="ps-4 py-3">Image</th>
                                    <th class="py-3">Package Name</th>
                                    <th class="py-3">Duration</th>
                                    <th class="py-3">Price</th>
                                    <th class="py-3">Status</th>
                                    <th class="py-3 pe-4 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($tour = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td class="ps-4">
                                        <img src="/EscaPinas/frontend/<?= $tour['image'] ?>" class="rounded-3" style="width: 60px; height: 40px; object-fit: cover;">
                                    </td>
                                    <td>
                                        <div class="fw-bold"><?= $tour['tour_name'] ?></div>
                                        <div class="text-muted" style="font-size: 0.75rem;">ID: #<?= $tour['tour_id'] ?></div>
                                    </td>
                                    <td><?= $tour['duration_days'] ?>D / <?= $tour['duration_nights'] ?>N</td>
                                    <td class="text-success fw-bold">₱<?= number_format($tour['price'], 2) ?></td>
                                    <td>
                                        <span class="badge rounded-pill <?= $tour['status'] == 'Available' ? 'bg-success' : 'bg-danger' ?>">
                                            <?= $tour['status'] ?>
                                        </span>
                                    </td>
                                    <td class="pe-4 text-end">
                                        <button class="btn btn-light btn-sm rounded-circle shadow-sm" data-bs-toggle="modal" data-bs-target="#editTour<?= $tour['tour_id'] ?>">
                                            <i class="bi bi-pencil-square text-primary"></i>
                                        </button>
                                        <a href="dashboardLinks/adminTourpackages/crud/deleteTour.php?id=<?= $tour['tour_id'] ?>" 
                                           class="btn btn-light btn-sm rounded-circle shadow-sm" onclick="return confirm('Delete this package?')">
                                            <i class="bi bi-trash3 text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php include 'editTourModal.php'; ?>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'addTourModal.php'; ?>