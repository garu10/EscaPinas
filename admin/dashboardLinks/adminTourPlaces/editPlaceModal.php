<div class="modal fade" id="editPlace<?= $row['place_id'] ?>" tabindex="-1" aria-labelledby="editPlaceLabel<?= $row['place_id'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <form action="dashboardLinks/adminTourPlaces/crud/updatePlace.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="fw-bold text-success m-0" id="editPlaceLabel<?= $row['place_id'] ?>">Update Tour Spot</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body p-4">
                    <input type="hidden" name="place_id" value="<?= $row['place_id'] ?>">
                    <input type="hidden" name="old_image" value="<?= $row['image'] ?>">

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Associated Tour</label>
                        <select name="tour_id" class="form-select rounded-3" required>
                            <?php 
                            $toursRes = executeQuery("SELECT tour_id, tour_name FROM tour_packages");
                            while($t = mysqli_fetch_assoc($toursRes)) {
                                $selected = ($t['tour_id'] == $row['tour_id']) ? 'selected' : '';
                                echo "<option value='".$t['tour_id']."' $selected>".$t['tour_name']."</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label small fw-bold">Place Name</label>
                            <input type="text" name="place_name" class="form-control rounded-3" 
                                   value="<?= htmlspecialchars($row['place_name']) ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Day No.</label>
                            <input type="number" name="day_number" class="form-control rounded-3" 
                                   value="<?= $row['day_number'] ?>" min="1" required>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="form-label small fw-bold">Update Image</label>
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <img src="../assets/images/tour_places/<?= $row['image'] ?>" 
                                 alt="Current" class="rounded-2 border shadow-sm" 
                                 style="width: 80px; height: 60px; object-fit: cover;">
                            <div class="small text-muted italic">Current Image</div>
                        </div>
                        <input type="file" name="place_image" class="form-control rounded-3" accept="image/*">
                        <small class="text-muted" style="font-size: 0.7rem;">Leave empty to keep the current image.</small>
                    </div>
                </div>

                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success rounded-pill px-4 shadow">Update Spot</button>
                </div>
            </form>
        </div>
    </div>
</div>