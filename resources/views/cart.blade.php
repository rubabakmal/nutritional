@extends('website-layout.app')

@section('content')
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

        /* Cart Container */
        .cart-container {
            max-width: 1200px;
            margin: 60px auto;
            padding: 0 20px;
        }

        /* Cart Table */
        .cart-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 40px;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .cart-table thead {
            background-color: #f8f9fa;
        }

        .cart-table th {
            padding: 20px;
            text-align: left;
            font-weight: 600;
            color: #333;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .cart-table td {
            padding: 30px 20px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }

        .product-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .product-image {
            width: 80px;
            height: 80px;
            background: #f5f5f5;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-details h3 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 5px;
            color: #333;
        }

        .product-size {
            font-size: 14px;
            color: #666;
        }

        .price {
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 0;
            border: 1px solid #ddd;
            border-radius: 6px;
            overflow: hidden;
            max-width: 120px;
        }

        .quantity-btn {
            background: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 16px;
            color: #666;
            transition: background-color 0.3s;
        }

        .quantity-btn:hover {
            background-color: #f5f5f5;
        }

        .quantity-input {
            border: none;
            width: 50px;
            text-align: center;
            padding: 8px 5px;
            font-size: 14px;
            background: white;
        }

        .total-price {
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }

        .remove-btn {
            background: none;
            border: none;
            color: #666;
            cursor: pointer;
            font-size: 16px;
            padding: 5px;
            margin-right: 10px;
        }

        .remove-btn:hover {
            color: #e74c3c;
        }

        /* Cart Footer */
        .cart-footer {
            display: flex;
            justify-content: space-between;
            gap: 40px;
        }

        .order-note {
            flex: 1;
        }

        .order-note h3 {
            font-size: 16px;
            margin-bottom: 15px;
            color: #333;
        }

        .note-textarea {
            width: 100%;
            min-height: 120px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            resize: vertical;
            font-size: 14px;
            font-family: inherit;
        }

        .note-textarea::placeholder {
            color: #999;
        }

        .cart-summary {
            min-width: 300px;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            height: fit-content;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .summary-row.subtotal {
            font-size: 18px;
            font-weight: 600;
            padding-top: 15px;
            border-top: 1px solid #eee;
            margin-top: 20px;
        }

        .shipping-note {
            font-size: 13px;
            color: #666;
            margin: 15px 0;
            text-align: center;
        }

        .checkout-btn {
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
        }

        .checkout-btn:hover {
            background-color: #2a9089;
        }

        /* Discount Banner */
        .discount-banner {
            position: fixed;
            bottom: 20px;
            left: 20px;
            background: linear-gradient(45deg, #35B4AD, #2a9089);
            color: white;
            padding: 12px 20px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(53, 180, 173, 0.3);
            cursor: pointer;
            transition: transform 0.3s;
        }

        .discount-banner:hover {
            transform: translateY(-2px);
        }

        .discount-banner::before {
            content: "🎁";
            margin-right: 8px;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 32px;
            }

            .cart-table {
                font-size: 14px;
            }

            .cart-table th,
            .cart-table td {
                padding: 15px 10px;
            }

            .product-info {
                flex-direction: column;
                text-align: center;
            }

            .cart-footer {
                flex-direction: column;
                gap: 30px;
            }

            .cart-summary {
                min-width: auto;
            }
        }

        @media (max-width: 480px) {

            .cart-table,
            .cart-table thead,
            .cart-table tbody,
            .cart-table th,
            .cart-table td,
            .cart-table tr {
                display: block;
            }

            .cart-table thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            .cart-table tr {
                border: 1px solid #ccc;
                margin-bottom: 10px;
                padding: 15px;
                border-radius: 8px;
            }

            .cart-table td {
                border: none;
                position: relative;
                padding: 10px 0;
            }

            .cart-table td:before {
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

    <!-- Cart Container -->
    <div class="cart-container">
        <table class="cart-table">
            <thead>
                <tr>
                    <th>PRODUCT</th>
                    <th>PRICE</th>
                    <th>QUANTITY</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody id="cartTableBody">
                <tr>
                    <td data-label="Product">
                        <div class="product-info">
                            <div class="product-image">
                                <img src="{{ asset('assets/imgs/balkees-img1.webp') }}" alt="Lemon Zest & Ginger Fusion">
                            </div>
                            <div class="product-details">
                                <h3>Lemon Zest & Ginger Fusion</h3>
                                <p class="product-size">Size: 400g</p>
                            </div>
                        </div>
                    </td>
                    <td data-label="Price">
                        <div class="price">Dhs. 304.00</div>
                    </td>
                    <td data-label="Quantity">
                        <div class="quantity-controls">
                            <button class="quantity-btn" onclick="updateQuantity(1, 0)">−</button>
                            <input type="number" class="quantity-input" value="1"
                                onchange="updateQuantity(1, this.value)" min="1">
                            <button class="quantity-btn" onclick="updateQuantity(1, 2)">+</button>
                        </div>
                    </td>
                    <td data-label="Total">

                        <div class="total-price">Dhs. 304.00</div>
                    </td>
                </tr>
                <tr>
                    <td data-label="Product">
                        <div class="product-info">
                            <div class="product-image">
                                <img src="{{ asset('assets/imgs/balkees-img2.webp') }}" alt="Cinnamon & Sesame Seed Fusion">
                            </div>
                            <div class="product-details">
                                <h3>Cinnamon & Sesame Seed Fusion</h3>
                                <p class="product-size">Size: 400g</p>
                            </div>
                        </div>
                    </td>
                    <td data-label="Price">
                        <div class="price">Dhs. 304.00</div>
                    </td>
                    <td data-label="Quantity">
                        <div class="quantity-controls">
                            <button class="quantity-btn" onclick="updateQuantity(2, 0)">−</button>
                            <input type="number" class="quantity-input" value="1"
                                onchange="updateQuantity(2, this.value)" min="1">
                            <button class="quantity-btn" onclick="updateQuantity(2, 2)">+</button>
                        </div>
                    </td>
                    <td data-label="Total">

                        <div class="total-price">Dhs. 304.00</div>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="cart-footer">
            <div class="order-note">
                <h3>Add Order Note</h3>
                <textarea class="note-textarea" placeholder="How can we help you?"></textarea>
            </div>

            <div class="cart-summary">
                <div class="summary-row subtotal">
                    <span>SUBTOTAL:</span>
                    <span id="subtotalAmount">DHS. 608.0</span>
                </div>
                <p class="shipping-note">Taxes and shipping calculated at checkout</p>
                <div class="text-center">
                    <a href="#" class="shop-now-btn">
                        Checkout
                        <span class="btn-arrow">→</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Discount Banner -->
    <div class="discount-banner">
        Claim AED 50 Off 👑
    </div>

    <script>
        function updateQuantity(itemId, newQuantity) {
            newQuantity = parseInt(newQuantity);
            if (newQuantity < 1) {
                removeItem(itemId);
                return;
            }

            // Update the input field
            const row = document.querySelector(`input[onchange*="${itemId}"]`);
            if (row) {
                row.value = newQuantity;
                // Update total price for this row
                const totalElement = row.closest('tr').querySelector('.total-price');
                totalElement.textContent = `Dhs. ${(304.00 * newQuantity).toFixed(2)}`;
                updateSummary();
            }
        }

        function removeItem(itemId) {
            const row = document.querySelector(`button[onclick*="removeItem(${itemId})"]`).closest('tr');
            if (row) {
                row.remove();
                updateSummary();
            }
        }

        function editItem(itemId) {
            alert('Edit functionality - opens product edit modal');
        }

        function updateSummary() {
            let subtotal = 0;
            const rows = document.querySelectorAll('#cartTableBody tr');

            rows.forEach(row => {
                const quantityInput = row.querySelector('.quantity-input');
                if (quantityInput) {
                    const quantity = parseInt(quantityInput.value);
                    subtotal += (304.00 * quantity);
                }
            });

            document.getElementById('subtotalAmount').textContent = `DHS. ${subtotal.toFixed(1)}`;
        }

        // Checkout functionality
        document.querySelector('.checkout-btn').addEventListener('click', function() {
            window.location.href = '/checkout';
        });
    </script>
@endsection
