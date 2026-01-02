<?php
session_start();
include("php/connect.php"); 

// test lang itoo
// dito gineget yung tour id after maclick yung view details sa packages.php
$tour_id = isset($_GET['tour_id']) ? $_GET['tour_id'] : die("Tour ID not found.");

$tourQuery = "SELECT tp.*, d.destination_name, r.island_name 
              FROM tour_packages tp
              JOIN destinations d ON tp.destination_id = d.destination_id
              JOIN regions r ON d.island_id = r.island_id
              WHERE tp.tour_id = $tour_id";

$tourResult = executeQuery($tourQuery);
$tour = mysqli_fetch_assoc($tourResult);

// query sa pagselect ng mga images and other info dun sa places to visit
$placesQuery = "SELECT * FROM tour_place WHERE tour_id = $tour_id";
$placesResult = executeQuery($placesQuery);

// query sa pagselect ng mga info para sa itenerary from db
$itineraryQuery = "SELECT * FROM tour_itinerary WHERE tour_id = $tour_id ORDER BY day_number ASC, itinerary_id ASC";
$itineraryResult = executeQuery($itineraryQuery);

$itineraryData = [];
while ($row = mysqli_fetch_assoc($itineraryResult)) {
    $itineraryData[$row['day_number']][] = $row['short_desc'];
}

// query sa pagselect ng info para sa about
$aboutQuery = "SELECT * FROM tour_about WHERE tour_id = $tour_id";
$aboutResult = executeQuery($aboutQuery);
$about = mysqli_fetch_assoc($aboutResult);


// query sa pagfetch ng data ng ratings 
$tour_id = isset($_GET['tour_id']) ? (int)$_GET['tour_id'] : 0;
$ratingQuery = "SELECT AVG(rating_score) as avg_rating, COUNT(review_id) as total_reviews 
                FROM ratings 
                WHERE tour_id = $tour_id";
$ratingResult = executeQuery($ratingQuery);
$ratingData = mysqli_fetch_assoc($ratingResult);

$average = $ratingData['avg_rating'] ? round($ratingData['avg_rating'], 1) : 0;
$count = $ratingData['total_reviews'] ?? 0;

// para sa wishlist function
$isLoggedIn = isset($_SESSION['user_id']);
$uid = $_SESSION['user_id'] ?? 0;
$isWishlisted = false;

