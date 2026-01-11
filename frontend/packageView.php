<?php
session_start();
include("backend/packageViewSelect.php");
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EscaPinas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="bg-light">
<!-- sa navbar may sira -->
    <?php include "components/navbar.php"; ?>
    <div class="row g-0">
        <div class="col">
            <div class="position-relative" style="height: 50vh; min-height: 350px; overflow: hidden;">

                <a href="javascript:history.back()"
                    class="btn btn-success btn-sm position-absolute rounded-pill shadow-sm px-3 py-2"
                    style="top: 20px; left: 20px; z-index: 10;">
                    <i class="bi bi-chevron-left"></i> Back
                </a>

                <?php
                $banner_src = !empty($tour['banner_image']) ? $tour['banner_image'] : "assets/images/default-banner.jpg";
                ?>

                <img src="<?php echo $banner_src; ?>"
                    class="w-100 h-100"
                    style="object-fit: cover;"
                    alt="Tour Banner">
            </div>
        </div>
    </div>
    <div class="container my-5 mb-5">
        <div class="row">
            <div class="col-12">
                <!-- maglalagay ng slots -->
                <div class="card shadow p-5 rounded-5">
                    <div class="mb-2 d-flex justify-content-between align-items-center flex-wrap">
                        <h1 class="fw-bold text-success ">₱
                            <?php echo htmlspecialchars($tour['price']); ?> <small
                                class="fw-bold text-muted fs-6 fw-normal">/ PAX</small>
                        </h1>
                        <div class="text-warning fs-6">
                            <span class="text-success small ms-2">
                                <?= $average ?> RATING (
                                <?= $count ?> Reviews)
                            </span>
                            <?php
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $average) {
                                    echo '<i class="bi bi-star-fill"></i>';
                                } elseif ($i - 0.5 <= $average) {
                                    echo '<i class="bi bi-star-half"></i>';
                                } else {
                                    echo '<i class="bi bi-star"></i>';
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <h1 class="fw-bold text-success mb-3">
                            <?php echo htmlspecialchars($tour['tour_name']); ?>
                        </h1>
                        <p class="text-secondary leading-relaxed">
                            <?php echo htmlspecialchars($tour['description']); ?>
                        </p>
                    </div>
                    <div class="row mb-5 justify-content-start g-2">
                        <div class="col-auto d-flex align-items-center gap-2 px-3">
                            <i class="bi bi-moon-stars text-success fs-6"></i>
                            <span class="fw-bold">
                                <?php echo htmlspecialchars($tour['duration_days']); ?>D -
                                <?php echo htmlspecialchars($tour['duration_nights']); ?>N
                            </span>
                        </div>
                        <div class="col-auto d-flex align-items-center gap-2 px-3 border-start">
                            <i class="bi bi-calendar-range text-success fs-6"></i>
                            <span class="fw-bold"></span>
                        </div>
                        <div class="col-auto d-flex align-items-center gap-2 px-3 border-start">
                            <i class="bi bi-bus-front text-success fs-6"></i>
                            <i class="bi bi-airplane text-success fs-6"></i>
                            <span class="fw-bold">TRANSPO</span>
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
    <?php include "carousel/packageViewTours.php"; ?>
    <?php include "accordion/packageViewAccordion.php"; ?>
    <div class="container my-5">
    <h3 class="fw-bold text-success mb-4">Customer Reviews</h3>
        <div class="row">
            <?php if (mysqli_num_rows($reviewsResult) > 0): ?>
                <?php while ($review = mysqli_fetch_assoc($reviewsResult)): ?>
                    <div class="col-md-6 mb-3">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="fw-bold mb-0">
                                    <?= htmlspecialchars($review['first_name'] . ' ' . $review['last_name']) ?>
                                </h6>
                                <div class="text-warning small">
                                    <?php
                                    for ($i = 1; $i <= 5; $i++) {
                                        echo ($i <= $review['rating_score']) ? '<i class="bi bi-star-fill"></i>' : '<i class="bi bi-star"></i>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <p class="text-secondary mb-0">
                                "<?= htmlspecialchars($review['review_text']) ?>"
                            </p>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12 text-center py-4">
                    <p class="text-muted italic">No reviews yet for this tour. Be the first to share your experience!</p>
                </div>
            <?php endif; ?>
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
        </div>
    </div>
    <?php include "components/footer.php"; ?>
    <script>
        function toggleWishlist(btn, tourId) {
            fetch('backend/handle_wishlist.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `tour_id=${tourId}`
            })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                console.log("Response from server:", data); // Check if this shows up
                if (data.status === 'added') {
                    btn.classList.replace('btn-outline-danger', 'btn-danger');
                    btn.innerHTML = '<i class="bi bi-heart-fill me-2"></i> Added to Wishlist';
                } else if (data.status === 'removed') {
                    btn.classList.replace('btn-danger', 'btn-outline-danger');
                    btn.innerHTML = '<i class="bi bi-heart me-2"></i> Add to Wishlist';
                }
            })
            .catch(err => {
                console.error('Wishlist Error:', err);
                alert("Could not update wishlist. Check console for details.");
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>