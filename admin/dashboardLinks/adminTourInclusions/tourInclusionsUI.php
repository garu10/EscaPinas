<?php
include_once("../frontend/php/connect.php");

// Fetch inclusions joined with tour names for better context
$query = "SELECT i.*, t.tour_name 
          FROM tour_inclusions i
          JOIN tour_packages t ON i.tour_id = t.tour_id
          ORDER BY t.tour_name ASC";
$result = executeQuery($query);

// Fetch all tours for the "Add New" and "Edit" dropdowns
$toursQuery = "SELECT tour_id, tour_name FROM tour_packages ORDER BY tour_name ASC";
$toursResult = executeQuery($toursQuery);
$toursList = mysqli_fetch_all($toursResult, MYSQLI_ASSOC);
?>

<div class="container-fluid p-0">
    <div class="row mb-4 align-items-center">
        <div class="col-md-8">
            <h4 class="fw-bold text-success mb-1">Tour Inclusions</h4>
            <p class="text-muted small mb-0">Manage what is included in each tour package (e.g., Transportation, Meals, Fees).</p>
        </div>
        <div class="col-md-4 text-md-end">
            <button class="btn btn-success rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#addInclusionModal">
                <i class="bi bi-plus-lg me-1"></i> Add Inclusion
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
                                    <th class="ps-4 py-3">Inclusion ID</th>
                                    <th class="py-3">Tour Package</th>
                                    <th class="py-3">Inclusion Detail</th>
                                    <th class="py-3 pe-4 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(mysqli_num_rows($result) > 0): ?>
                                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td class="ps-4 small text-muted">#<?= $row['inclusion_id'] ?></td>
                                        <td class="fw-bold"><?= htmlspecialchars($row['tour_name']) ?></td>
                                        <td><?= htmlspecialchars($row['inclusion_detail']) ?></td>
                                        <td class="pe-4 text-end">
                                            <div class="d-flex justify-content-end gap-2">
                                                <button class="btn btn-light btn-sm rounded-circle shadow-sm" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#editInclusion<?= $row['inclusion_id'] ?>">
                                                    <i class="bi bi-pencil-square text-primary"></i>
                                                </button>
                                                <a href="dashboardLinks/adminTourInclusions/crud/deleteInclusion.php?id=<?= $row['inclusion_id'] ?>" 
                                                   class="btn btn-light btn-sm rounded-circle shadow-sm" 
                                                   onclick="return confirm('Delete this inclusion?')">
                                                    <i class="bi bi-trash3 text-danger"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php include 'editInclusionModal.php'; ?>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr><td colspan="4" class="text-center py-5 text-muted">No inclusions found.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'addInclusionModal.php'; ?>
