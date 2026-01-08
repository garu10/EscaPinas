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
                        <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
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