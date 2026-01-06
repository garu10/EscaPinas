<?php
include_once("../frontend/php/connect.php");

$query = "SELECT b.*, u.first_name, u.last_name, tp.tour_name 
          FROM bookings b
          JOIN users u ON b.user_id = u.user_id
          JOIN tour_packages tp ON b.tour_id = tp.tour_id
          ORDER BY b.booking_id DESC";
$result = executeQuery($query);

?>

<div class="container-fluid p-0">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold text-success mb-1">Booking Management</h4>
                <p class="text-muted small mb-0">Monitor and update client reservation statuses.</p>
            </div>
            <button class="btn btn-success rounded-pill px-4 shadow-sm btn-sm">
                <i class="bi bi-download me-2"></i>Export List
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr class="text-secondary small uppercase">
                                    <th class="ps-4 py-3">Reference</th>
                                    <th class="py-3">Client Name</th>
                                    <th class="py-3">Package</th>
                                    <th class="py-3 text-center">Pax</th>
                                    <th class="py-3">Amount</th>
                                    <th class="py-3">Status</th>
                                    <th class="py-3 pe-4 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(mysqli_num_rows($result) > 0): ?>
                                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td class="ps-4 fw-bold text-dark"><?= $row['booking_reference'] ?></td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="fw-semibold"><?= $row['first_name'] . " " . $row['last_name'] ?></span>
                                                <span class="text-muted" style="font-size: 0.75rem;">ID: #<?= $row['user_id'] ?></span>
                                            </div>
                                        </td>
                                        <td><?= $row['tour_name'] ?></td>
                                        <td class="text-center"><?= $row['number_of_persons'] ?></td>
                                        <td class="fw-bold text-success">₱<?= number_format($row['total_amount'], 2) ?></td>
                                        <td>
                                            <?php 
                                                $badgeClass = 'bg-warning text-dark';
                                                if($row['booking_status'] == 'Confirmed') $badgeClass = 'bg-success';
                                                if($row['booking_status'] == 'Cancelled') $badgeClass = 'bg-danger';
                                            ?>
                                            <span class="badge rounded-pill <?= $badgeClass ?>" style="font-size: 0.7rem; padding: 0.5em 1em;">
                                                <?= $row['booking_status'] ?>
                                            </span>
                                        </td>
                                        <td class="pe-4 text-end">
                                            <button class="btn btn-light btn-sm rounded-circle shadow-sm me-1" data-bs-toggle="modal" data-bs-target="#editBooking<?= $row['booking_id'] ?>">
                                                <i class="bi bi-pencil-square text-primary"></i>
                                            </button>
                                            <a href="dashboardLinks/adminBookings/crud/deleteBooking.php?id=<?= $row['booking_id'] ?>" 
                                               class="btn btn-light btn-sm rounded-circle shadow-sm" 
                                               onclick="return confirm('Delete this booking permanently?')">
                                                <i class="bi bi-trash3 text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <?php include 'bookingsModal.php'; ?>
                                    
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center py-5 text-muted">No bookings found in the database.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>