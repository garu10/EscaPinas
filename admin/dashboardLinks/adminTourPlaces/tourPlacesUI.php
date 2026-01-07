<?php
include_once("../frontend/php/connect.php");

$query = "SELECT p.*, t.tour_name 
          FROM tour_place p 
          JOIN tour_packages t ON p.tour_id = t.tour_id 
          ORDER BY t.tour_name ASC, p.day_number ASC";
$result = executeQuery($query);
?>

<div class="container-fluid p-0">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold text-success mb-1">Tour Attractions & Places</h4>
                <p class="text-muted small mb-0">Manage specific spots visited during each tour package.</p>
            </div>
            <button class="btn btn-success rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#addPlaceModal">
                <i class="bi bi-geo-alt-fill me-2"></i>Add Place
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
                                    <th class="py-3">Place Name</th>
                                    <th class="py-3">Tour Package</th>
                                    <th class="py-3 text-center">Day No.</th>
                                    <th class="py-3 pe-4 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(mysqli_num_rows($result) > 0): ?>
                                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td class="ps-4">
                                            <img src="/EscaPinas/frontend/<?= $row['image'] ?>" 
                                                 alt="Place" class="rounded-3 shadow-sm" 
                                                 style="width: 60px; height: 45px; object-fit: cover;">
                                        </td>
                                        <td><span class="fw-bold text-dark"><?= $row['place_name'] ?></span></td>
                                        <td class="small"><?= $row['tour_name'] ?></td>
                                        <td class="text-center"><span class="badge bg-light text-success border border-success px-3">Day <?= $row['day_number'] ?></span></td>
                                        <td class="pe-4 text-end">
                                            <button class="btn btn-light btn-sm rounded-circle shadow-sm me-1" 
                                                    data-bs-toggle="modal" data-bs-target="#editPlace<?= $row['place_id'] ?>">
                                                <i class="bi bi-pencil-square text-primary"></i>
                                            </button>
                                            <a href="dashboardLinks/adminTourPlaces/crud/deletePlace.php?id=<?= $row['place_id'] ?>" 
                                               class="btn btn-light btn-sm rounded-circle shadow-sm" 
                                               onclick="return confirm('Remove this place from the tour?')">
                                                <i class="bi bi-trash3 text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php include 'editPlaceModal.php'; ?>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr><td colspan="5" class="text-center py-5 text-muted">No places listed yet.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'addPlaceModal.php'; ?>