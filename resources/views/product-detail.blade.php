@extends('website-layout.app')

<style>
    .product-detail-wrap {
        margin-top: 20px;
    }

    .product-detail-content {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap; /* Ensures the content wraps on smaller screens */
    }

    .carousel-container {
        width: 50%;
    }

    .product-info {
        width: 45%;
        padding: 20px;
    }

    .product-info h2 {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .product-info .price {
        font-size: 22px;
        font-weight: lighter;
        color: #333;
        margin: 10px 0;
        font-family: "Red Hat Display", sans-serif;
        font-style: italic;
    }

    .product-info .description {
        font-size: 16px;
        color: #666;
        margin-bottom: 15px;
        font-family: "Red Hat Display", sans-serif;
    }

    .quantity-select {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .quantity-select label {
        font-size: 16px;
        font-weight: bold;
        margin-right: 10px;
    }

    .quantity-select select {
        padding: 10px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        background-color: #50BDB7;
        color: white;
        cursor: pointer;
        width: 80px;
        transition: background-color 0.3s ease;
    }

    .quantity-select select:hover {
        background-color: #50BDB7;
    }

    .add-to-cart-btn {
        color: white;
        padding: 12px 25px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        transition: background-color 0.3s;
    }

    .add-to-cart-btn:hover {
        background-color: #f88c47;
    }

    .thumbs {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
    }

    .thumbs img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        cursor: pointer;
        transition: opacity 0.3s ease;
        opacity: 0.6;
    }

    .thumbs img.active {
        opacity: 1;
        border: 2px solid #000;
    }

    /* 5-Star Rating */
    .rating {
        display: flex;
        align-items: center;
        margin-top: 10px;
    }

    .rating span {
        color: black;
        font-size: 18px;
        margin-right: 5px;
    }

    .rating i {
        color: gold;
        margin-right: 2px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .carousel-container,
        .product-info {
            width: 100%;
        }

        .product-info {
            margin-top: 20px;
        }

        .product-info .price {
            font-size: 20px;
        }

        .quantity-select {
            margin-top: 10px;
        }

        .add-to-cart-btn {
            width: 100%;
        }
    }
</style>

@section('content')
    <div class="product-detail-wrap">
        <div class="container">
            <div class="product-detail-content">
                <!-- Left Side: Image Carousel -->
                <div class="carousel-container">
                    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('assets/imgs/balkees-card.jpg') }}" class="d-block w-100" alt="Product 1">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('assets/imgs/cart-img3.jpg') }}" class="d-block w-100" alt="Product 2">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('assets/imgs/balkees-card.jpg') }}" class="d-block w-100" alt="Product 3">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                    <!-- Thumbnails Below -->
                    <div class="thumbs">
                        <img src="{{ asset('assets/imgs/balkees-card.jpg') }}" alt="Thumbnail 1" data-bs-target="#productCarousel" data-bs-slide-to="0">
                        <img src="{{ asset('assets/imgs/cart-img3.jpg') }}" alt="Thumbnail 2" data-bs-target="#productCarousel" data-bs-slide-to="1">
                        <img src="{{ asset('assets/imgs/balkees-card.jpg') }}" alt="Thumbnail 3" data-bs-target="#productCarousel" data-bs-slide-to="2">
                    </div>
                </div>

                <!-- Right Side: Product Info -->
                <div class="product-info">
                    <h2>Black Seed Fusion</h2>
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="price">AED 304.00</div>
                    <div class="description">
                        Black Seed is a traditional herb used for centuries in the Middle East and Asia to promote health and general well-being. Combined with the natural enzymes in our raw, unpasteurized honey makes a potent combination full of immune-boosting properties.
                        <br><br>
                        Ingredients: 100% Raw Sidr Do'ani & Black Seed
                        <br><br>
                        Storage: Store at room temperature. If crystallization occurs, place jar in warm water.
                        <br><br>
                        Packaging: All Balqees honey is packaged in recyclable glass jars.
                        <br><br>
                        Country of origin: Yemen.
                        <br><br>
                        Raw Honey is a natural product, therefore the color and texture may vary depending on the season and level of crystallization.
                    </div>

                    <div class="quantity-select">
                        <label for="quantity">Quantity:</label>
                        <select id="quantity" name="quantity">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>

                    <div class="text-center">
                        <a href="#" class="shop-now-btn quize-btn add-to-cart-btn">
                            Add to Cart
                            <span class="btn-arrow">→</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
