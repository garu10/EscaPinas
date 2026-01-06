<div class="modal fade" id="editFee<?= $row['fee_id'] ?>" tabindex="-1" aria-labelledby="editFeeLabel<?= $row['fee_id'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <form action="dashboardLinks/adminRegionFees/crud/updateFee.php" method="POST">
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="fw-bold text-success m-0" id="editFeeLabel<?= $row['fee_id'] ?>">Edit Pricing Rule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body p-4">
                    <input type="hidden" name="fee_id" value="<?= $row['fee_id'] ?>">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">From (Origin)</label>
                            <select name="origin_island" class="form-select rounded-3">
                                <?php 
                                $islands = ['Luzon', 'Visayas', 'Mindanao'];
                                foreach($islands as $island) {
                                    $selected = ($row['origin_island'] == $island) ? 'selected' : '';
                                    echo "<option value='$island' $selected>$island</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small fw-bold">To (Destination)</label>
                            <select name="destination_island" class="form-select rounded-3">
                                <?php 
                                foreach($islands as $island) {
                                    $selected = ($row['destination_island'] == $island) ? 'selected' : '';
                                    echo "<option value='$island' $selected>$island</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-12 mt-3">
                            <label class="form-label small fw-bold">Additional Fee (₱)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">₱</span>
                                <input type="number" step="0.01" name="additional_fee" class="form-control rounded-3 border-start-0" 
                                       value="<?= $row['additional_fee'] ?>" required>
                            </div>
                            <small class="text-muted mt-2 d-block" style="font-size: 0.75rem;">
                                This amount is added on top of the base tour package price.
                            </small>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success rounded-pill px-4 shadow">Update Rule</button>
                </div>
            </form>
        </div>
    </div>
</div>