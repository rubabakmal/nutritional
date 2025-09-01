@extends('website-layout.app')

<style>
    .product-detail-wrap {
        margin-top: 20px;
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
                            @if ($product->image)
                                <!-- Main Product Image -->
                                <div class="carousel-item active">
                                    <img src="{{ Storage::url($product->image) }}" class="d-block w-100"
                                        alt="{{ $product->name }}">
                                </div>
                            @endif

                            @if ($product->gallery && is_array($product->gallery))
                                <!-- Gallery Images -->
                                @foreach ($product->gallery as $index => $galleryImage)
                                    <div class="carousel-item {{ !$product->image && $index == 0 ? 'active' : '' }}">
                                        <img src="{{ Storage::url($galleryImage) }}" class="d-block w-100"
                                            alt="{{ $product->name }} - Gallery {{ $index + 1 }}">
                                    </div>
                                @endforeach
                            @endif

                            @if (!$product->image && (!$product->gallery || empty($product->gallery)))
                                <!-- Fallback Image -->
                                <div class="carousel-item active">
                                    <img src="{{ asset('assets/imgs/default-product.jpg') }}" class="d-block w-100"
                                        alt="{{ $product->name }}">
                                </div>
                            @endif
                        </div>

                        @if (($product->image ? 1 : 0) + ($product->gallery ? count($product->gallery) : 0) > 1)
                            <!-- Carousel Controls (only show if more than 1 image) -->
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

                    <!-- Thumbnails Below -->
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
                    <!-- Category Tag -->
                    @if ($product->category)
                        <span class="category-tag">{{ $product->category->name }}</span>
                    @endif

                    <!-- Product Name -->
                    <h2>{{ $product->name }}</h2>

                    <!-- Rating (Static for now) -->
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <span>({{ rand(50, 200) }} reviews)</span>
                    </div>

                    <!-- Price -->
                    <div class="price">AED {{ number_format($product->price, 2) }}</div>

                    <!-- Stock Information -->
                    @if ($product->quantity > 10)
                        <div class="stock-info in-stock">✅ In Stock ({{ $product->quantity }} available)</div>
                    @elseif($product->quantity > 0)
                        <div class="stock-info low-stock">⚠️ Only {{ $product->quantity }} left in stock</div>
                    @else
                        <div class="stock-info out-of-stock">❌ Out of Stock</div>
                    @endif

                    <!-- Description -->
                    <div class="description">
                        {{ $product->description ?? 'This premium honey product is carefully sourced and processed to maintain its natural qualities and health benefits. Perfect for daily consumption or as a thoughtful gift.' }}
                        <br><br>
                        <strong>SKU:</strong> {{ $product->sku }}
                        <br><br>
                        <strong>Status:</strong> {{ ucfirst($product->status) }}
                        @if ($product->is_featured)
                            <br><strong>Featured Product</strong> ⭐
                        @endif
                    </div>

                    <!-- Quantity Selection -->
                    <div class="quantity-select">
                        <label for="quantity">Quantity:</label>
                        <select id="quantity" name="quantity">
                            @for ($i = 1; $i <= min(10, $product->quantity); $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <!-- Add to Cart Button -->
                    <div class="text-center">
                        @if ($product->quantity > 0)
                            <button class="shop-now-btn quize-btn add-to-cart-btn"
                                onclick="addToCartFromDetail({{ $product->id }})" id="addToCartBtn">
                                Add to Cart
                                <span class="btn-arrow">→</span>
                            </button>
                        @else
                            <button class="shop-now-btn add-to-cart-btn" disabled
                                style="background-color: #ccc; cursor: not-allowed;">
                                Out of Stock
                            </button>
                        @endif
                    </div>
                </div>
            </div>
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

            // Show loading state
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
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Success feedback
                        addToCartBtn.innerHTML = '✅ Added to Cart!';
                        addToCartBtn.style.backgroundColor = '#28a745';

                        // Update cart badge if exists
                        const badge = document.getElementById('cartBadge');
                        if (badge) {
                            badge.textContent = data.cart_count;
                        }

                        // Show success message
                        showNotification('Product added to cart successfully!', 'success');

                        // Reset button after 2 seconds
                        setTimeout(() => {
                            addToCartBtn.innerHTML = originalContent;
                            addToCartBtn.style.backgroundColor = '';
                            addToCartBtn.disabled = false;
                        }, 2000);
                    } else {
                        // Error feedback
                        addToCartBtn.innerHTML = originalContent;
                        addToCartBtn.disabled = false;
                        showNotification(data.message || 'Error adding to cart', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    addToCartBtn.innerHTML = originalContent;
                    addToCartBtn.disabled = false;
                    showNotification('Network error occurred', 'error');
                });
        }

        // Notification function
        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 10000;
                padding: 15px 20px;
                border-radius: 5px;
                color: white;
                font-weight: bold;
                background-color: ${type === 'success' ? '#28a745' : '#dc3545'};
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                animation: slideIn 0.3s ease;
            `;
            notification.textContent = message;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease';
                setTimeout(() => {
                    if (document.body.contains(notification)) {
                        document.body.removeChild(notification);
                    }
                }, 300);
            }, 3000);
        }

        // Thumbnail click functionality
        document.addEventListener('DOMContentLoaded', function() {
            const thumbnails = document.querySelectorAll('.thumbs img');
            thumbnails.forEach((thumb, index) => {
                thumb.addEventListener('click', function() {
                    // Remove active class from all thumbnails
                    thumbnails.forEach(t => t.classList.remove('active'));
                    // Add active class to clicked thumbnail
                    this.classList.add('active');
                });
            });
        });
    </script>
@endsection
