<div class="modal fade" id="addLocModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <form action="dashboardLinks/adminLocationPoints/crud/addLoc.php" method="POST">
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="fw-bold text-success m-0">Add Location Hubs</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Island Origin</label>
                        <select name="origin_island" class="form-select rounded-3" required>
                            <option value="Luzon">Luzon</option>
                            <option value="Visayas">Visayas</option>
                            <option value="Mindanao">Mindanao</option>
                            <option value="Tours Requiring AirTravel">Tours Requiring AirTravel</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Pickup Points</label>
                        <textarea name="pickup_points" class="form-control rounded-3" placeholder="e.g. NAIA T3, Victory Liner Pasay" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Dropoff Points</label>
                        <textarea name="dropoff_points" class="form-control rounded-3" placeholder="e.g. Mactan Airport, SM Cebu" required></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="submit" class="btn btn-success w-100 rounded-pill shadow">Save Hubs</button>
                </div>
            </form>
        </div>
    </div>
</div>