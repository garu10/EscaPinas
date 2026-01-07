<div class="modal fade" id="editExclusion<?= $row['exclusion_id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <form action="dashboardLinks/adminTourExclusions/crud/updateExclusion.php" method="POST">
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="fw-bold text-success m-0">Edit Exclusion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" name="exclusion_id" value="<?= $row['exclusion_id'] ?>">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Tour Package</label>
                        <select name="tour_id" class="form-select rounded-3" required>
                            <?php 
                            $toursList = executeQuery("SELECT tour_id, tour_name FROM tour_packages ORDER BY tour_name ASC");
                            while($tl = mysqli_fetch_assoc($toursList)) {
                                $selected = ($tl['tour_id'] == $row['tour_id']) ? 'selected' : '';
                                echo "<option value='".$tl['tour_id']."' $selected>".$tl['tour_name']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Exclusion Detail</label>
                        <input type="text" name="exclusion_detail" class="form-control rounded-3" value="<?= htmlspecialchars($row['exclusion_detail']) ?>" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="submit" class="btn btn-success w-100 rounded-pill shadow">Update Exclusion</button>
                </div>
            </form>
        </div>
    </div>
</div>