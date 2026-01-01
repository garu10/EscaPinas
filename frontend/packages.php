<?php 
include("php/connect.php");

$getQuery = "SELECT tour_packages.*, destinations.destination_name, regions.island_name 
             FROM tour_packages 
             LEFT JOIN destinations ON tour_packages.destination_id = destinations.destination_id 
             LEFT JOIN regions ON destinations.island_id = regions.island_id 
             ORDER BY tour_packages.tour_name ASC";

$result = executeQuery($getQuery);

// sa filters sa popular 
if (!$result) {
    die("Query failed: " . $conn->error);
}

$allTours = [];
while ($row = $result->fetch_assoc()) {
    $allTours[] = $row; 
} 

// dun sa last section
$randomTours = $allTours; 
shuffle($randomTours); 
$discoverTours = array_slice($randomTours, 0, 4);


// Para sa ito dun sa dropdown nung search
$randomTours = $allTours; 
shuffle($randomTours); 
$discoverTours = array_slice($randomTours, 0, 4);

$islands_query = "SELECT * FROM regions ORDER BY island_name ASC";
$islands_result = executeQuery($islands_query);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EscaPinas | Packages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; overflow-x: hidden; }
        .btn-filter:hover { background-color: #198754; color: white; }
        .tour-card { transition: transform 0.3s ease; }
        .d-none { display: none !important; }
    </style>
</head>

<body>
    <?php include "components/navbar.php"; ?>

    <div class="container-fluid p-0">
        <div style="height: 400px; width: 100%; position: relative;">
            <img id="bannerImage" src="/EscaPinas/frontend/assets/images/banner.png" class="w-100 h-100" style="object-fit: cover;">
            <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
            <div class="position-absolute top-50 start-50 translate-middle text-center w-100">
                <h1 class="text-white fw-bold display-4">Find Your Next Adventure</h1>
                <p class="text-white-50 fs-5">Explore the beauty of the Philippines with us</p>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top: -50px; position: relative; z-index: 10;">
        <div class="card shadow border-0 p-4">
            <form class="row g-3 align-items-end" action="searchResults.php" method="GET">
                <div class="col-md-5 text-start">
                    <label class="form-label fw-bold text-success small">WHERE TO GO?</label>
                    <select class="form-select py-2" id="regionSelect" name="region" onchange="updateDestinations()">
                        <option selected disabled>Select Region</option>
                        <?php 
                        $islands = array_unique(array_column($allTours, 'island_name'));
                        foreach ($islands as $island): ?>
                            <option value="<?php echo htmlspecialchars($island); ?>">
                                <?php echo strtoupper(htmlspecialchars($island)); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-5 text-start">
                    <label class="form-label fw-bold text-success small">WHAT TO SEE?</label>
                    <select class="form-select py-2" id="attractionSelect" name="destination" disabled>
                        <option value="">Select a region first...</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-success w-100 py-2 fw-bold">SEARCH</button>
                </div>
            </form>
        </div>
    </div>

    <div id="destinationData" style="display: none;">
        <?php foreach ($allTours as $tour): ?>
            <span class="dest-item" 
                data-region="<?php echo htmlspecialchars($tour['island_name']); ?>" 
                data-val="<?php echo htmlspecialchars($tour['destination_name']); ?>">
            </span>
        <?php endforeach; ?>
    </div>

    <?php include "components/offersCarousel.php"; ?>

    <div class="container my-5 text-center">
        <h2 class="fw-bold text-success">Popular Attractions</h2>
        <div class="btn-group my-5 shadow-sm rounded-pill overflow-hidden d-inline-flex border border-success">
            <button class="btn btn-success btn-md px-4 filter-btn border-0" onclick="filterTours('all', this)">All</button>
            <button class="btn btn-outline-success btn-md px-4 filter-btn border-0" onclick="filterTours('luzon', this)">Luzon</button>
            <button class="btn btn-outline-success btn-md px-4 filter-btn border-0" onclick="filterTours('visayas', this)">Visayas</button>
            <button class="btn btn-outline-success btn-md px-4 filter-btn border-0" onclick="filterTours('mindanao', this)">Mindanao</button>
        </div>
        <div class="row g-4 justify-content-center" id="tourContainer">
            <?php if(empty($allTours)): ?>
                <p>No tours available at the moment.</p>
            <?php else: ?>
                <?php foreach ($allTours as $tour): ?>
                <div class="col-md-4 tour-card-item" data-island="<?php echo strtolower($tour['island_name']); ?>">
                    <div class="card border-0 shadow-sm h-100 text-start">
                        <img src="<?php echo htmlspecialchars($tour['image']); ?>" class="card-img-top rounded-top-4" height="300" style="object-fit: cover;">
                        
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div class="mb-3">
                                <div class="row align-items-start g-0">
                                    <div class="col-8">
                                        <h5 class="fw-bold mb-0 text-truncate" title="<?php echo htmlspecialchars($tour['tour_name']); ?>">
                                            <?php echo htmlspecialchars($tour['tour_name']); ?>
                                        </h5>
                                    </div>
                                    <div class="col-4 text-end">
                                        <span class="badge bg-light text-success border border-success-subtle rounded-pill fw-medium" style="font-size: 0.7rem;">
                                            <i class="bi bi-clock"></i> <?php echo htmlspecialchars($tour['duration_days']); ?>D/<?php echo htmlspecialchars($tour['duration_nights']); ?>N
                                        </span>
                                    </div>
                                </div>
                                
                                <p class="text-muted small mt-1 mb-0">
                                    <i class="bi bi-geo-alt-fill text-danger"></i> 
                                    <?php echo htmlspecialchars($tour['island_name'] . " | " . $tour['destination_name']); ?>
                                </p>
                            </div>

                            <div class="border-top pt-3">
                                <div class="row align-items-center">
                                    <div class="col-7">
                                        <span class="text-muted d-block" style="font-size: 0.7rem;">Starting at:</span>
                                        <span class="fw-bold text-success fs-5">
                                            ₱<?php echo number_format($tour['price'], 2); ?>
                                        </span>
                                    </div>
                                    <div class="col-5 text-end">
                                        <a href="packageView.php?tour_id=<?php echo $tour['tour_id']; ?>" class="btn btn-success btn-sm px-3 rounded-pill fw-bold shadow-sm" style="font-size: 0.75rem;">
                                            Details <i class="bi bi-chevron-right"></i>
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
                        <span class="position-absolute top-0 end-0 m-2 badge rounded-pill bg-success opacity-75" style="font-size:15px;">
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
                                <span class="fw-bold text-success small">
                                    ₱<?php echo number_format($row['price'], 2); ?>
                                </span>
                                <a href="packageView.php?tour_id=<?php echo $row['tour_id']; ?>" class="btn btn-success btn-sm p-0 px-2 rounded-circle" style="font-size: 0.8rem;">
                                    <i class="bi bi-arrow-right-short"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php include "components/footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/packages.js"></script>

</body>
</html>