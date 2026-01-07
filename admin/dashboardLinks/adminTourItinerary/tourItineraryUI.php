<?php
include_once("../frontend/php/connect.php");

// Fetch itineraries joined with tour names
$query = "SELECT i.*, t.tour_name 
          FROM tour_itinerary i
          JOIN tour_packages t ON i.tour_id = t.tour_id
          ORDER BY t.tour_name ASC, i.day_number ASC";
$result = executeQuery($query);

// Fetch tours for the dropdowns
$toursResult = executeQuery("SELECT tour_id, tour_name FROM tour_packages ORDER BY tour_name ASC");
$toursList = mysqli_fetch_all($toursResult, MYSQLI_ASSOC);
?>

<div class="container-fluid p-0">
    <div class="row mb-4 align-items-center">
        <div class="col-md-8">
            <h4 class="fw-bold text-success mb-1">Tour Itineraries</h4>
            <p class="text-muted small mb-0">Manage the day-by-day activities for each tour package.</p>
        </div>
        <div class="col-md-4 text-md-end">
            <button class="btn btn-success rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#addItineraryModal">
                <i class="bi bi-plus-lg me-1"></i> Add Day Activity
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
                                    <th class="ps-4 py-3">Tour Package</th>
                                    <th class="py-3">Day No.</th>
                                    <th class="py-3">Activity Description</th>
                                    <th class="py-3 pe-4 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(mysqli_num_rows($result) > 0): ?>
                                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td class="ps-4 fw-bold text-success"><?= htmlspecialchars($row['tour_name']) ?></td>
                                        <td><span class="badge bg-light text-dark border">Day <?= $row['day_number'] ?></span></td>
                                        <td class="small"><?= htmlspecialchars($row['short_desc']) ?></td>
                                        <td class="pe-4 text-end">
                                            <div class="d-flex justify-content-end gap-2">
                                                <button class="btn btn-light btn-sm rounded-circle shadow-sm" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#editItinerary<?= $row['itinerary_id'] ?>">
                                                    <i class="bi bi-pencil-square text-primary"></i>
                                                </button>
                                                <a href="dashboardLinks/adminTourItinerary/crud/deleteItinerary.php?id=<?= $row['itinerary_id'] ?>" 
                                                   class="btn btn-light btn-sm rounded-circle shadow-sm" 
                                                   onclick="return confirm('Delete this itinerary day?')">
                                                    <i class="bi bi-trash3 text-danger"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php include 'editItineraryModal.php'; ?>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr><td colspan="4" class="text-center py-5 text-muted">No itineraries found.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addItineraryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <form action="dashboardLinks/adminTourItinerary/crud/addItinerary.php" method="POST">
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="fw-bold text-success m-0">Add Itinerary Day</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Select Tour Package</label>
                        <select name="tour_id" class="form-select rounded-3" required>
                            <option value="" disabled selected>Choose tour...</option>
                            <?php foreach($toursList as $t): ?>
                                <option value="<?= $t['tour_id'] ?>"><?= htmlspecialchars($t['tour_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Day Number</label>
                        <input type="number" name="day_number" class="form-control rounded-3" placeholder="e.g. 1" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Short Description</label>
                        <textarea name="short_desc" class="form-control rounded-3" rows="3" placeholder="Describe the day's highlights..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="submit" class="btn btn-success rounded-pill px-4 w-100">Save Itinerary</button>
                </div>
            </form>
        </div>
    </div>
</div>