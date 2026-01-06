<div class="modal fade" id="addRegionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <form action="dashboardLinks/adminRegions/crud/addRegion.php" method="POST">
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="fw-bold text-success m-0">Create New Region</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Island Name</label>
                        <input type="text" name="island_name" class="form-control rounded-3" placeholder="e.g. Visayas" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Description</label>
                        <textarea name="description" class="form-control rounded-3" rows="4" placeholder="Brief geographical details..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="submit" class="btn btn-success w-100 rounded-pill shadow">Save Region</button>
                </div>
            </form>
        </div>
    </div>
</div>