if ($isLoggedIn) {
    $wishCheckQuery = "SELECT * FROM wishlist WHERE user_id = $uid AND tour_id = $tour_id";
    $wishCheckResult = executeQuery($wishCheckQuery);
    $isWishlisted = mysqli_num_rows($wishCheckResult) > 0;
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EscaPinas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="bg-light">

    <?php include "components/navbar.php"; ?>
        <div class="row g-0">
            <div class="col">
            <a href="javascript:history.back()"
                class="btn btn-success btn-sm position-absolute rounded-pill shadow-sm px-3 py-2"
                style="top: 20px; left: 20px; z-index: 10;">
                <i class="bi bi-chevron-left"></i> Back
            </a>

            <div style="height: 50vh; min-height: 350px; overflow: hidden;">
                <?php
                // need mag dagdag ng column sa database ng tour_packages para sa banner "banner_image"
                $banner_src = !empty($tour['banner_image']) ? "assets/images/" . $tour['banner_image'] : "assets/images/banner.png";
                ?>
                <img src="<?php echo $banner_src; ?>" class="w-100 h-100" style="object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
   <div class="container my-5 mb-5">
        <div class="row">
            <div class="col-12">
                <div class="card shadow p-5 rounded-5">
                    <div class="mb-2 d-flex justify-content-between align-items-center flex-wrap">
                        <h1 class="fw-bold text-success ">₱ <?php echo htmlspecialchars($tour['price']); ?> <small class="fw-bold text-muted fs-6 fw-normal">/ PAX</small></h1>
                        <div class="text-warning fs-6">
                            <span class="text-success small ms-2"><?= $average ?> RATING (<?= $count ?> Reviews)</span>
                            <?php
                            // then ito yung logic ng ratings 
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $average) {
                                    echo '<i class="bi bi-star-fill"></i>'; // Full Star
                                } elseif ($i - 0.5 <= $average) {
                                    echo '<i class="bi bi-star-half"></i>'; // Half Star
                                } else {
                                    echo '<i class="bi bi-star"></i>';      // Empty Star
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <h1 class="fw-bold text-success mb-3"><?php echo htmlspecialchars($tour['tour_name']); ?></h1>
                        <p class="text-secondary leading-relaxed">
                            <?php echo htmlspecialchars($tour['description']); ?>
                        </p>
                    </div>
                    <div class="row mb-5 justify-content-start g-2">
                        <div class="col-auto d-flex align-items-center gap-2 px-3">
                            <i class="bi bi-moon-stars text-success fs-6"></i>
                            <span class="fw-bold"><?php echo htmlspecialchars($tour['duration_days']); ?>D - <?php echo htmlspecialchars($tour['duration_nights']); ?>N</span>
                        </div>
                        <div class="col-auto d-flex align-items-center gap-2 px-3 border-start">
                            <i class="bi bi-calendar-range text-success fs-6"></i>
                            <span class="fw-bold">JAN 1 - 2</span>
                        </div>
                        <div class="col-auto d-flex align-items-center gap-2 px-3 border-start">
                            <span class="fw-bold">MODES OF TRANSPORTATION</span>
                            <i class="bi bi-bus-front text-success fs-6"></i>
                            <i class="bi bi-airplane text-success fs-6"></i>
                        </div>
                        <div class="col-auto d-flex align-items-center gap-2 px-3 border-start">
                            <i class="bi bi-people text-success fs-6"></i>
                            <span class="fw-bold">Max 10 PAX</span>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <div class="container-fluid p-0 position-relative mb-5" style="height: 600px;">
        <div class="container position-absolute top-50 start-50 translate-middle">
            <div class="row">
                <div class="col">
                    <div class="text-center mb-5">
                        <h1 class="fw-bold text-success display-5 mb-2" style="font-family: 'Poppins', sans-serif;">
                            Places to Visit</h1>
                        <p class="text-success fw-bold " style="font-size:1rem; font-family: 'Poppins', sans-serif;">
                            Discover breathtaking destinations handpicked by Escapinas.From iconic tourist spots to hidden gems.</p>
                    </div>

                    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators" style="bottom: -50px;">
<<<<<<< HEAD
                            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0"
                                class="active bg-success rounded-circle" style="width: 12px; height: 12px;"
                                aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1"
                                class="bg-success rounded-circle" style="width: 12px; height: 12px;" aria-label="Slide 2">
=======
                            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active bg-dark rounded-circle" style="width: 12px; height: 12px;" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1" class="bg-dark rounded-circle" style="width: 12px; height: 12px;" aria-label="Slide 2">
>>>>>>> 1ae3f7e (connect packageView to wishlist)
                            </button>
                        </div>

                        <div class="carousel-inner">
                            <?php 
                            $count = 0;
                            $isActive = true;
                            if (mysqli_num_rows($placesResult) > 0):
                                while ($place = mysqli_fetch_assoc($placesResult)): 
                                    if ($count % 3 == 0): ?>
                                        <div class="carousel-item <?php echo $isActive ? 'active' : ''; ?>">
<<<<<<< HEAD
                                            <div class="row g-4 px-2">
                                                <?php
                                                $isActive = false;
                                    endif;
                                    ?>
                                            <div class="col-4">
                                                <div class="card destination-card border-0 bg-transparent">
                                                    <img src="<?php echo htmlspecialchars($place['image']); ?>"
                                                        class="img-fluid rounded-4"
                                                        style="height: 300px; width: 100%; object-fit: cover;">
=======
                                            <div class="row g-4">
                                    <?php 
                                    $isActive = false; 
                                    endif; 
                                    ?>

                                    <div class="col-4">
                                        <div class="card destination-card border-0 shadow-lg">
                                            <img src="<?php echo htmlspecialchars($place['image']); ?>" class="card-img rounded-3" style="height: 300px; object-fit: cover;">
                                            <div class="card-img-overlay d-flex align-items-end p-3">
                                                <div class="card-img-overlay d-flex align-items-end p-3">
                                                    <h5 class="text-white fw-bold m-0"><?php echo htmlspecialchars($place['place_name']); ?></h5>
>>>>>>> 1ae3f7e (connect packageView to wishlist)
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php 
                                    $count++;
                                    if ($count % 3 == 0 || $count == mysqli_num_rows($placesResult)): ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <div class="carousel-item active">
                                    <p class="text-center text-muted">No specific places listed for this tour yet.</p>
                                </div>
                            <?php endif; ?>
                        </div>
<<<<<<< HEAD

                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="prev" style="left: -5%; width: 5%;">
                            <span class="carousel-control-prev-icon bg-success rounded-circle p-2" aria-hidden="true"
                                style="filter: invert(1);"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="next" style="right: -5%; width: 5%;">
                            <span class="carousel-control-next-icon bg-success rounded-circle p-2" aria-hidden="true"
                                style="filter: invert(1);"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                    <div class="mt-3 pt-4 text-center">
                        <p class="fw-bold mb-0 text-muted">Destinations may vary based on weather and site availability. </p>
=======
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev" 
                                style="left: 0; width: 5%;"> <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next" 
                                style="right: 0; width: 5%;">
                            <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                        <p class="text-center text-dark">Discover breathtaking destinations handpicked by Escapinas. From iconic tourist spots to hidden gems,</p>
>>>>>>> 1ae3f7e (connect packageView to wishlist)
                    </div>
                </div>
            </div>
        </div>
    </div>
   <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <h3 class="fw-bold text-success pt-4">Tour Details & Information</h3>
                <p class="text-muted mt-3">Everything you need to know about your trip, from itineraries to travel essentials.</p>
                <div class="accordion shadow-sm" id="accordionExample">

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                <i class="bi bi-map-fill me-2 text-success"></i> Itinerary
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <?php if (!empty($itineraryData)): ?>
                                    <?php foreach ($itineraryData as $day => $activities): ?>
                                        <div class="mb-4">
                                            <h6 class="fw-bold text-success">
                                                <i class="bi bi-calendar-check me-2"></i> Day <?php echo $day; ?>
                                            </h6>
                                            <ul class="list-unstyled ms-4">
                                                <?php foreach ($activities as $desc): ?>
                                                    <li class="mb-2 position-relative">
                                                        <i class="bi bi-dot position-absolute start-0 top-0 mt-1"></i>
                                                        <span class="ms-3 d-block"><?php echo htmlspecialchars($desc); ?></span>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p class="text-muted">No itinerary details available for this package.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <i class="bi bi-geo-alt-fill me-2 text-success"></i> Pick Up & Drop Off
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <ul class="list-unstyled">
                                    <li class="mb-2"><strong>Location Points</strong></li>
                                    <li class="mb-2"><strong>Luzon</strong></li>
                                        <ul>
                                            <li class="mb-2">Designated pickup points include Metro Manila
                                                 (Cubao, Pasay, Makati) and other agreed meetup locations 
                                                 within Luzon. Final pickup details will be provided upon booking.</li>
                                        </ul>
                                    <li class="mb-2"><strong>Visayas</strong></li>
                                        <ul>
                                            <li class="mb-2">Designated pickup points include Cebu City, 
                                                Iloilo City, and Bacolod City, with exact locations confirmed after booking.</li>
                                        </ul>
                                    <li class="mb-2"><strong>Mindanao</strong></li>
                                        <ul>
                                            <li class="mb-2"> Pickup and drop-off will be at the designated airport, 
                                                such as NAIA (Manila), Mactan–Cebu International Airport, or Davao 
                                                International Airport, depending on the tour.</li>
                                        </ul>
                                    <li class="mb-2"><strong>Tours Requiring AirTravels</strong></li>
                                        <ul>
                                            <li class="mb-2"> Pickup and drop-off will be at the designated 
                                                airport, such as NAIA (Manila), Mactan–Cebu International 
                                                Airport, or Davao International Airport, depending on the tour.</li>
                                        </ul>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <i class="bi bi-check-circle-fill me-2 text-success"></i> Inclusions & Exclusions
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="fw-bold text-success">Inclusions:</h6>
                                        <ul class="small">
                                            <li>Comfortable accommodations in Baguio and Sagada</li>
                                            <li>Daily breakfast at the hotel</li>
                                            <li>Guided city and sightseeing tours in Baguio and Sagada</li>
                                            <li>Transportation for all included tours</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="fw-bold text-danger">Exclusions:</h6>
                                        <ul class="small">
                                            <li>Meals not mentioned in the package</li>
                                            <li>Optional activities or add-on tours</li>
                                            <li>Environmental fees not stated in inclusions</li>
                                            <li>Personal expenses and gratuities</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                <i class="bi bi-backpack-fill me-2 text-success"></i> Things to Bring
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="d-flex flex-wrap gap-3">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><strong>Pack smart for city strolls and mountain adventures—comfort and safety first!</strong></li>
                                            <ul>
                                                <li class="mb-2">Valid ID</li>
                                                <li class="mb-2">Booking confirmation / voucher</li>
                                                <li class="mb-2">Comfortable clothes (light for city, warm layers for Sagada) Walking / hiking shoes</li>
                                                <li class="mb-2">Jacket / raincoat</li>
                                                <li class="mb-2">Water bottle / hydration pack</li>
                                                <li class="mb-2">Snacks / trail food</li>
                                                <li class="mb-2">Sunscreen & insect repellent</li>
                                                <li class="mb-2">Cap / hat</li>
                                                <li class="mb-2">Personal medications & toiletries</li>
                                            </ul>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                <i class="bi bi-info-circle-fill me-2 text-success"></i> About the Tour
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse show" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <ul class="list-unstyled">
                                        <li class="mb-2"><strong><?php echo htmlspecialchars($tour['tour_name']); ?></strong></li>
                                            <ul>
                                                <li class="mb-2"><?php echo htmlspecialchars($about['description']); ?></li>
                                            </ul>
                                    </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="row g-3 text-center">
                    <div class="col-6">
                        <a href="bookingForm.php?tour_id=<?= $tour_id ?>" class="text-decoration-none">
                            <button class="btn btn-success w-100 btn-lg py-3 fw-bold rounded-pill shadow-sm">
                                Book Now
                            </button>
                        </a>
                    </div>

                    <div class="col-6">
<<<<<<< HEAD
                        <button class="btn btn-outline-secondary w-100 btn-lg py-3 fw-bold rounded-pill shadow-sm">
                            Add to Wishlist
                        </button>
                    </div>
                </div>
            </div>
=======
                        <button id="wishlistBtn" 
                        class="btn <?= $isWishlisted ? 'btn-danger' : 'btn-outline-danger' ?> px-5 btn-lg py-3 fw-bold rounded-pill w-100" 
                        onclick="toggleWishlist(this, <?= $tour_id ?>)">
                        <!-- ito yung changes na mangyayari of natrigger yung wishlist button -->
                        <!-- ang default look ng btn is yung Add to Wishlist na outlined -->
                        <!-- kapag clinick yun, magiging filled yung button then magiging Added to Wishlist yung text -->
                            <i class="bi <?= $isWishlisted ? 'bi-heart-fill' : 'bi-heart' ?> me-2"></i> 
                            <?= $isWishlisted ? 'Added to Wishlist' : 'Add to Wishlist' ?>
                        </button>

                    </div>
                </div>
            </div>
            
>>>>>>> 1ae3f7e (connect packageView to wishlist)
        </div>
    </div>
    <?php include "components/footer.php"; ?>
    <script>
        // pinapasa dito sa function na toh yung btn and yung tourId (para malaman if anong tour yung iniadd sa wishlist)
        function toggleWishlist(btn, tourId) {
            // https req toh fetch block na toh, api integ kumabaga
            fetch('php/handle_wishlist.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `tour_id=${tourId}`
            })
            .then(response => response.json())
            // ito yung response pag naexecute na yung fetch request
            .then(data => {
                if (data.status === 'added') {
                    btn.classList.replace('btn-outline-danger', 'btn-danger');
                    btn.innerHTML = '<i class="bi bi-heart-fill me-2"></i> Added to Wishlist';
                } else if (data.status === 'removed') {
                    btn.classList.replace('btn-danger', 'btn-outline-danger');
                    btn.innerHTML = '<i class="bi bi-heart me-2"></i> Add to Wishlist';
                }
            })
            .catch(err => console.error('Wishlist Error:', err));
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
</body>

</html>