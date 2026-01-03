
<?php
  session_start();
  include 'frontend/php/connect.php';

  $query = "
      SELECT 
          t.tour_id,
          t.tour_name,
          t.description,
          t.price,
          IFNULL(AVG(r.rating_score), 0) AS avg_rating,
          COUNT(r.review_id) AS total_reviews
      FROM tour_packages t
      LEFT JOIN ratings r ON t.tour_id = r.tour_id
      WHERE t.status = 'Available'
      GROUP BY 
          t.tour_id,
          t.tour_name,
          t.description,
          t.price
      ORDER BY RAND()
      LIMIT 3
  ";

  $reviewsQuery = "
      SELECT 
          r.review_text,
          r.rating_score,
          u.first_name
      FROM ratings r
      LEFT JOIN users u ON r.user_id = u.user_id
      ORDER BY RAND()
      LIMIT 3
  ";

  $result = mysqli_query($conn, $query);
  $reviewsResult = mysqli_query($conn, $reviewsQuery);
  $initial = strtoupper(substr($review['first_name'] ?? 'A', 0, 1));

  if (!$result) {
      die("Tour query error: " . mysqli_error($conn));
  }
  if (!$reviewsResult) {
      die("Review query error: " . mysqli_error($conn));
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
</head>

<body class="bg-light">

  <?php include "frontend/components/navbar.php"; ?>
  <?php include "frontend/components/banner.php"; ?>

  <div class="container my-5">
    <div class="row">
      <div class="col-12 p-0">
        <h5 class="mt-3" style="font-size:20px; color:#053207;">
          Your Next Escape Starts Here!
        </h5>
      </div>

      <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <h2 class="fw-bold text-success">EscaPinas' Top Choices</h2>
        <a href="frontend/packages.php" class="text-decoration-none text-success fw-semibold mt-2 mt-md-0">
          View All Packages <i class="bi bi-arrow-right"></i>
        </a>
      </div>

      <div class="row g-4">
        <?php while ($row = mysqli_fetch_assoc($result)) {?>
          <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card h-100 shadow p-2 bg-success bg-opacity-25 rounded-4">

              <img src="frontend/assets/images/package<?php echo rand(1, 3)?>.jpg"
                  class="card-img-top rounded-4 p-2 shadow-sm"
                  style="height:300px; object-fit:cover;">

              <div class="card-body">
                <h5 class="fw-bold"><?php echo htmlspecialchars($row['tour_name'])?></h5>
                <p><?php echo htmlspecialchars($row['description'])?></p>

                <div class="d-flex align-items-center mb-2">
                  <span class="badge bg-success">Starts at</span>
                  <p class="fw-bold mb-0 ms-2 fs-3">
                    ₱<?php echo number_format($row['price'], 2)?>
                    <span class="fs-6">/per pax</span>
                  </p>
                </div>

                <a href="frontend/packageView.php?tour_id=<?php echo $row['tour_id']?>"
                  class="btn btn-success w-100 mt-2">
                  Book Now
                </a>
              </div>
            </div>
          </div>
        <?php }?>
      </div>
    </div>
  </div>

  <div class="container my-5 p-5">
    <div class="text-center mb-5">
      <h2 class="mb-2 fw-bold text-success">Hear From Other Travellers!</h2>
      <p class="mb-5 p-3 fst-italic text-muted">From first trips to favorite destinations, hear how EscaPinas made every journey memorable.</h2>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">

      <?php while ($review = mysqli_fetch_assoc($reviewsResult)) { ?>
        <div class="col">
          <div class="card shadow-sm h-100 position-relative pt-5 border-0">

            <div class="rounded-circle border border-4 border-white position-absolute top-0 start-50 translate-middle 
                        d-flex align-items-center justify-content-center bg-success text-white"
                style="width:100px; height:100px; font-size:36px; font-weight:bold;">
                <?php echo $initial; ?>
            </div>
            <div class="card-body text-center bg-white rounded shadow-sm mt-4">
              <h5 class="fw-bold text-success">
                <?php echo htmlspecialchars($review['full_name'] ?? 'Anonymous Traveller'); ?>
              </h5>

              <div class="text-warning mb-2">
                <?php
                  for ($i = 1; $i <= 5; $i++) {
                    echo ($i <= $review['rating_score']) ? '★' : '☆';
                  }
                ?>
              </div>

              <p class="text-muted small">
                <?php echo htmlspecialchars($review['review_text']); ?>
              </p>
            </div>
          </div>
        </div>
      <?php } ?>

    </div>
  </div>

    <div class="container my-5">
      <div class="text-center mb-5">
        <h2 class="fw-bold text-success">Why Travel With EscaPinas?</h2>
        <p class="text-muted">Your Best Choice for Traveling in the Philippines!</p>
      </div>
      <div class="row g-4 text-center">
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="border rounded-3 p-3 h-100">
            <i class="bi bi-shield-check mb-3 fs-1 text-success"></i>
            <h5 class="fw-bold text-success">Trusted And Reliable</h5>
            <p class="text-muted">We are a travel partner you can count on, committed to honest service and smooth
              experiences.</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="border rounded-3 p-3 h-100">
            <i class="bi bi-calendar-check mb-3 fs-1 text-success"></i>
            <h5 class="fw-bold text-success">We Save You Time</h5>
            <p class="text-muted">No more endless searching; we handle everything—from bookings to itineraries.</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="border rounded-3 p-3 h-100">
            <i class="bi bi-star mb-3 fs-1 text-success"></i>
            <h5 class="fw-bold text-success">Customer-First Service</h5>
            <p class="text-muted">We prioritize your comfort, safety, and satisfaction from start to finish.</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="border rounded-3 p-3 h-100">
            <i class="bi bi-geo-alt-fill mb-3 fs-1 text-success"></i>
            <h5 class="fw-bold text-success">Well-Planned Itineraries</h5>
            <p class="text-muted">Every trip is organized so your time and money are maximized for seamless planning.
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="container my-5">
      <div class="row align-items-center g-4">
        
        <div class="col-md-6 text-center text-md-start">
          <h4 class="fw-bold text-success">Secure Payments, Peace of Mind</h4>
          <p class="text-muted">
            All transactions are protected with top-tier security, keeping your details safe while planning your getaway.
          </p>
          
          <div class="d-flex gap-3 justify-content-center justify-content-md-start mt-3">
            <img src="frontend/assets/images/paypal.png" class="img-fluid" style="height:45px;">
            <img src="frontend/assets/images/gcash.png" class="img-fluid" style="height:45px;">
            <img src="frontend/assets/images/mastercard.webp" class="img-fluid" style="height:45px;">
          </div>
        </div>
        
        <div class="col-md-6 text-center">
          <img src="frontend/assets/images/banner_about.jpg" 
              class="img-fluid rounded shadow-lg border border-2 border-success"
              style="max-height:300px; width:100%; transition: transform 0.3s;"
              onmouseover="this.style.transform='scale(1.05)';"
              onmouseout="this.style.transform='scale(1)';">
        </div>
        
      </div>
    </div>

    <?php include "frontend/components/footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
