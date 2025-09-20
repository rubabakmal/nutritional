@extends('website-layout.app')

@php
    use Illuminate\Support\Str;

    // Prepare 200-word excerpt + remainder from the product description
    $descRaw = $product->description ?? '';
    $descPlain = trim(preg_replace('/\s+/', ' ', strip_tags($descRaw))); // keep counting clean
    $words = $descPlain !== '' ? preg_split('/\s+/', $descPlain) : [];
    $excerpt = $words ? implode(' ', array_slice($words, 0, 100)) : '';
    $remainder = $words && count($words) > 100 ? implode(' ', array_slice($words, 100)) : '';
@endphp

<style>
    .product-detail-wrap {
        margin-top: 130px;
    }

    .product-detail-content {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
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
        width: 73%;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background-color: #35b4ad;
        color: white;
        text-decoration: none;
        font-size: 1.1rem;
        font-weight: 600;
        padding: 15px 35px 15px 20px;
        border-radius: 30px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px #35b4ae82;
        text-transform: capitalize;
        letter-spacing: 0.5px;

        /* border aur outline reset */
        border: none;
        outline: none;

        appearance: none;
        -moz-appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml;utf8,<svg fill='white' height='20' viewBox='0 0 24 24' width='20' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>");
        background-repeat: no-repeat;
        background-position: right 15px center;
        background-size: 18px;
    }


    .quantity-select select:hover {
        background-color: #50BDB7;
    }

    .quantity-select select:focus {
        outline: none;
        border: none;
        box-shadow: 0 4px 15px #35b4ae82;
        /* apna shadow rakho */
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

    .category-tag {
        background-color: #f8f4ef;
        color: #333;
        padding: 5px 15px;
        border-radius: 15px;
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 10px;
        display: inline-block;
        text-transform: uppercase;
    }

    .stock-info {
        margin: 10px 0;
        padding: 8px 12px;
        border-radius: 5px;
        font-size: 14px;
        font-weight: bold;
    }

    .in-stock {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .low-stock {
        background-color: #fff3cd;
        color: #856404;
        border: 1px solid #ffeaa7;
    }

    .out-of-stock {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    /* New: long description block below the carousel row */
    .product-long-desc {
        margin-top: 26px;
    }

    .product-long-desc .long-desc {
        font-size: 16px;
        line-height: 1.8;
        color: #333;
        font-family: "Red Hat Display", sans-serif;
        white-space: pre-wrap;
        /* keep paragraphs if present */
    }

    .product-long-desc h3 {
        font-weight: 800;
        font-size: 20px;
        margin-bottom: 8px;
    }

    /* Responsive */
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

    .btn-group-wrapper {
        display: flex;
        gap: 10px;
    }

    .add-to-cart-btn {
        flex: 1;
        padding: 12px 25px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    /* Mobile screen adjustment */
    @media (max-width: 554px) {
        .btn-group-wrapper {
            flex-direction: column;
            /* side by side se stack ho jayega */
        }
    }

    .quize-btn {

        margin-bottom: 1rem !important;
    }

    .quantity-select select {

        width: 73%;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background-color: #35b4ad;
        color: white;
        text-decoration: none;
        font-size: 1.1rem;
        font-weight: 600;
        padding: 15px 35px;
        border-radius: 30px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px #35b4ae82;
        text-transform: capitalize;
        letter-spacing: 0.5px;
    }

    .carousel-container img {
        max-height: 500px;
        object-fit: contain;
        width: auto;
        display: block;
    }

    @media (max-width:554px) {
        .product-detail-wrap {
            margin-top: 80px;
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
                            @if ($product->image)
                                <div class="carousel-item active">
                                    <img src="{{ Storage::url($product->image) }}" class="d-block w-100"
                                        alt="{{ $product->name }}">
                                </div>
                            @endif

                            @if ($product->gallery && is_array($product->gallery))
                                @foreach ($product->gallery as $index => $galleryImage)
                                    <div class="carousel-item {{ !$product->image && $index == 0 ? 'active' : '' }}">
                                        <img src="{{ Storage::url($galleryImage) }}" class="d-block w-100"
                                            alt="{{ $product->name }} - Gallery {{ $index + 1 }}">
                                    </div>
                                @endforeach
                            @endif

                            @if (!$product->image && (!$product->gallery || empty($product->gallery)))
                                <div class="carousel-item active">
                                    <img src="{{ asset('assets/imgs/default-product.jpg') }}" class="d-block w-100"
                                        alt="{{ $product->name }}">
                                </div>
                            @endif
                        </div>

                        @if (($product->image ? 1 : 0) + ($product->gallery ? count($product->gallery) : 0) > 1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        @endif
                    </div>

                    @if (($product->image ? 1 : 0) + ($product->gallery ? count($product->gallery) : 0) > 1)
                        <div class="thumbs">
                            @if ($product->image)
                                <img src="{{ Storage::url($product->image) }}" alt="Main Image"
                                    data-bs-target="#productCarousel" data-bs-slide-to="0" class="active">
                            @endif
                            @if ($product->gallery && is_array($product->gallery))
                                @foreach ($product->gallery as $index => $galleryImage)
                                    <img src="{{ Storage::url($galleryImage) }}" alt="Gallery {{ $index + 1 }}"
                                        data-bs-target="#productCarousel"
                                        data-bs-slide-to="{{ $product->image ? $index + 1 : $index }}">
                                @endforeach
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Right Side: Product Info -->
                <div class="product-info">
                    @if ($product->category)
                        <span class="category-tag">{{ $product->category->name }}</span>
                    @endif

                    <h2>{{ $product->name }}</h2>

                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                            class="fas fa-star"></i><i class="fas fa-star"></i>
                        <span>({{ rand(50, 200) }} reviews)</span>
                    </div>

                    <div class="price">£ {{ number_format($product->price, 2) }}</div>

                    @if ($product->quantity > 10)
                        <div class="stock-info in-stock">✅ In Stock ({{ $product->quantity }} available)</div>
                    @elseif($product->quantity > 0)
                        <div class="stock-info low-stock">⚠️ Only {{ $product->quantity }} left in stock</div>
                    @else
                        <div class="stock-info out-of-stock">❌ Out of Stock</div>
                    @endif

                    <!-- SHORT description (first 200 words only) -->
                    <div class="description">
                        {{ $excerpt !== '' ? $excerpt : 'This premium product is carefully sourced and processed to maintain its natural qualities and benefits.' }}
                        <br><br>
                        <strong>SKU:</strong> {{ $product->sku }}
                        <br><br>
                        <strong>Status:</strong> {{ ucfirst($product->status) }}
                        @if ($product->is_featured)
                            <br><strong>Featured Product</strong> ⭐
                        @endif
                    </div>

                    <div class="quantity-select">
                        <label for="quantity">Quantity:</label>
                        <select id="quantity" name="quantity">
                            @for ($i = 1; $i <= min(10, $product->quantity); $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="text-center btn-group-wrapper">
                        @if ($product->quantity > 0)
                            <!-- Add to Cart Button -->
                            <button class="shop-now-btn quize-btn add-to-cart-btn"
                                onclick="addToCartFromDetail({{ $product->id }})" id="addToCartBtn">
                                Add to Cart <span class="btn-arrow">→</span>
                            </button>

                            <!-- Buy Now Button -->
                            <button class="shop-now-btn quize-btn add-to-cart-btn" onclick="buyNow({{ $product->id }})"
                                id="buyNowBtn" style="background-color:#50BDB7; color: white;">
                                Buy Now <span class="btn-arrow">→</span>
                            </button>
                        @else
                            <button class="shop-now-btn add-to-cart-btn w-100" disabled
                                style="background-color: #ccc; cursor: not-allowed;">
                                Out of Stock
                            </button>
                        @endif
                    </div>


                </div>
            </div>

            <!-- LONG description (everything after first 200 words) BELOW the image/carousel -->
            @if ($remainder !== '')
                <div class="product-long-desc">
                    <div class="long-desc">
                        <h3>More about {{ $product->name }}</h3>
                        <p>{{ $remainder }}</p>
                    </div>
                </div>
            @endif

        </div>
    </div>

    <script>
        // Add to cart from product detail page
        function addToCartFromDetail(productId) {
            const quantity = document.getElementById('quantity').value;
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            const addToCartBtn = document.getElementById('addToCartBtn');

            if (!csrfToken) {
                alert('CSRF Token missing!');
                return;
            }

            const originalContent = addToCartBtn.innerHTML;
            addToCartBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';
            addToCartBtn.disabled = true;

            fetch('/cart/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: parseInt(quantity)
                    })
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        addToCartBtn.innerHTML = '✅ Added to Cart!';
                        addToCartBtn.style.backgroundColor = '#28a745';
                        const badge = document.getElementById('cartBadge');
                        if (badge) badge.textContent = data.cart_count;
                        showNotification('Product added to cart successfully!', 'success');
                        setTimeout(() => {
                            addToCartBtn.innerHTML = originalContent;
                            addToCartBtn.style.backgroundColor = '';
                            addToCartBtn.disabled = false;
                        }, 2000);
                    } else {
                        addToCartBtn.innerHTML = originalContent;
                        addToCartBtn.disabled = false;
                        showNotification(data.message || 'Error adding to cart', 'error');
                    }
                })
                .catch(() => {
                    addToCartBtn.innerHTML = originalContent;
                    addToCartBtn.disabled = false;
                    showNotification('Network error occurred', 'error');
                });
        }

        function showNotification(message, type = 'success') {
            const n = document.createElement('div');
            n.style.cssText = `
                position: fixed; top: 20px; right: 20px; z-index: 10000; padding: 15px 20px;
                border-radius: 5px; color: white; font-weight: bold;
                background-color: ${type === 'success' ? '#28a745' : '#dc3545'};
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            `;
            n.textContent = message;
            document.body.appendChild(n);
            setTimeout(() => {
                if (document.body.contains(n)) document.body.removeChild(n);
            }, 3000);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const thumbnails = document.querySelectorAll('.thumbs img');
            thumbnails.forEach((thumb) => {
                thumb.addEventListener('click', function() {
                    thumbnails.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>

    <script>
        // Buy Now function
        function buyNow(productId) {
            const quantity = document.getElementById('quantity').value;
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            const buyNowBtn = document.getElementById('buyNowBtn');

            if (!csrfToken) {
                alert('CSRF Token missing!');
                return;
            }

            // Loading state
            const originalContent = buyNowBtn.innerHTML;
            buyNowBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
            buyNowBtn.disabled = true;

            fetch('/cart/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: parseInt(quantity)
                    })
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        // Redirect to checkout directly
                        window.location.href = '/checkout';
                    } else {
                        buyNowBtn.innerHTML = originalContent;
                        buyNowBtn.disabled = false;
                        showNotification(data.message || 'Error in Buy Now', 'error');
                    }
                })
                .catch(() => {
                    buyNowBtn.innerHTML = originalContent;
                    buyNowBtn.disabled = false;
                    showNotification('Network error occurred', 'error');
                });
        }
    </script>
@endsection
