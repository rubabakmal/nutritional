@extends('website-layout.app')

@section('content')
    <!-- Add CSRF token meta tag -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Red Hat Display", sans-serif;
            background-color: #fff;
            color: #333;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #35B4AD 0%, #2a9089 100%);
            padding: 80px 0;
            text-align: center;
            color: white;
        }

        .hero-title {
            font-size: 48px;
            font-weight: 300;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-family: "Red Hat Display", sans-serif;
        }

        /* Main Cart Container */
        .main-cart-container {
            max-width: 1200px;
            margin: 60px auto;
            padding: 0 20px;
        }

        /* Main Cart Table */
        .main-cart-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 40px;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .main-cart-table thead {
            background-color: #f8f9fa;
        }

        .main-cart-table th {
            padding: 20px;
            text-align: left;
            font-weight: 600;
            color: #333;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .main-cart-table td {
            padding: 30px 20px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }

        .main-product-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .main-product-image {
            width: 80px;
            height: 80px;
            background: #f5f5f5;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .main-product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .main-product-details h3 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 5px;
            color: #333;
        }

        .main-product-size {
            font-size: 14px;
            color: #666;
        }

        .main-price {
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }

        .main-quantity-controls {
            display: flex;
            align-items: center;
            gap: 0;
            border: 1px solid #ddd;
            border-radius: 6px;
            overflow: hidden;
            max-width: 120px;
        }

        .main-quantity-btn {
            background: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 16px;
            color: #666;
            transition: background-color 0.3s;
        }

        .main-quantity-btn:hover {
            background-color: #f5f5f5;
        }

        .main-quantity-input {
            border: none;
            width: 50px;
            text-align: center;
            padding: 8px 5px;
            font-size: 14px;
            background: white;
        }

        .main-total-price {
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }

        .main-remove-btn {
            background: #e74c3c;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 12px;
            padding: 8px 12px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .main-remove-btn:hover {
            background-color: #c0392b;
        }

        /* Main Cart Footer */
        .main-cart-footer {
            display: flex;
            justify-content: space-between;
            gap: 40px;
        }

        .main-order-note {
            flex: 1;
        }

        .main-order-note h3 {
            font-size: 16px;
            margin-bottom: 15px;
            color: #333;
        }

        .main-note-textarea {
            width: 100%;
            min-height: 120px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            resize: vertical;
            font-size: 14px;
            font-family: inherit;
        }

        .main-note-textarea::placeholder {
            color: #999;
        }

        .main-cart-summary {
            min-width: 300px;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            height: fit-content;
        }

        .main-summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .main-summary-row.subtotal {
            font-size: 18px;
            font-weight: 600;
            padding-top: 15px;
            border-top: 1px solid #eee;
            margin-top: 20px;
        }

        .main-shipping-note {
            font-size: 13px;
            color: #666;
            margin: 15px 0;
            text-align: center;
        }

        .main-checkout-btn {
            width: 100%;
            background-color: #35B4AD;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: background-color 0.3s;
            text-decoration: none;
            display: block;
            text-align: center;
        }

        .main-checkout-btn:hover {
            background-color: #2a9089;
        }

        .main-empty-cart {
            text-align: center;
            padding: 100px 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .main-empty-cart i {
            font-size: 64px;
            color: #ddd;
            margin-bottom: 20px;
        }

        .main-empty-cart h3 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }

        .main-empty-cart p {
            color: #666;
            margin-bottom: 30px;
        }

        .main-shop-now-btn {
            display: inline-block;
            background-color: #35B4AD;
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: background-color 0.3s;
        }

        .main-shop-now-btn:hover {
            background-color: #2a9089;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 32px;
            }

            .main-cart-table {
                font-size: 14px;
            }

            .main-cart-table th,
            .main-cart-table td {
                padding: 15px 10px;
            }

            .main-product-info {
                flex-direction: column;
                text-align: center;
            }

            .main-cart-footer {
                flex-direction: column;
                gap: 30px;
            }

            .main-cart-summary {
                min-width: auto;
            }
        }

        @media (max-width: 480px) {
            .main-cart-table,
            .main-cart-table thead,
            .main-cart-table tbody,
            .main-cart-table th,
            .main-cart-table td,
            .main-cart-table tr {
                display: block;
            }

            .main-cart-table thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            .main-cart-table tr {
                border: 1px solid #ccc;
                margin-bottom: 10px;
                padding: 15px;
                border-radius: 8px;
            }

            .main-cart-table td {
                border: none;
                position: relative;
                padding: 10px 0;
            }

            .main-cart-table td:before {
                content: attr(data-label) ": ";
                font-weight: bold;
                color: #666;
            }
        }
    </style>

    <!-- Hero Section -->
    <section class="hero-section">
        <h1 class="hero-title">Shopping Cart</h1>
    </section>

    <!-- Main Cart Container -->
    <div class="main-cart-container">
        @if($formattedItems->count() > 0)
            <table class="main-cart-table">
                <thead>
                    <tr>
                        <th>PRODUCT</th>
                        <th>PRICE</th>
                        <th>QUANTITY</th>
                        <th>TOTAL</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody id="mainCartTableBody">
                    @foreach($formattedItems as $item)
                        <tr data-product-id="{{ $item['id'] }}">
                            <td data-label="Product">
                                <div class="main-product-info">
                                    <div class="main-product-image">
                                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"
                                             onerror="this.src='{{ asset('assets/imgs/default-product.jpg') }}'">
                                    </div>
                                    <div class="main-product-details">
                                        <h3>{{ $item['name'] }}</h3>
                                        <p class="main-product-size">Size: {{ $item['size'] ?? '400g' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td data-label="Price">
                                <div class="main-price">AED {{ number_format($item['price'], 2) }}</div>
                            </td>
                            <td data-label="Quantity">
                                <div class="main-quantity-controls">
                                    <button type="button" class="main-quantity-btn decrease-btn" data-id="{{ $item['id'] }}">−</button>
                                    <input type="number" class="main-quantity-input" value="{{ $item['quantity'] }}"
                                           data-id="{{ $item['id'] }}" min="1" max="10">
                                    <button type="button" class="main-quantity-btn increase-btn" data-id="{{ $item['id'] }}">+</button>
                                </div>
                            </td>
                            <td data-label="Total">
                                <div class="main-total-price" data-price="{{ $item['price'] }}">AED {{ number_format($item['total'], 2) }}</div>
                            </td>
                            <td data-label="Action">
                                <button type="button" class="main-remove-btn" data-id="{{ $item['id'] }}">Remove</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="main-cart-footer">
                <div class="main-order-note">
                    <h3>Add Order Note</h3>
                    <textarea class="main-note-textarea" placeholder="How can we help you?"></textarea>
                </div>

                <div class="main-cart-summary">
                    <div class="main-summary-row">
                        <span>Subtotal ({{ $cartCount }} item{{ $cartCount != 1 ? 's' : '' }}):</span>
                        <span id="subtotal-amount">AED {{ number_format($cartTotal, 2) }}</span>
                    </div>
                    <div class="main-summary-row">
                        <span>Shipping:</span>
                        <span id="shipping-amount">{{ $shipping == 0 ? 'FREE' : 'AED ' . number_format($shipping, 2) }}</span>
                    </div>
                    <div class="main-summary-row subtotal">
                        <span>TOTAL:</span>
                        <span id="final-total">AED {{ number_format($finalTotal, 2) }}</span>
                    </div>
                    <p class="main-shipping-note" id="shipping-note">
                        @if($shipping > 0)
                            Add AED {{ number_format(500 - $cartTotal, 2) }} more for free shipping!
                        @else
                            You qualify for FREE shipping!
                        @endif
                    </p>
                    <div class="text-center">
                        <a href="{{ route('checkout') }}" class="main-checkout-btn">
                            Checkout
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="main-empty-cart">
                <i class="fas fa-shopping-cart"></i>
                <h3>Your cart is empty</h3>
                <p>Start shopping to add items to your cart</p>
                <a href="{{ url('/') }}" class="main-shop-now-btn">
                    Continue Shopping
                </a>
            </div>
        @endif
    </div>

    <script>
        console.log('Main cart script loading...');

        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, setting up main cart functionality');

            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            console.log('CSRF token found:', token ? 'Yes' : 'No');

            // Update selectors to use main- prefixed classes
            document.querySelectorAll('.increase-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');
                    const input = document.querySelector(`.main-quantity-input[data-id="${productId}"]`);
                    const newQty = parseInt(input.value) + 1;
                    console.log('Increasing quantity for product', productId, 'to', newQty);
                    updateCartQuantity(productId, newQty);
                });
            });

            document.querySelectorAll('.decrease-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');
                    const input = document.querySelector(`.main-quantity-input[data-id="${productId}"]`);
                    const newQty = parseInt(input.value) - 1;
                    console.log('Decreasing quantity for product', productId, 'to', newQty);

                    if (newQty < 1) {
                        removeFromCart(productId);
                    } else {
                        updateCartQuantity(productId, newQty);
                    }
                });
            });

            document.querySelectorAll('.main-remove-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');
                    console.log('Removing product', productId);
                    if (confirm('Remove this item from your cart?')) {
                        removeFromCart(productId);
                    }
                });
            });

            document.querySelectorAll('.main-quantity-input').forEach(function(input) {
                input.addEventListener('change', function() {
                    const productId = this.getAttribute('data-id');
                    const newQty = parseInt(this.value);
                    console.log('Quantity input changed for product', productId, 'to', newQty);

                    if (newQty < 1) {
                        removeFromCart(productId);
                    } else {
                        updateCartQuantity(productId, newQty);
                    }
                });
            });

            function updateCartQuantity(productId, quantity) {
                console.log('Updating cart quantity:', productId, quantity);

                fetch('{{ route('cart.update') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: quantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Update response:', data);
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Error updating cart: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error updating cart');
                });
            }

            function removeFromCart(productId) {
                console.log('Removing from cart:', productId);

                fetch('{{ route('cart.remove') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                    },
                    body: JSON.stringify({
                        product_id: productId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Remove response:', data);
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Error removing item: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error removing item');
                });
            }

            console.log('Main cart functionality setup complete');
        });
    </script>
@endsection
