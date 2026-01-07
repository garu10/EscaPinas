<div class="card shadow-lg border-0" style="border-radius: 15px;">
            <div class="card-body p-4">
                <div class="row g-3 align-items-center">
                    <div class="col-md-5 border-end pe-3">
                        <div class="d-flex align-items-center px-2">
                            <div class="w-100">
                                <label class="form-label fw-bold text-success small mb-0">
                                    <i class="bi bi-geo-alt-fill text-success fs-6 me-1"></i> WHERE TO GO?</label>
                                <select class="form-select border-0 p-0 fw-bold shadow-none" id="regionSelect" onchange="updateDestinations()">
                                    <option selected disabled>Select Region</option>
                                    <?php
                                    $islands = array_unique(array_column($allTours, 'island_name'));
                                    foreach ($islands as $island): ?>
                                        <option value="<?php echo htmlspecialchars($island); ?>"><?php echo strtoupper($island); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="d-flex align-items-center px-2 ps-md-3">

                            <div class="w-100">
                                <label class="form-label fw-bold text-success small mb-0">
                                    <i class="bi bi-search text-success fs-6 me-1"></i> WHAT TO SEE?</label>
                                <select class="form-select border-0 p-0 fw-bold shadow-none" id="attractionSelect" disabled>
                                    <option value="">Select region first...</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="button" onclick="handleSearch()" class="btn btn-success w-100 py-3 fw-bold rounded-3 shadow-sm">SEARCH</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="destinationData" style="display: none;">
        <?php foreach ($allTours as $tour): ?>
            <span class="dest-item"
                data-region="<?php echo htmlspecialchars($tour['island_name']); ?>"
                data-val="<?php echo htmlspecialchars($tour['destination_name']); ?>"></span>
        <?php endforeach; ?>
    </div>

    <div id="searchResultWrapper" style="display: none; scroll-margin-top: 50px;" class="container my-5 pt-5">
        <div class="d-flex align-items-center justify-content-center mb-4 position-relative">
            <h2 class="fw-bold text-success mb-0">Search Results</h2>
            <button class="btn btn-sm btn-outline-success position-absolute end-0" onclick="window.location.reload()">Clear Search</button>
        </div>
        <div class="row g-4 justify-content-center" id="searchResultsGrid">
            <?php foreach ($allTours as $row): ?>
                <div class="col-md-4 search-result-card"
                    data-island="<?php echo strtolower($row['island_name']); ?>"
                    data-destination="<?php echo strtolower($row['destination_name']); ?>">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="<?php echo htmlspecialchars($row['image']); ?>" class="card-img-top" height="200" style="object-fit: cover;">
                        <div class="card-body">
                            <h5 class="fw-bold mb-1"><?php echo htmlspecialchars($row['tour_name']); ?></h5>
                            <p class="text-muted small mb-2"><i class="bi bi-geo-alt-fill text-danger"></i> <?php echo htmlspecialchars($row['island_name'] . " | " . $row['destination_name']); ?></p>
                            <div class="border-top pt-3">
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-7">
                                        <span class="text-muted d-block" style="font-size: 0.7rem;">Starting at:</span>
                                        <span class="fw-bold text-success fs-5">₱<?php echo number_format($row['price'], 2); ?></span>
                                    </div>
                                    <div class="col-5 text-end">
                                        <a href="/EscaPinas/frontend/packageView.php?tour_id=<?php echo $row['tour_id']; ?>" class="btn btn-success btn-sm px-3 rounded-pill fw-bold shadow-sm" style="font-size: 0.75rem;">
                                            View Details <i class="bi bi-chevron-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>