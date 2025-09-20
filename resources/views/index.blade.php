@extends('website-layout.app')
@section('content')
    <div class="site-wrap">



        <div class="carousl-wrap main-carosul">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"
                        aria-label="Slide 4"></button>
                </div>

                <!-- Slides -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('assets/imgs/banner1.png') }}" class="d-block w-100" alt="Banner 1">
                        <div class="carousel-overlay">
                            <div class="text-center">
                                <a href="#product" onclick="smoothScrollTo('product')" class="shop-now-btn">
                                    Shop Now
                                    <span class="btn-arrow">→</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="carousel-item">
                        <img src="{{ asset('assets/imgs/banner2.png') }}" class="d-block w-100" alt="Banner 2">
                        <div class="carousel-overlay">
                            <a href="#" class="btn btn-primary">Shop Now</a>
                        </div>
                    </div> --}}
                    <div class="carousel-item">
                        <img src="{{ asset('assets/imgs/banner3.png') }}" class="d-block w-100" alt="Banner 3">
                        <div class="carousel-overlay">
                            <div class="text-center">
                                <a href="#product" onclick="smoothScrollTo('product')" class="shop-now-btn">
                                    Shop Now
                                    <span class="btn-arrow">→</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/imgs/banner4.png') }}" class="d-block w-100" alt="Banner 4">
                        <div class="carousel-overlay">
                            <div class="text-center">
                                <a href="#product" onclick="smoothScrollTo('product')" class="shop-now-btn">
                                    Shop Now
                                    <span class="btn-arrow">→</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/imgs/banner2.png') }}" class="d-block w-100" alt="Banner 4">
                        <div class="carousel-overlay">
                            <div class="text-center">
                                <a href="#product" onclick="smoothScrollTo('product')" class="shop-now-btn">
                                    Shop Now
                                    <span class="btn-arrow">→</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>






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



        @php
            use App\Models\Product;
            $products = Product::with('category')->where('status', 'active')->latest()->limit(8)->get();
        @endphp

        <div class="cart-section" id="product">
            <div class="container d-flex flex-column">
                <h2 class="goal-title" style="padding-top: 2rem; padding-bottom: 2rem; text-align: center;;">Perfect Gift
                    for Honey Lovers</h2>
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-3">
                            <div class="item">
                                <div class="loved-card-wrapper">
                                    <a href="{{ route('product.detail', $product->id) }}">

                                        <div class="loved-card position-relative">
                                            <img src="{{ $product->image ? Storage::url($product->image) : asset('assets/imgs/default-product.jpg') }}"
                                                alt="{{ $product->name }}" class="img-fluid w-100">
                                            <div class="loved-overlay">
                                                <!-- Add to Cart Button -->
                                                <button type="button" class="loved-icon btn btn-primary"
                                                    onclick="event.preventDefault(); event.stopPropagation(); testAddToCart({{ $product->id }})"
                                                    data-product-id="{{ $product->id }}"
                                                    data-product-name="{{ $product->name }}"
                                                    data-product-price="{{ $product->price }}">
                                                    <i class="fas fa-shopping-cart"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <h6 class="mt-3 mb-1">{{ strtoupper($product->category->name ?? 'PRODUCT') }}</h6>
                                        <p class="text-muted mb-0">{{ $product->name }}</p>
                                        <small class="text-muted">From £
                                            {{ number_format($product->price, 2) }}</small>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
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



        {{-- <section class="quiz-section">
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
        </section> --}}



        {{-- 
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
                                                    <small class="text-muted">From £

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
        </div> --}}


        {{-- <section class="py-5 most-loved">
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
                            <p class="text-muted"><em>£
 729.00</em></p>
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
                            <p class="text-muted"><em>£
 397.00</em></p>
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
                            <p class="text-muted"><em>£
 355.00</em></p>
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
                            <p class="text-muted"><em>£
 379.00</em></p>
                        </div>

                    </div>
                </div>
            </div>
        </section> --}}





        <section class="customer-reviews-section py-10">
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
                                                    <img src="{{ asset('assets/imgs/balm.png') }}"
                                                        alt="Royal Jelly Honey" class="product-img">
                                                </div>
                                                <div class="product-details">
                                                    <h5 class="product-title">Nourishing Beef Tallow Cream for Sensitive
                                                        Skin</h5>
                                                    <p class="review-text">This natural beef tallow balm is deeply
                                                        hydrating and soothing, offering gentle care for dry, damaged, and
                                                        sensitive skin. With its rich, creamy texture, it restores
                                                        smoothness and provides long-lasting protection...</p>
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
                                                    <img src="{{ asset('assets/imgs/honey.jpeg') }}" alt="White Honey"
                                                        class="product-img">
                                                </div>
                                                <div class="product-details">
                                                    <h5 class="product-title">Royal Yemeni Sidr Honey – Naturally Powerful
                                                    </h5>
                                                    <p class="review-text">Harvested from the ancient Sidr trees of Yemen,
                                                        this raw honey is rich, smooth, and full of natural goodness. Its
                                                        deep flavor and healing properties make it truly exceptional...</p>
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
                                                    <img src="{{ asset('assets/imgs/shaljeet.jpeg') }}" alt="Raw Honey"
                                                        class="product-img">
                                                    <div class="award-badge">
                                                        <span>Great Taste</span>
                                                    </div>
                                                </div>
                                                <div class="product-details">
                                                    <h5 class="product-title">Premium Himalayan Shilajit – Pure Mineral
                                                        Strength</h5>
                                                    <p class="review-text">Sourced from the pristine Himalayan mountains,
                                                        this gold-grade Shilajit delivers natural energy and mineral-rich
                                                        support. Perfect for boosting vitality, focus, and overall
                                                        wellness...</p>
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
                                                    <img src="{{ asset('assets/imgs/seamoss.jpeg') }}"
                                                        alt="Black Seed Honey" class="product-img">
                                                </div>
                                                <div class="product-details">
                                                    <h5 class="product-title">Supreme Seamoss Blend – Daily Natural Boost
                                                    </h5>
                                                    <p class="review-text">Packed with essential minerals and nutrients,
                                                        this seamoss blend supports energy, immunity, and overall wellness.
                                                        A smooth, natural boost for everyday vitality...</p>
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
                                                    <img src="{{ asset('assets/imgs/honey.jpeg') }}" alt="Saffron Honey"
                                                        class="product-img">
                                                </div>
                                                <div class="product-details">
                                                    <h5 class="product-title">Royal Yemeni Sidr Honey – Pure & Authentic
                                                    </h5>
                                                    <p class="review-text">Collected from the sacred Sidr trees of Yemen,
                                                        this honey offers a bold sweetness with natural healing benefits. A
                                                        golden treasure loved for its purity and strength...</p>
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
                                                    <img src="{{ asset('assets/imgs/balm.png') }}" alt="Manuka Honey"
                                                        class="product-img">
                                                </div>
                                                <div class="product-details">
                                                    <h5 class="product-title">Beef Tallow Balm – Gentle Care for Skin</h5>
                                                    <p class="review-text">Crafted with pure beef tallow, this balm deeply
                                                        nourishes and restores dry or irritated skin. A soothing, natural
                                                        remedy for lasting softness and protection...</p>
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

                    {{-- <!-- Carousel Indicators -->
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#reviewsCarousel" data-bs-slide-to="0"
                            class="active"></button>
                        <button type="button" data-bs-target="#reviewsCarousel" data-bs-slide-to="1"></button>
                    </div> --}}
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
                    <!-- Blog 1 -->
                    <a href="{{ route('honey.blog') }}" style="color: black; font-weight: 600;">
                        <div class="item">
                            <div class="card blog-card">
                                <img src="{{ asset('assets/imgs/honey-2.webp') }}" class="card-img-top" alt="Blog 1">
                                <div class="card-body">
                                    <h6 class="fw-semibold">8 Honey Beauty Recipes That Enhance Skin</h6>
                                    <p class="text-muted small mb-1">on August 4, 2025</p>
                                    <p class="text-muted small">
                                        Simple DIY honey recipes to keep your skin glowing, soft, and naturally nourished...
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Blog 2 -->
                    <a href="{{ route('blog.detail') }}" style="color: black; font-weight: 600;">
                        <div class="item">
                            <div class="card blog-card">
                                <img src="{{ asset('assets/imgs/banner5.png') }}" class="card-img-top" alt="Blog 2">
                                <div class="card-body">
                                    <h6 class="fw-semibold">5 Amazing Benefits of Beef Tallow Balm for Skin</h6>
                                    <p class="text-muted small mb-1">on August 12, 2025</p>
                                    <p class="text-muted small">
                                        Discover how this natural balm restores softness, heals dryness, and protects your
                                        skin naturally...
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Blog 3 -->
                    <a href="{{ route('shalajeet.blog') }}" style="color: black; font-weight: 600;">
                        <div class="item">
                            <div class="card blog-card">
                                <img src="{{ asset('assets/imgs/shaljeet.png') }}" class="card-img-top" alt="Blog 3">
                                <div class="card-body">
                                    <h6 class="fw-semibold">7 Powerful Benefits of Himalayan Shilajit</h6>
                                    <p class="text-muted small mb-1">on August 18, 2025</p>
                                    <p class="text-muted small">
                                        A natural source of energy, focus, and vitality — learn why Shilajit is called the
                                        “mountain’s gift”...
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>

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
