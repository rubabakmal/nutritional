@extends('website-layout.app')
@section('content')
    <div class="site-wrap">



        <div class="carousl-wrap">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('assets/imgs/carosul1.jpeg') }}" class="d-block w-100" alt="Banner 1">
                    </div>
                    <div class="carousel-item carousel-with-overlay">
                        <img src="{{ asset('assets/imgs/carosul2.jpeg') }}" class="d-block w-100" alt="Banner 2">

                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/imgs/carosul3.jpeg') }}" class="d-block w-100" alt="Banner 3">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/imgs/carosul4.jpeg') }}" class="d-block w-100" alt="Banner 3">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/imgs/carosul5.jpeg') }}" class="d-block w-100" alt="Banner 3">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/imgs/carosul6.jpeg') }}" class="d-block w-100" alt="Banner 3">
                    </div>

                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>


        </div>

        <section class="goal-section" id="goal">
            <h2 class="goal-title">Find Honey For Your Goal</h2>
            <div class="goal-grid">
                <div class="goal-box">
                    <img src="{{ asset('assets/imgs/fertlity.png') }}" alt="Fertility">
                </div>
                <div class="goal-box">
                    <img src="{{ asset('assets/imgs/immunity.png') }}" alt="Immunity">
                </div>
                <div class="goal-box">
                    <img src="{{ asset('assets/imgs/skin.png') }}" alt="Skin">
                </div>
                <div class="goal-box">
                    <img src="{{ asset('assets/imgs/health.png') }}" alt="Gut Health">
                </div>
                <div class="goal-box">
                    <img src="{{ asset('assets/imgs/mood.png') }}" alt="Mood Refresher">
                </div>
                <div class="goal-box">
                    <img src="{{ asset('assets/imgs/vitality.png') }}" alt="Vitality">
                </div>
            </div>
        </section>


        <section class="customer-reviews-section py-5">
            <div class="container">
                <!-- Section Header -->
                <div class="row">
                    <div class="col-12 text-center mb-5">
                        <h2 class="goal-title">Our Sweet & Happy Customers</h2>
                        <div class="main-rating mb-2">
                            <i class="bi bi-star-fill star"></i>
                            <i class="bi bi-star-fill star"></i>
                            <i class="bi bi-star-fill star"></i>
                            <i class="bi bi-star-fill star"></i>
                            <i class="bi bi-star-fill star"></i>
                        </div>
                        <p class="review-count">from 1214 reviews</p>
                    </div>
                </div>

                <!-- Reviews Carousel -->
                <div id="reviewsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                    <div class="carousel-inner">
                        <!-- Slide 1 -->
                        <div class="carousel-item active">
                            <div class="row g-4">
                                <!-- Review 1 -->
                                <div class="col-lg-4 col-md-6">
                                    <div class="review-card">
                                        <div class="review-rating mb-3">
                                            <i class="bi bi-star-fill star"></i>
                                            <i class="bi bi-star-fill star"></i>
                                            <i class="bi bi-star-fill star"></i>
                                            <i class="bi bi-star-fill star"></i>
                                            <i class="bi bi-star-fill star"></i>
                                        </div>
                                        <div class="review-content">
                                            <div class="product-info d-flex align-items-start mb-3">
                                                <div class="product-image me-3">
                                                    <img src="{{ asset('assets/imgs/1.webp') }}" alt="Royal Jelly Honey"
                                                        class="product-img">
                                                </div>
                                                <div class="product-details">
                                                    <h5 class="product-title">Luxurious Yemeni Honey Infused with Royal
                                                        Jelly</h5>
                                                    <p class="review-text">This raw Yemeni honey from the valley of
                                                        Do'an, infused with pure Royal Jelly, is nothing short of
                                                        extraordinary. The rich, smooth texture of the Sidr Do'ani
                                                        honey...</p>
                                                </div>
                                            </div>
                                            <div class="customer-info">
                                                <p class="customer-name">Customer</p>
                                                <p class="product-variant">Royal Jelly Fusion</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Review 2 -->
                                <div class="col-lg-4 col-md-6">
                                    <div class="review-card">
                                        <div class="review-rating mb-3">
                                            <i class="bi bi-star-fill star"></i>
                                            <i class="bi bi-star-fill star"></i>
                                            <i class="bi bi-star-fill star"></i>
                                            <i class="bi bi-star-fill star"></i>
                                            <i class="bi bi-star-fill star"></i>
                                        </div>
                                        <div class="review-content">
                                            <div class="product-info d-flex align-items-start mb-3">
                                                <div class="product-image me-3">
                                                    <img src="{{ asset('assets/imgs/2.avif') }}" alt="White Honey"
                                                        class="product-img">
                                                </div>
                                                <div class="product-details">
                                                    <h5 class="product-title">Exquisite White Honey with a Floral
                                                        Symphony</h5>
                                                    <p class="review-text">This rare white honey from the Issyk-Kul
                                                        Valley is an absolute delight. The pure, raw quality shines
                                                        through in both its appearance and taste. The floral aroma is
                                                        incredibly...</p>
                                                </div>
                                            </div>
                                            <div class="customer-info">
                                                <p class="customer-name">U.I.</p>
                                                <p class="product-variant">White Mountain</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Review 3 -->
                                <div class="col-lg-4 col-md-6">
                                    <div class="review-card">
                                        <div class="review-rating mb-3">
                                            <i class="bi bi-star-fill star"></i>
                                            <i class="bi bi-star-fill star"></i>
                                            <i class="bi bi-star-fill star"></i>
                                            <i class="bi bi-star-fill star"></i>
                                            <i class="bi bi-star-fill star"></i>
                                        </div>
                                        <div class="review-content">
                                            <div class="product-info d-flex align-items-start mb-3">
                                                <div class="product-image me-3">
                                                    <img src="{{ asset('assets/imgs/1.webp') }}" alt="Raw Honey"
                                                        class="product-img">
                                                    <div class="award-badge">
                                                        <span>Great Taste</span>
                                                    </div>
                                                </div>
                                                <div class="product-details">
                                                    <h5 class="product-title">One of the most exquisite raw honey
                                                        brands</h5>
                                                    <p class="review-text">Really, rich and gives immediate energy
                                                        boost. Complete pharmacy in a container. Highly recommend</p>
                                                </div>
                                            </div>
                                            <div class="customer-info">
                                                <p class="customer-name">Yasser Elmahmoudy</p>
                                                <p class="product-variant">Yemeni Sidr Do'Ani</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 2 -->
                        <div class="carousel-item">
                            <div class="row g-4">
                                <!-- Review 4 -->
                                <div class="col-lg-4 col-md-6">
                                    <div class="review-card">
                                        <div class="review-rating mb-3">
                                            <i class="bi bi-star-fill star"></i>
                                            <i class="bi bi-star-fill star"></i>
                                            <i class="bi bi-star-fill star"></i>
                                            <i class="bi bi-star-fill star"></i>
                                            <i class="bi bi-star-fill star"></i>
                                        </div>
                                        <div class="review-content">
                                            <div class="product-info d-flex align-items-start mb-3">
                                                <div class="product-image me-3">
                                                    <img src="{{ asset('assets/imgs/3.avif') }}" alt="Black Seed Honey"
                                                        class="product-img">
                                                </div>
                                                <div class="product-details">
                                                    <h5 class="product-title">Amazing Black Seed Honey</h5>
                                                    <p class="review-text">The quality is exceptional and the taste is
                                                        absolutely divine. This honey has become part of my daily
                                                        routine for better health and wellness...</p>
                                                </div>
                                            </div>
                                            <div class="customer-info">
                                                <p class="customer-name">Sarah Ahmed</p>
                                                <p class="product-variant">Black Seed Fusion</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Review 5 -->
                                <div class="col-lg-4 col-md-6">
                                    <div class="review-card">
                                        <div class="review-rating mb-3">
                                            <i class="bi bi-star-fill star"></i>
                                            <i class="bi bi-star-fill star"></i>
                                            <i class="bi bi-star-fill star"></i>
                                            <i class="bi bi-star-fill star"></i>
                                            <i class="bi bi-star-fill star"></i>
                                        </div>
                                        <div class="review-content">
                                            <div class="product-info d-flex align-items-start mb-3">
                                                <div class="product-image me-3">
                                                    <img src="{{ asset('assets/imgs/4.avif') }}" alt="Saffron Honey"
                                                        class="product-img">
                                                </div>
                                                <div class="product-details">
                                                    <h5 class="product-title">Premium Saffron Infused Honey</h5>
                                                    <p class="review-text">Incredible flavor and aroma. The saffron
                                                        adds such a luxurious touch to the already amazing honey. Worth
                                                        every penny...</p>
                                                </div>
                                            </div>
                                            <div class="customer-info">
                                                <p class="customer-name">Mohammed Al-Rashid</p>
                                                <p class="product-variant">Saffron Fusion</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Review 6 -->
                                <div class="col-lg-4 col-md-6">
                                    <div class="review-card">
                                        <div class="review-rating mb-3">
                                            <i class="bi bi-star-fill star"></i>
                                            <i class="bi bi-star-fill star"></i>
                                            <i class="bi bi-star-fill star"></i>
                                            <i class="bi bi-star-fill star"></i>
                                            <i class="bi bi-star-fill star"></i>
                                        </div>
                                        <div class="review-content">
                                            <div class="product-info d-flex align-items-start mb-3">
                                                <div class="product-image me-3">
                                                    <img src="{{ asset('assets/imgs/3.avif') }}" alt="Manuka Honey"
                                                        class="product-img">
                                                </div>
                                                <div class="product-details">
                                                    <h5 class="product-title">Authentic Manuka Honey</h5>
                                                    <p class="review-text">Best quality Manuka honey I've ever tried.
                                                        The medicinal properties are clearly evident and the taste is
                                                        simply wonderful...</p>
                                                </div>
                                            </div>
                                            <div class="customer-info">
                                                <p class="customer-name">Lisa Johnson</p>
                                                <p class="product-variant">Manuka Premium</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Carousel Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#reviewsCarousel"
                        data-bs-slide="prev">
                        <i class="bi bi-chevron-left carousel-arrow"></i>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#reviewsCarousel"
                        data-bs-slide="next">
                        <i class="bi bi-chevron-right carousel-arrow"></i>
                        <span class="visually-hidden">Next</span>
                    </button>

                    <!-- Carousel Indicators -->
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#reviewsCarousel" data-bs-slide-to="0"
                            class="active"></button>
                        <button type="button" data-bs-target="#reviewsCarousel" data-bs-slide-to="1"></button>
                    </div>
                </div>
            </div>
        </section>


        {{-- <section class="video-section">
            <div class="video-wrap">
                <video autoplay muted loop playsinline class="background-video">
                    <source src="{{ asset('assets/imgs/video.mp4') }}" type="video/mp4">
                    <img src="fallback-image.jpg" alt="Fallback" class="fallback-image">
                </video>
                <div class="video-overlay">
                </div>
            </div>
        </section> --}}


        <section class="why-choose-section py-5" id="about-us">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Section Title -->
                        <div class="text-center mb-5">
                            <h2 class="goal-title">Why Choose Our Raw Honey?</h2>
                            <div class="title-underline"></div>
                        </div>

                        <!-- Content -->
                        <div class="content-wrapper">
                            <div class="row justify-content-center">
                                <div class="col-lg-10 col-xl-9">
                                    <!-- Paragraph 1 -->
                                    <p class="content-paragraph">
                                        Balqees is a raw honey shop that became one of the most popular purveyors of
                                        premium raw honey around the Middle East. <br>
                                        Due to our passion for the product and proven success, we have now expanded our
                                        range across the UK and the globe.
                                    </p>

                                    <!-- Paragraph 2 -->
                                    <p class="content-paragraph">
                                        We collaborate with independent beekeepers and beekeeping cooperatives around
                                        the world that follow sustainable and <br>
                                        ethical practices. With every purchase, it will contribute to supporting
                                        beekeepers and their families in rural communities <br>
                                        locally and internationally.
                                    </p>

                                    <!-- Paragraph 3 -->
                                    <p class="content-paragraph mb-4">
                                        All our raw honey comes straight from the hive. We do not heat-treat or
                                        micro-filter the honey, and none of our beekeepers or <br>
                                        apiculturists feed sugar solutions or supplements to their bees. We are
                                        dedicated to sourcing the purest and most natural raw <br>
                                        honey on the planet.
                                    </p>

                                    <!-- CTA Button -->
                                    <div class="text-center">
                                        <a href="#" class="shop-now-btn">
                                            Shop Now
                                            <span class="btn-arrow">→</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <div class="cart-section" id="product">
            <div class="container d-flex flex-column align-items-center">

                <h2 class="goal-title" style="padding-top: 2rem;
                padding-bottom:2rem;">Perfect Gift for
                    Honey Lovers</h2>
                <div class="row">
                    <!-- Card 1 -->
                    <div class="col-md-3">
                        <div class="item">
                            <div class="loved-card-wrapper">
                                <div class="loved-card position-relative">
                                    <img src="{{ asset('assets/imgs/cart-img3.jpg') }}" alt="Product 1"
                                        class="img-fluid w-100">
                                    <div class="loved-overlay">
                                        <a href="#" class="loved-icon"> <i class="fas fa-shopping-cart"></i></a>
                                    </div>
                                </div>

                                <h6 class="mt-3 mb-1">YEMENI CLASSIC</h6>
                                <p class="text-muted mb-0">Royal Cave</p>
                                <small class="text-muted">From AED 2,017.00</small>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-md-3">
                        <div class="item">
                            <div class="loved-card-wrapper">
                                <div class="loved-card position-relative">
                                    <img src="{{ asset('assets/imgs/balkees-card.jpg') }}" alt="Product 2"
                                        class="img-fluid w-100">
                                    <div class="loved-overlay">
                                        <a href="#" class="loved-icon"> <i class="fas fa-shopping-cart"></i></a>
                                    </div>
                                </div>
                                <h6 class="mt-3 mb-1">HONEY FUSIONS</h6>
                                <p class="text-muted mb-0">Ginseng Fusion</p>
                                <small class="text-muted">From AED 197.00</small>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="col-md-3">
                        <div class="item">
                            <div class="loved-card-wrapper">
                                <div class="loved-card position-relative">
                                    <img src="{{ asset('assets/imgs/3.jpg') }}" alt="Product 3" class="img-fluid w-100">
                                    <div class="loved-overlay">
                                        <a href="#" class="loved-icon"> <i class="fas fa-shopping-cart"></i></a>
                                    </div>
                                </div>
                                <h6 class="mt-3 mb-1">HONEY FUSIONS</h6>
                                <p class="text-muted mb-0">Ginseng Fusion</p>
                                <small class="text-muted">From AED 197.00</small>
                            </div>
                        </div>

                    </div>
                    <!-- Card 4 -->
                    <div class="col-md-3">
                        <div class="item">
                            <div class="loved-card-wrapper">
                                <div class="loved-card position-relative">
                                    <img src="{{ asset('assets/imgs/cart-img4.jpg') }}" alt="Product 4"
                                        class="img-fluid w-100">
                                    <div class="loved-overlay">
                                        <a href="#" class="loved-icon"> <i class="fas fa-shopping-cart"></i></a>
                                    </div>
                                </div>
                                <h6 class="mt-3 mb-1">HONEY FUSIONS</h6>
                                <p class="text-muted mb-0">Ginseng Fusion</p>
                                <small class="text-muted">From AED 197.00</small>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <!-- Card 1 -->
                    <div class="col-md-3">
                        <div class="item">
                            <div class="loved-card-wrapper">
                                <div class="loved-card position-relative">
                                    <img src="{{ asset('assets/imgs/cart-row2.jpg') }}" alt="Product 5"
                                        class="img-fluid w-100">
                                    <div class="loved-overlay">
                                        <a href="#" class="loved-icon"> <i class="fas fa-shopping-cart"></i></a>
                                    </div>
                                </div>
                                <h6 class="mt-3 mb-1">HONEY FUSIONS</h6>
                                <p class="text-muted mb-0">Ginseng Fusion</p>
                                <small class="text-muted">From AED 197.00</small>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-md-3">
                        <div class="item">
                            <div class="loved-card-wrapper">
                                <div class="loved-card position-relative">
                                    <img src="{{ asset('assets/imgs/7.jpg') }}" alt="Product 6" class="img-fluid w-100">
                                    <div class="loved-overlay">
                                        <a href="#" class="loved-icon"> <i class="fas fa-shopping-cart"></i></a>
                                    </div>
                                </div>
                                <h6 class="mt-3 mb-1">HONEY FUSIONS</h6>
                                <p class="text-muted mb-0">Ginseng Fusion</p>
                                <small class="text-muted">From AED 197.00</small>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="col-md-3">

                        <div class="item">
                            <div class="loved-card-wrapper">
                                <div class="loved-card position-relative">
                                    <img src="{{ asset('assets/imgs/cart-row4.jpg') }}" alt="Product 7"
                                        class="img-fluid w-100">
                                    <div class="loved-overlay">
                                        <a href="#" class="loved-icon"> <i class="fas fa-shopping-cart"></i></a>
                                    </div>
                                </div>
                                <h6 class="mt-3 mb-1">HONEY FUSIONS</h6>
                                <p class="text-muted mb-0">Ginseng Fusion</p>
                                <small class="text-muted">From AED 197.00</small>
                            </div>
                        </div>
                    </div>
                    <!-- Card 4 -->
                    <div class="col-md-3">
                        <div class="item">
                            <div class="loved-card-wrapper">
                                <div class="loved-card position-relative">
                                    <img src="{{ asset('assets/imgs/balkees-card.jpg') }}" alt="Product 2"
                                        class="img-fluid w-100">
                                    <div class="loved-overlay">
                                        <a href="#" class="loved-icon"> <i class="fas fa-shopping-cart"></i></a>
                                    </div>
                                </div>
                                <h6 class="mt-3 mb-1">HONEY FUSIONS</h6>
                                <p class="text-muted mb-0">Ginseng Fusion</p>
                                <small class="text-muted">From AED 197.00</small>
                            </div>
                        </div>
                    </div>




                </div>
            </div>
        </div>


        <section class="quiz-section">
            <h2>Not sure where to start?</h2>
            <p>Take the Quiz and find out which product is best for you!</p>
            <div class="text-center">
                <a href="#" class="shop-now-btn quize-btn">
                    Start Now
                    <span class="btn-arrow">→</span>
                </a>
            </div>
            <div class="quiz-icons">
                <div class="quiz-icon">
                    <img src="{{ asset('assets/imgs/gut-health.png') }}" alt="Gut">
                    <span>Gut health</span>
                </div>
                <div class="quiz-icon">
                    <img src="{{ asset('assets/imgs/mood2.png') }}" alt="Mood">
                    <span>Mood</span>
                </div>
                <div class="quiz-icon">
                    <img src="{{ asset('assets/imgs/energy.png') }}" alt="Vitality">
                    <span>Vitality/Energy</span>
                </div>
                <div class="quiz-icon">
                    <img src="{{ asset('assets/imgs/imunity.png') }}" alt="Immunity">
                    <span>Immunity</span>
                </div>
                <div class="quiz-icon">
                    <img src="{{ asset('assets/imgs/skin & beauty.png') }}" alt="Skin">
                    <span>Skin and Beauty</span>
                </div>
                <div class="quiz-icon">
                    <img src="{{ asset('assets/imgs/fertlity.png') }}" alt="Fertility">
                    <span>Fertility/Libido</span>
                </div>
            </div>
        </section>


        {{-- <div class="most-loved-wrap">
            <section class="py-5">
                <div class="container text-center">
                    <h2 class="goal-title" style="padding-top: 2rem; padding-bottom:2rem;">Our Most-Loved</h2>
                    <div class="mx-auto position-relative" style="max-width: 1100px;">
                        <div class="owl-carousel owl-theme most-loved-carousel">
                            <!-- Card 1 -->
                            <div class="item">
                                <div class="loved-card-wrapper">
                                    <div class="loved-card position-relative">
                                        <img src="{{ asset('assets/imgs/1.jpg') }}" alt="Product 1"
                                            class="img-fluid w-100">
                                        <div class="loved-overlay">
                                            <a href="#" class="loved-icon"> <i
                                                    class="fas fa-shopping-cart"></i></a>
                                        </div>
                                    </div>

                                    <h6 class="mt-3 mb-1">YEMENI CLASSIC</h6>
                                    <p class="text-muted mb-0">Royal Cave</p>
                                    <small class="text-muted">From AED 2,017.00</small>
                                </div>
                            </div>

                            <!-- Card 2 -->
                            <div class="item">
                                <div class="loved-card-wrapper">
                                    <div class="loved-card position-relative">
                                        <img src="{{ asset('assets/imgs/balkees-card.jpg') }}" alt="Product 2"
                                            class="img-fluid w-100">
                                        <div class="loved-overlay">
                                            <a href="#" class="loved-icon"> <i
                                                    class="fas fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                    <h6 class="mt-3 mb-1">HONEY FUSIONS</h6>
                                    <p class="text-muted mb-0">Ginseng Fusion</p>
                                    <small class="text-muted">From AED 197.00</small>
                                </div>
                            </div>

                            <!-- Card 3 -->
                            <div class="item">
                                <div class="loved-card-wrapper">
                                    <div class="loved-card position-relative">
                                        <img src="{{ asset('assets/imgs/3.jpg') }}" alt="Product 3"
                                            class="img-fluid w-100">
                                        <div class="loved-overlay">
                                            <a href="#" class="loved-icon"> <i
                                                    class="fas fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                    <h6 class="mt-3 mb-1">HONEY FUSIONS</h6>
                                    <p class="text-muted mb-0">Ginseng Fusion</p>
                                    <small class="text-muted">From AED 197.00</small>
                                </div>
                            </div>

                            <!-- Card 4 -->
                            <div class="item">
                                <div class="loved-card-wrapper">
                                    <div class="loved-card position-relative">
                                        <img src="{{ asset('assets/imgs/4.png') }}" alt="Product 4"
                                            class="img-fluid w-100">
                                        <div class="loved-overlay">
                                            <a href="#" class="loved-icon"> <i
                                                    class="fas fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                    <h6 class="mt-3 mb-1">HONEY FUSIONS</h6>
                                    <p class="text-muted mb-0">Ginseng Fusion</p>
                                    <small class="text-muted">From AED 197.00</small>
                                </div>
                            </div>

                            <!-- Card 5 -->
                            <div class="item">
                                <div class="loved-card-wrapper">
                                    <div class="loved-card position-relative">
                                        <img src="{{ asset('assets/imgs/5.png') }}" alt="Product 5"
                                            class="img-fluid w-100">
                                        <div class="loved-overlay">
                                            <a href="#" class="loved-icon"> <i
                                                    class="fas fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                    <h6 class="mt-3 mb-1">HONEY FUSIONS</h6>
                                    <p class="text-muted mb-0">Ginseng Fusion</p>
                                    <small class="text-muted">From AED 197.00</small>
                                </div>
                            </div>

                            <!-- Card 6 -->
                            <div class="item">
                                <div class="loved-card-wrapper">
                                    <div class="loved-card position-relative">
                                        <img src="{{ asset('assets/imgs/7.jpg') }}" alt="Product 6"
                                            class="img-fluid w-100">
                                        <div class="loved-overlay">
                                            <a href="#" class="loved-icon"> <i
                                                    class="fas fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                    <h6 class="mt-3 mb-1">HONEY FUSIONS</h6>
                                    <p class="text-muted mb-0">Ginseng Fusion</p>
                                    <small class="text-muted">From AED 197.00</small>
                                </div>
                            </div>

                            <!-- Card 7 -->
                            <div class="item">
                                <div class="loved-card-wrapper">
                                    <div class="loved-card position-relative">
                                        <img src="{{ asset('assets/imgs/1.jpg') }}" alt="Product 7"
                                            class="img-fluid w-100">
                                        <div class="loved-overlay">
                                            <a href="#" class="loved-icon"> <i
                                                    class="fas fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                    <h6 class="mt-3 mb-1">HONEY FUSIONS</h6>
                                    <p class="text-muted mb-0">Ginseng Fusion</p>
                                    <small class="text-muted">From AED 197.00</small>
                                </div>
                            </div>
                        </div>

                        <div class="custom-nav">
                            <div class="custom-prev"><i class="fas fa-chevron-left"></i></div>
                            <div class="custom-next"><i class="fas fa-chevron-right"></i></div>
                        </div>
                    </div>
                </div>
            </section>
        </div> --}}

        @php
            use App\Models\Product;
            // Fetch products from database
            $featuredProducts = Product::with('category')->where('status', 'active')->latest()->limit(10)->get();
        @endphp



        <div class="loved-wrap">
            <div class="most-loved-wrap">
                <section class="py-5">
                    <div class="container text-center">
                        <h2 class="goal-title" style="padding-top: 2rem; padding-bottom:2rem;">Our Most-Loved</h2>
                        <div class="mx-auto position-relative" style="max-width: 1100px;">
                            <div class="owl-carousel owl-theme most-loved-carousel">

                                @if ($featuredProducts->count() > 0)
                                    @foreach ($featuredProducts as $product)
                                        <div class="item">
                                            <div class="loved-card-wrapper">
                                                <!-- Product Image - Clickable with ID -->
                                                <a href="{{ route('product.detail', $product->id) }}"
                                                    class="product-link">
                                                    <div class="loved-card position-relative">
                                                        <img src="{{ $product->image ? Storage::url($product->image) : asset('assets/imgs/default-product.jpg') }}"
                                                            alt="{{ $product->name }}" class="img-fluid w-100">
                                                        <div class="loved-overlay">
                                                            <!-- Cart Button - Stops propagation -->
                                                            <button type="button" class="loved-icon btn btn-primary"
                                                                onclick="event.preventDefault(); event.stopPropagation(); testAddToCart({{ $product->id }})"
                                                                data-product-id="{{ $product->id }}"
                                                                data-product-name="{{ $product->name }}"
                                                                data-product-price="{{ $product->price }}">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </a>

                                                <!-- Product Info - Clickable with ID -->
                                                <a href="{{ route('product.detail', $product->id) }}"
                                                    class="product-info-link ">
                                                    <h6 class="mt-3 mb-1">
                                                        {{ strtoupper($product->category->name ?? 'PRODUCT') }}</h6>
                                                    <p class="text-muted mb-0">{{ $product->name }}</p>
                                                    <small class="text-muted">From AED
                                                        {{ number_format($product->price, 2) }}</small>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="alert alert-warning">
                                        <strong>No products found!</strong> Please add some products to the database.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>


        <section class="py-5 most-loved">
            <div class="container text-center">
                <h2 class="goal-title" style="padding-top: 2rem;
                padding-bottom:2rem;">Perfect Gift for
                    Honey Lovers</h2>
                <div class="mx-auto" style="max-width: 1000px;">
                    <div class="owl-carousel owl-theme gift-carousel">

                        <!-- Card 1 -->
                        <div class="item">
                            <div class="card-image-container">
                                <img src="{{ asset('assets/imgs/gift-card1.webp') }}" class="img-fluid" alt="Gift 1">
                                <div class="overlay">
                                    <a href="#" class="cart-icon">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </div>
                            </div>
                            <h6 class="mt-3 mb-1">Yemeni Raw Honey Gift Box 1KG</h6>
                            <p class="text-muted"><em>AED 729.00</em></p>
                        </div>

                        <!-- Card 2 -->
                        <div class="item">
                            <div class="card-image-container">
                                <img src="{{ asset('assets/imgs/gift-card2.webp') }}" class="img-fluid" alt="Gift 2">
                                <div class="overlay">
                                    <a href="#" class="cart-icon">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </div>
                            </div>
                            <h6 class="mt-3 mb-1">Fusion Gift Box 250G x 2</h6>
                            <p class="text-muted"><em>AED 397.00</em></p>
                        </div>

                        <!-- Card 3 -->
                        <div class="item">
                            <div class="card-image-container">
                                <img src="{{ asset('assets/imgs/gift-card3.webp') }}" class="img-fluid" alt="Gift 3">
                                <div class="overlay">
                                    <a href="#" class="cart-icon">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </div>
                            </div>
                            <h6 class="mt-3 mb-1">Fusion Gift Box 400G</h6>
                            <p class="text-muted"><em>AED 355.00</em></p>
                        </div>

                        <!-- Card 4 -->
                        <div class="item">
                            <div class="card-image-container">
                                <img src="{{ asset('assets/imgs/gift-card5.webp') }}" class="img-fluid" alt="Gift 4">
                                <div class="overlay">
                                    <a href="#" class="cart-icon">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </div>
                            </div>
                            <h6 class="mt-3 mb-1">Yemeni Gift Box 250G x 2</h6>
                            <p class="text-muted"><em>AED 379.00</em></p>
                        </div>

                    </div>
                </div>
            </div>
        </section>





        <section class="store-banner">
            <div class="store-content">
                <h2>Experience Our Products In Person</h2>
                <div class="text-center">
                    <a href="#" class="shop-now-btn">
                        Location
                        <span class="btn-arrow">→</span>
                    </a>
                </div>
            </div>
        </section>



        <section class="py-5" id="blogs">
            <div class="container d-flex flex-column align-items-center">
                <h2 class="goal-title" style="padding-top: 2rem;
                padding-bottom:2rem;">Take a Read of Our
                    Informative Blog Posts</h2>

                <div class="owl-carousel owl-theme blog-carousel">

                    <!-- Blog 1 -->
                    <div class="item">
                        <div class="card blog-card">
                            <img src="{{ asset('assets/imgs/blog1.webp') }}" class="card-img-top" alt="Blog 1">
                            <div class="card-body">
                                <h6 class="fw-semibold">8 Honey Beauty Recipes That Enhance Skin</h6>
                                <p class="text-muted small mb-1">on August 4, 2025</p>
                                <p class="text-muted small">Ready to change your beauty routine without breaking the
                                    bank...</p>
                            </div>
                        </div>
                    </div>

                    <!-- Blog 2 -->
                    <div class="item">
                        <div class="card blog-card">
                            <img src="{{ asset('assets/imgs/blog-card2.webp') }}" class="card-img-top" alt="Blog 2">
                            <div class="card-body">
                                <h6 class="fw-semibold">Honey Storage Guide</h6>
                                <p class="text-muted small mb-1">on July 22, 2025</p>
                                <p class="text-muted small">Raw honey is one of nature’s most remarkable preservatives...
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Blog 3 -->
                    <div class="item">
                        <div class="card blog-card">
                            <img src="{{ asset('assets/imgs/blog-card3.webp') }}" class="card-img-top" alt="Blog 3">
                            <div class="card-body">
                                <h6 class="fw-semibold">Can Honey Help You Sleep Better?</h6>
                                <p class="text-muted small mb-1">on July 14, 2025</p>
                                <p class="text-muted small">Tossing and turning night after night? Before you surrender
                                    to...</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="card blog-card">
                            <img src="{{ asset('assets/imgs/blog5.webp') }}" class="card-img-top" alt="Blog 3">
                            <div class="card-body">
                                <h6 class="fw-semibold">Can Honey Help You Sleep Better?</h6>
                                <p class="text-muted small mb-1">on July 14, 2025</p>
                                <p class="text-muted small">Tossing and turning night after night? Before you surrender
                                    to...</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="card blog-card">
                            <img src="{{ asset('assets/imgs/blog6.avif') }}" class="card-img-top" alt="Blog 3">
                            <div class="card-body">
                                <h6 class="fw-semibold">Can Honey Help You Sleep Better?</h6>
                                <p class="text-muted small mb-1">on July 14, 2025</p>
                                <p class="text-muted small">Tossing and turning night after night? Before you surrender
                                    to...</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="card blog-card">
                            <img src="{{ asset('assets/imgs/blog7.avif') }}" class="card-img-top" alt="Blog 3">
                            <div class="card-body">
                                <h6 class="fw-semibold">Can Honey Help You Sleep Better?</h6>
                                <p class="text-muted small mb-1">on July 14, 2025</p>
                                <p class="text-muted small">Tossing and turning night after night? Before you surrender
                                    to...</p>
                            </div>
                        </div>
                    </div>

                    <!-- Add more cards as needed... -->

                </div>
            </div>
        </section>

    </div>
@endsection
