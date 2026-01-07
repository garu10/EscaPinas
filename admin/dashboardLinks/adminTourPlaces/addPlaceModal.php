<div class="modal fade" id="addPlaceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <form action="dashboardLinks/adminTourPlaces/crud/addPlace.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="fw-bold text-success m-0">Add Tour Spot</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Belongs to Tour</label>
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
                        <div class="col-md-8">
                            <label class="form-label small fw-bold">Place Name</label>
                            <input type="text" name="place_name" class="form-control rounded-3" placeholder="e.g. Kayangan Lake" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Day No.</label>
                            <input type="number" name="day_number" class="form-control rounded-3" min="1" required>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="form-label small fw-bold">Place Image</label>
                        <input type="file" name="place_image" class="form-control rounded-3" accept="image/*" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="submit" class="btn btn-success w-100 rounded-pill shadow">Save Place</button>
                </div>
            </form>
        </div>
    </div>
</div>