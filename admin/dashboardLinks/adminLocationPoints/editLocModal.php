<div class="modal fade" id="editLoc<?= $row['locpoints_id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <form action="dashboardLinks/adminLocationPoints/crud/updateLoc.php" method="POST">
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="fw-bold text-success m-0">Edit Hub Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" name="locpoints_id" value="<?= $row['locpoints_id'] ?>">
                    
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Island Origin</label>
                        <select name="origin_island" class="form-select rounded-3">
                            <?php 
                            $options = ['Luzon', 'Visayas', 'Mindanao', 'Tours Requiring AirTravel'];
                            foreach($options as $opt) {
                                $selected = ($row['origin_island'] == $opt) ? 'selected' : '';
                                echo "<option value='$opt' $selected>$opt</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Pickup Points</label>
                        <textarea name="pickup_points" class="form-control rounded-3" required><?= $row['pickup_points'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Dropoff Points</label>
                        <textarea name="dropoff_points" class="form-control rounded-3" required><?= $row['dropoff_points'] ?></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="submit" class="btn btn-success w-100 rounded-pill shadow">Update Hubs</button>
                </div>
            </form>
        </div>
    </div>
</div>