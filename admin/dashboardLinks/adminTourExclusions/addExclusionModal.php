<div class="modal fade" id="addExclusionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <form action="dashboardLinks/adminTourExclusions/crud/addExclusion.php" method="POST">
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="fw-bold text-success m-0">Add New Exclusion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Select Tour</label>
                        <select name="tour_id" class="form-select rounded-3" required>
                            <?php 
                            $tours = executeQuery("SELECT tour_id, tour_name FROM tour_packages ORDER BY tour_name ASC");
                            while($t = mysqli_fetch_assoc($tours)) {
                                echo "<option value='".$t['tour_id']."'>".$t['tour_name']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Exclusion Detail</label>
                        <input type="text" name="exclusion_detail" class="form-control rounded-3" placeholder="e.g. Roundtrip Airfare" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="submit" class="btn btn-success w-100 rounded-pill shadow">Save Exclusion</button>
                </div>
            </form>
        </div>
    </div>
</div>