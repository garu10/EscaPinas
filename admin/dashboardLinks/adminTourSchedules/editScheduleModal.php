<div class="modal fade" id="editSchedule<?= $row['schedule_id'] ?>" tabindex="-1" aria-labelledby="editScheduleLabel<?= $row['schedule_id'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <form action="dashboardLinks/adminTourSchedules/crud/updateSchedule.php" method="POST">
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="fw-bold text-success m-0" id="editScheduleLabel<?= $row['schedule_id'] ?>">Update Trip Schedule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body p-4">
                    <input type="hidden" name="schedule_id" value="<?= $row['schedule_id'] ?>">

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Tour Package</label>
                        <select name="tour_id" class="form-select rounded-3" required>
                            <?php 
                            $toursQuery = "SELECT tour_id, tour_name FROM tour_packages";
                            $toursResult = executeQuery($toursQuery);
                            while($t = mysqli_fetch_assoc($toursResult)) {
                                $selected = ($t['tour_id'] == $row['tour_id']) ? 'selected' : '';
                                echo "<option value='".$t['tour_id']."' $selected>".$t['tour_name']."</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Start Date</label>
                            <input type="date" name="start_date" class="form-control rounded-3" 
                                   value="<?= $row['start_date'] ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small fw-bold">End Date</label>
                            <input type="date" name="end_date" class="form-control rounded-3" 
                                   value="<?= $row['end_date'] ?>" required>
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class="form-label small fw-bold">Available Slots (Remaining Seats)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-people"></i></span>
                            <input type="number" name="available_slots" class="form-control rounded-3" 
                                   value="<?= $row['available_slots'] ?>" min="0" required>
                        </div>
                        <small class="text-muted mt-2 d-block" style="font-size: 0.75rem;">
                            Set to 0 to mark the trip as "Fully Booked" on the website.
                        </small>
                    </div>
                </div>

                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success rounded-pill px-4 shadow">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>