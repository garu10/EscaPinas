<?php
include_once("../frontend/php/connect.php");

$query = "SELECT a.*, t.tour_name 
          FROM tour_about a 
          JOIN tour_packages t ON a.tour_id = t.tour_id 
          ORDER BY t.tour_name ASC";
$result = executeQuery($query);
?>

<div class="container-fluid p-0">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold text-success mb-1">Tour Descriptions (About)</h4>
                <p class="text-muted small mb-0">Manage the detailed introductory content for each package.</p>
            </div>
            <button class="btn btn-success rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#addAboutModal">
                <i class="bi bi-file-earmark-text me-2"></i>Add Content
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
                                    <th class="ps-4 py-3" style="width: 25%;">Tour Package</th>
                                    <th class="py-3" style="width: 55%;">Description Preview</th>
                                    <th class="py-3 pe-4 text-end" style="width: 20%;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(mysqli_num_rows($result) > 0): ?>
                                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td class="ps-4">
                                            <span class="fw-bold text-dark"><?= $row['tour_name'] ?></span>
                                        </td>
                                        <td>
                                            <div class="text-muted small text-truncate" style="max-width: 500px;">
                                                <?= htmlspecialchars($row['description']) ?>
                                            </div>
                                        </td>
                                        <td class="pe-4 text-end">
                                            <button class="btn btn-light btn-sm rounded-circle shadow-sm me-1" 
                                                    data-bs-toggle="modal" data-bs-target="#editAbout<?= $row['about_id'] ?>">
                                                <i class="bi bi-pencil-square text-primary"></i>
                                            </button>
                                            <a href="dashboardLinks/adminTourAbout/crud/deleteAbout.php?id=<?= $row['about_id'] ?>" 
                                               class="btn btn-light btn-sm rounded-circle shadow-sm" 
                                               onclick="return confirm('Delete this description?')">
                                                <i class="bi bi-trash3 text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php include 'editAboutModal.php'; ?>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr><td colspan="3" class="text-center py-5 text-muted">No descriptions found.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'addAboutModal.php'; ?>