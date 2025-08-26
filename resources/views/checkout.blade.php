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
            background-color: #f8f9fa;
            color: #333;
        }

        .checkout-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 40px;
        }

        .checkout-form {
            background: white;
            border-radius: 12px;
            padding: 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .form-section {
            padding: 30px;
            border-bottom: 1px solid #e9ecef;
        }

        .form-section:last-child {
            border-bottom: none;
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .login-link {
            color: #35B4AD;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
        }

        .login-link:hover {
            text-decoration: underline;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #666;
            font-size: 14px;
        }

        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.3s;
            background: white;
        }

        .form-input:focus {
            outline: none;
            border-color: #35B4AD;
            box-shadow: 0 0 0 3px rgba(53, 180, 173, 0.1);
        }

        .form-select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            background: white url('data:image/svg+xml;charset=US-ASCII,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4 5"><path fill="%23666" d="M2 0L0 2h4zm0 5L0 3h4z"/></svg>') no-repeat right 12px center;
            background-size: 12px;
            appearance: none;
            cursor: pointer;
        }

        .form-select:focus {
            outline: none;
            border-color: #35B4AD;
            box-shadow: 0 0 0 3px rgba(53, 180, 173, 0.1);
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 15px;
        }

        .checkbox {
            width: 18px;
            height: 18px;
            accent-color: #35B4AD;
            appearance: none;
            border: 2px solid #35B4AD;
            border-radius: 3px;
            position: relative;
            cursor: pointer;
        }

        .checkbox:checked {
            background-color: #35B4AD;
        }

        .checkbox:checked::after {
            content: '✓';
            color: white;
            font-size: 12px;
            font-weight: bold;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .checkbox-label {
            font-size: 14px;
            color: #666;
            cursor: pointer;
        }

        /* Shipping Method */
        .shipping-option {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            background: #f8f9fa;
            margin-bottom: 15px;
        }

        .shipping-label {
            font-weight: 500;
            color: #333;
        }

        .shipping-price {
            font-weight: 600;
            color: #35B4AD;
            font-size: 16px;
        }

        /* Payment Section */
        .payment-methods {
            margin-bottom: 20px;
        }

        .payment-option {
            display: flex;
            align-items: center;
            padding: 15px;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .payment-option:hover {
            border-color: #35B4AD;
            background: rgba(53, 180, 173, 0.05);
        }

        .payment-option.active {
            border-color: #35B4AD;
            background: rgba(53, 180, 173, 0.1);
        }

        .payment-radio {
            margin-right: 12px;
            accent-color: #35B4AD;
        }

        .payment-label {
            flex: 1;
            font-weight: 500;
            color: #333;
        }

        .payment-icons {
            display: flex;
            gap: 8px;
        }

        .payment-icon {
            width: 32px;
            height: 20px;
            background: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: bold;
        }

        .visa {
            background: #1a1f71;
            color: white;
        }

        .mastercard {
            background: #eb001b;
            color: white;
        }

        .amex {
            background: #006fcf;
            color: white;
        }

        .tabby {
            background: #3ab67a;
            color: white;
        }

        .security-note {
            font-size: 13px;
            color: #666;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-form {
            display: none;
            margin-top: 20px;
        }

        .card-form.active {
            display: block;
        }

        .shop-now-btn {
            margin-top: 3rem;
            width: 100%;
            justify-content: center;
            font-family: "Red Hat Display", sans-serif;
        }

        .shop-now-btn:hover {
            background: linear-gradient(135deg, #2a9089 0%, #35B4AD 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(53, 180, 173, 0.3);
            text-decoration: none;
            color: white;
        }

        .btn-arrow {
            font-size: 18px;
            font-weight: bold;
            transition: transform 0.3s;
        }

        .shop-now-btn:hover .btn-arrow {
            transform: translateX(3px);
        }

        /* Order Summary */
        .order-summary {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            height: fit-content;
            position: sticky;
            top: 20px;
        }

        .summary-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
        }

        .order-item {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #f0f0f0;
        }

        .item-image {
            width: 60px;
            height: 60px;
            background: #f5f5f5;
            border-radius: 8px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 4px;
        }

        .item-variant {
            font-size: 12px;
            color: #666;
            margin-bottom: 4px;
        }

        .item-quantity {
            font-size: 12px;
            color: #666;
        }

        .item-price {
            font-weight: 600;
            color: #333;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .summary-row.total {
            font-size: 18px;
            font-weight: 600;
            padding-top: 15px;
            border-top: 1px solid #e9ecef;
            margin-top: 15px;
            color: #333;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .checkout-container {
                grid-template-columns: 1fr;
                gap: 30px;
                padding: 20px 15px;
            }

            .form-section {
                padding: 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .order-summary {
                order: -1;
                position: static;
            }

            .section-title {
                font-size: 18px;
            }
        }
    </style>

    <div class="checkout-container">
        <!-- Checkout Form -->
        <div class="checkout-form">
            <!-- Contact Section -->
            <div class="form-section">
                <h2 class="section-title">
                    Contact
                </h2>

                <div class="form-group">
                    <input type="email" class="form-input" placeholder="Email or mobile phone number" required>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="newsletter" class="checkbox" checked>
                    <label for="newsletter" class="checkbox-label">Email me with news and offers</label>
                </div>
            </div>

            <!-- Delivery Section -->
            <div class="form-section">
                <h2 class="section-title">Delivery</h2>

                <div class="form-group">
                    <label class="form-label">Country/Region</label>
                    <select class="form-select" required>
                        <option value="AE">United Arab Emirates</option>
                        <option value="SA">Saudi Arabia</option>
                        <option value="KW">Kuwait</option>
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <input type="text" class="form-input" placeholder="First name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-input" placeholder="Last name" required>
                    </div>
                </div>

                <div class="form-group">
                    <input type="text" class="form-input" placeholder="Address" required>
                </div>

                <div class="form-group">
                    <input type="text" class="form-input" placeholder="Apartment, suite, etc. (optional)">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <input type="text" class="form-input" placeholder="City" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Emirate</label>
                        <select class="form-select" required>
                            <option value="AUH">Abu Dhabi</option>
                            <option value="DXB">Dubai</option>
                            <option value="SHJ">Sharjah</option>
                            <option value="AJM">Ajman</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <input type="tel" class="form-input" placeholder="Phone" required>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="save-info" class="checkbox">
                    <label for="save-info" class="checkbox-label">Save this information for next time</label>
                </div>
            </div>

            <!-- Shipping Method -->
            <div class="form-section">
                <h2 class="section-title">Shipping method</h2>

                <div class="shipping-option">
                    <span class="shipping-label">Delivery Fee</span>
                    <span class="shipping-price">FREE</span>
                </div>
            </div>

            <!-- Payment Section -->
            <div class="form-section">
                <h2 class="section-title">Payment</h2>

                <div class="security-note">
                    <i class="fas fa-lock"></i>
                    All transactions are secure and encrypted.
                </div>

                <div class="payment-methods">
                    <div class="payment-option active" onclick="selectPayment('card')">
                        <input type="radio" name="payment" value="card" class="payment-radio" checked>
                        <span class="payment-label">Credit card</span>
                        <div class="payment-icons">
                            <div class="payment-icon visa">VISA</div>
                            <div class="payment-icon mastercard">MC</div>
                            <div class="payment-icon amex">AMEX</div>
                        </div>
                    </div>

                    <div class="payment-option" onclick="selectPayment('debit')">
                        <input type="radio" name="payment" value="debit" class="payment-radio">
                        <span class="payment-label">Pay using Debit cards/ Credit cards/ Installments</span>
                        <div class="payment-icons">
                            <div class="payment-icon visa">VISA</div>
                            <div class="payment-icon mastercard">MC</div>
                            <div class="payment-icon amex">AMEX</div>
                        </div>
                    </div>

                    <div class="payment-option" onclick="selectPayment('tabby')">
                        <input type="radio" name="payment" value="tabby" class="payment-radio">
                        <span class="payment-label">Pay later with Tabby</span>
                        <div class="payment-icons">
                            <div class="payment-icon tabby">tabby</div>
                        </div>
                    </div>

                    <div class="payment-option" onclick="selectPayment('cod')">
                        <input type="radio" name="payment" value="cod" class="payment-radio">
                        <span class="payment-label">Cash on Delivery (COD)</span>
                    </div>
                </div>

                <!-- Credit Card Form -->
                <div id="card-form" class="card-form active">
                    <div class="form-group">
                        <input type="text" class="form-input" placeholder="Card number" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <input type="text" class="form-input" placeholder="Expiration date (MM / YY)" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" placeholder="Security code" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-input" placeholder="Name on card" required>
                    </div>

                    <div class="checkbox-group">
                        <input type="checkbox" id="billing-address" class="checkbox" checked>
                        <label for="billing-address" class="checkbox-label">Use shipping address as billing
                            address</label>
                    </div>
                </div>

                <div class="text-center">
                    <a href="#" class="shop-now-btn">
                        Pay now
                        <span class="btn-arrow">→</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="order-summary">
            <h3 class="summary-title">Order Summary</h3>

            <div class="order-item">
                <div class="item-image">
                    <img src="{{ asset('assets/imgs/balkees-img1.webp') }}" alt="Lemon Zest & Ginger Fusion">
                </div>
                <div class="item-details">
                    <div class="item-name">Lemon Zest & Ginger Fusion</div>
                    <div class="item-variant">Size: 400g</div>
                    <div class="item-quantity">Qty: 1</div>
                </div>
                <div class="item-price">Dhs. 304.00</div>
            </div>

            <div class="order-item">
                <div class="item-image">
                    <img src="{{ asset('assets/imgs/balkees-img2.webp') }}" alt="Cinnamon & Sesame Seed Fusion">
                </div>
                <div class="item-details">
                    <div class="item-name">Cinnamon & Sesame Seed Fusion</div>
                    <div class="item-variant">Size: 400g</div>
                    <div class="item-quantity">Qty: 1</div>
                </div>
                <div class="item-price">Dhs. 304.00</div>
            </div>

            <div class="summary-row">
                <span>Subtotal</span>
                <span>Dhs. 608.00</span>
            </div>

            <div class="summary-row">
                <span>Shipping</span>
                <span>Free</span>
            </div>

            <div class="summary-row">
                <span>Taxes</span>
                <span>Calculated at checkout</span>
            </div>

            <div class="summary-row total">
                <span>Total</span>
                <span>AED Dhs. 608.00</span>
            </div>
        </div>
    </div>

    <script>
        function selectPayment(type) {
            // Remove active class from all options
            document.querySelectorAll('.payment-option').forEach(option => {
                option.classList.remove('active');
            });

            // Add active class to selected option
            event.currentTarget.classList.add('active');

            // Hide all forms
            document.querySelectorAll('.card-form').forEach(form => {
                form.classList.remove('active');
            });

            // Show relevant form
            if (type === 'card' || type === 'debit') {
                document.getElementById('card-form').classList.add('active');
            }
        }

        // Form validation and submission
        document.querySelector('.shop-now-btn').addEventListener('click', function(e) {
            e.preventDefault();

            // Basic validation
            const requiredFields = document.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.style.borderColor = '#e74c3c';
                } else {
                    field.style.borderColor = '#ddd';
                }
            });

            if (isValid) {
                alert('Order processed successfully!');
                // Here you would submit the form
            } else {
                alert('Please fill in all required fields.');
            }
        });
    </script>
@endsection
