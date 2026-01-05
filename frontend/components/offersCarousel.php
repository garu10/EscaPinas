<?php 
$query = "SELECT * FROM tour_packages";
$result = executeQuery($query);

$promoPackages = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $promoPackages[] = $row;
    }
}

$slides = array_chunk($promoPackages, 3);
?>

<div class="container my-5 text-center">
    <h4 class="text-success fw-bold">Exclusive Package Deals</h4>
    
    <div id="carouselExample" class="carousel slide mt-3" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php if (empty($slides)): ?>
                <div class="carousel-item active">
                    <p class="text-muted">Walang promo sa ngayon.</p>
                </div>
            <?php else: ?>
                <?php foreach ($slides as $index => $group): ?>
                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                        <div class="row g-3 justify-content-center px-5">
                            <?php foreach ($group as $key => $tour): ?>
                                <div class="col-12 col-md-6 col-lg-4 <?php echo $key > 0 ? 'd-none d-md-block' : ''; ?>">
                                    <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                                        <img src="<?php echo htmlspecialchars($tour['image']); ?>" class="card-img-top" style="height: 350px; object-fit: cover;">
                                        <div class="card-body bg-light text-start">
                                            <h6 class="fw-bold mb-1"><?php echo htmlspecialchars($tour['tour_name']); ?></h6>
                                            <p class="small text-muted mb-0">Exclusive Deal</p>
                                            <div class="mt-2 text-success fw-bold">
                                                ₱<?php echo number_format($tour['price'], 2); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bg-success rounded-circle" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon bg-success rounded-circle" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>