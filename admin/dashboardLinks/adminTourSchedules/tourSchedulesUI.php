<?php
include_once("../frontend/php/connect.php");

$query = "SELECT s.*, t.tour_name 
          FROM tour_schedules s 
          JOIN tour_packages t ON s.tour_id = t.tour_id 
          ORDER BY s.start_date ASC";
$result = executeQuery($query);
?>

<div class="container-fluid p-0">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold text-success mb-1">Tour Schedules</h4>
                <p class="text-muted small mb-0">Manage trip dates and seat availability for all packages.</p>
            </div>
            <button class="btn btn-success rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#addScheduleModal">
                <i class="bi bi-calendar-plus me-2"></i>Add Schedule
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
                                    <th class="ps-4 py-3">Tour Name</th>
                                    <th class="py-3">Start Date</th>
                                    <th class="py-3">End Date</th>
                                    <th class="py-3">Slots</th>
                                    <th class="py-3 pe-4 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(mysqli_num_rows($result) > 0): ?>
                                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td class="ps-4">
                                            <span class="fw-bold text-dark"><?= $row['tour_name'] ?></span>
                                        </td>
                                        <td><?= date('M d, Y', strtotime($row['start_date'])) ?></td>
                                        <td><?= date('M d, Y', strtotime($row['end_date'])) ?></td>
                                        <td>
                                            <span class="badge rounded-pill <?= $row['available_slots'] > 5 ? 'bg-info' : 'bg-danger' ?>">
                                                <?= $row['available_slots'] ?> seats left
                                            </span>
                                        </td>
                                        <td class="pe-4 text-end">
                                            <button class="btn btn-light btn-sm rounded-circle shadow-sm me-1" 
                                                    data-bs-toggle="modal" data-bs-target="#editSchedule<?= $row['schedule_id'] ?>">
                                                <i class="bi bi-pencil-square text-primary"></i>
                                            </button>
                                            <a href="dashboardLinks/adminTourSchedules/crud/deleteSchedule.php?id=<?= $row['schedule_id'] ?>" 
                                               class="btn btn-light btn-sm rounded-circle shadow-sm" 
                                               onclick="return confirm('Delete this schedule?')">
                                                <i class="bi bi-trash3 text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php include 'editScheduleModal.php'; ?>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr><td colspan="5" class="text-center py-5 text-muted">No schedules found.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'addScheduleModal.php'; ?>