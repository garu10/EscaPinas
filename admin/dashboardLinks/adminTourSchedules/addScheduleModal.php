<div class="modal fade" id="addScheduleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <form action="dashboardLinks/adminTourSchedules/crud/addSchedule.php" method="POST">
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="fw-bold text-success m-0">New Tour Schedule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Select Tour Package</label>
                        <select name="tour_id" class="form-select rounded-3" required>
                            <?php 
                            $tours = executeQuery("SELECT tour_id, tour_name FROM tour_packages");
                            while($t = mysqli_fetch_assoc($tours)) {
                                echo "<option value='".$t['tour_id']."'>".$t['tour_name']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Start Date</label>
                            <input type="date" name="start_date" class="form-control rounded-3" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">End Date</label>
                            <input type="date" name="end_date" class="form-control rounded-3" required>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="form-label small fw-bold">Available Slots</label>
                        <input type="number" name="available_slots" class="form-control rounded-3" min="1" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="submit" class="btn btn-success w-100 rounded-pill shadow">Publish Schedule</button>
                </div>
            </form>
        </div>
    </div>
</div>