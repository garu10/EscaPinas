<?php
    $_title = "Escapinas - Packages";
    session_start();
    include 'php/connect.php';

$getQuery = "SELECT tour_packages.*, destinations.destination_name, regions.island_name 
             FROM tour_packages 
             LEFT JOIN destinations ON tour_packages.destination_id = destinations.destination_id 
             LEFT JOIN regions ON destinations.island_id = regions.island_id 
             WHERE tour_packages.status = 'Available'
             ORDER BY tour_packages.tour_name ASC";

$result = executeQuery($getQuery);

if (!$result) {
    die("Query failed: " . $conn->error);
}

$allTours = [];
while ($row = $result->fetch_assoc()) {
    $allTours[] = $row;
}

$randomTours = $allTours;
shuffle($randomTours);
$discoverTours = array_slice($randomTours, 0, 4);
?>

<?php include "components/header.php"; ?>

<body>
    <?php include "components/navbar.php"; ?>

    <div class="container-fluid p-0">
        <div class="d-flex align-items-center justify-content-center"
            style="background: linear-gradient(#053207bf, #0ca458a6), url('/EscaPinas/frontend/assets/images/banner_package.jpg'); 
                background-size: 100%; background-position: center top; background-attachment: fixed; height: 385px; position: relative;">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center text-white">
                        <h1 class="display-2 fw-bold mb-3 text-uppercase">FIND YOUR PERFECT ESCAPE</h1>
                        <div style="width: 80px; height: 3px; background-color: white; margin: 0 auto 1.5rem;"></div>
                        <p class="lead fs-3 fw-light">Tailored adventures for every traveler</p>
                    </div>
                </div>
            </div>
        </div>  
    </div>

    <div class="container my-5">
        <h2 class="fw-bold text-success text-center mb-4 text-uppercase">Popular Attractions</h2>

        <div class="row g-3 justify-content-center align-items-center mb-5">
            <div class="col-auto">
                <div class="btn-group shadow-sm rounded-pill overflow-hidden border border-success bg-white">
                    <button class="btn btn-success px-4 filter-btn" id="btn-all" onclick="filterTours('all', this)">All</button>
                    <button class="btn btn-outline-success px-4 filter-btn border-0" id="btn-luzon" onclick="filterTours('luzon', this)">Luzon</button>
                    <button class="btn btn-outline-success px-4 filter-btn border-0" id="btn-visayas" onclick="filterTours('visayas', this)">Visayas</button>
                    <button class="btn btn-outline-success px-4 filter-btn border-0" id="btn-mindanao" onclick="filterTours('mindanao', this)">Mindanao</button>
                </div>
            </div>

            <div class="col-md-4">
                <div class="input-group shadow-sm">
                    <input type="text" id="packageQuickSearch" class="form-control border-success rounded-start-pill ps-4" placeholder="Search destination (e.g. Cebu)..." onkeyup="handleQuickSearch()">
                    <button class="btn btn-success rounded-end-pill px-4">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </div>

        <div id="noResultsMessage" class="text-center py-5 w-100" style="display: none;">
            <i class="bi bi-search text-muted" style="font-size: 3rem;"></i>
            <h4 class="mt-3 text-muted">No tours available for that destination.</h4>
            <p class="text-secondary">EscaPinas is continuously exploring more hidden gems across the islands to provide the best possible experience for our customers. <br>Feel free to explore and browse our other available tours in the meantime!</br></p>
        </div>

        <div class="row g-4 justify-content-center" id="tourContainer">
            <?php if (empty($allTours)): ?>
                <div class="col-12 text-center py-5">
                    <i class="bi bi-emoji-frown fs-1 text-muted"></i>
                    <p class="mt-2 text-muted">No tours available at the moment.</p>
                </div>
            <?php else: ?>
                <?php foreach ($allTours as $tour): ?>
                    <div class="col-md-4 tour-card-item"
                        data-island="<?php echo strtolower($tour['island_name']); ?>"
                        data-destination="<?php echo strtolower($tour['destination_name']); ?>">
                        <div class="card border-0 shadow-sm h-100">
                            <img src="<?php echo htmlspecialchars($tour['image']); ?>" class="card-img-top rounded-top-4" height="300" style="object-fit: cover;">

                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="fw-bold mb-0 text-success"><?php echo htmlspecialchars($tour['tour_name']); ?></h5>
                                    <span class="badge bg-light text-success border border-success-subtle rounded-pill">
                                        <i class="bi bi-clock"></i> <?php echo htmlspecialchars($tour['duration_days']); ?>D/<?php echo htmlspecialchars($tour['duration_nights']); ?>N
                                    </span>
                                </div>

                                <p class="text-muted small mb-3">
                                    <i class="bi bi-geo-alt-fill text-danger"></i>
                                    <?php echo htmlspecialchars($tour['island_name'] . " | " . $tour['destination_name']); ?>
                                </p>

                                <div class="mt-auto border-top pt-3">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <span class="text-muted d-block" style="font-size: 0.7rem;">Starts at</span>
                                            <span class="fw-bold text-success fs-5">₱<?php echo number_format($tour['price'], 2); ?></span>
                                        </div>
                                        <div class="col-6 text-end">
                                            <a href="packageView.php?tour_id=<?php echo $tour['tour_id']; ?>"
                                                class="btn btn-success btn-sm px-3 rounded-pill fw-bold">
                                                View Details <i class="bi bi-chevron-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="container my-5 text-center">
        <h2 class="fw-bold text-success fs-4 my-5">Discover More Tours</h2>

        <div class="row g-3 justify-content-center">
            <?php foreach ($discoverTours as $row): ?>
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm h-100 tour-card position-relative">
                        <span class="position-absolute top-0 end-0 m-2 badge rounded-pill bg-success opacity-75" style="font-size: 15px;">
                            <?php echo htmlspecialchars($row['status']); ?>
                        </span>

                        <img src="<?php echo htmlspecialchars($row['image']); ?>"
                            class="card-img-top rounded-top-3" height="260" style="object-fit: cover;">

                        <div class="card-body p-2 text-start d-flex flex-column justify-content-between">
                            <div>
                                <p class="fw-bold mb-0 small text-truncate">
                                    <?php echo htmlspecialchars($row['tour_name']); ?>
                                </p>
                                <p class="text-muted mb-1" style="font-size: 0.7rem;">
                                    <i class="bi bi-geo-alt-fill text-danger"></i>
                                    <?php echo htmlspecialchars($row['island_name'] . " | " . $row['destination_name']); ?>
                                </p>
                                <p class="mb-2 text-dark" style="font-size: 0.7rem;">
                                    <i class="bi bi-clock-history text-success"></i>
                                    <?php echo htmlspecialchars($row['duration_days']); ?>D / <?php echo htmlspecialchars($row['duration_nights']); ?>N
                                </p>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-1 border-top pt-2">
                                <span class="fw-bold text-success small"> ₱<?php echo number_format($row['price'], 2); ?> </span>
                                <a href="packageView.php?tour_id=<?php echo $row['tour_id']; ?>" class="btn btn-success btn-sm px-3 rounded-pill fw-bold shadow-sm" style="font-size: 0.75rem;">
                                    View Tour <i class="bi bi-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php include "components/footer.php"; ?>
        
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/packages.js"></script>
</body>
</html>