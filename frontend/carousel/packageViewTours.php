<div class="container-fluid p-0 position-relative mb-5" style="height: 600px;">
    <div class="container position-absolute top-50 start-50 translate-middle">
        <div class="row">
            <div class="col">
                <div class="text-center mb-5">
                    <h1 class="fw-bold text-success display-5 mb-2" style="font-family: 'Poppins', sans-serif;">
                        Places to Visit</h1>
                    <p class="text-success text-dark" style="font-size:1rem; font-family: 'Poppins', sans-serif;">
                        Discover breathtaking destinations handpicked by Escapinas. From iconic tourist spots to hidden gems.</p>
                </div>

                <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators" style="bottom: -50px;">
                        <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0"
                            class="active bg-success rounded-circle" style="width: 12px; height: 12px;"
                            aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1"
                            class="bg-success rounded-circle" style="width: 12px; height: 12px;" aria-label="Slide 2">

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

                                        <div class="row g-4">
                                        <?php
                                        $isActive = false;
                                    endif;
                                        ?>

                                        <div class="col-4">
                                            <div class="card destination-card border-0 shadow-lg">
                                                <img src="<?php echo htmlspecialchars($place['image']); ?>" class="card-img rounded-3" style="height: 300px; object-fit: cover;">
                                                <div class="card-img-overlay d-flex align-items-end p-3">

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
                </div>


                <div class="mt-5 pt-4 text-center">
                    <p class="fst-italic mb-0 text-muted">Destinations may vary based on weather and site availability. </p>
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
                </div>
            </div>
        </div>
    </div>
</div>