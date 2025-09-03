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
            background: white;
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
            border-color: #35B4AD !important;
            background: rgba(53, 180, 173, 0.1) !important;
        }

        .payment-option.active .payment-radio {
            accent-color: #35B4AD;
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

        .security-note {
            font-size: 13px;
            color: #666;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .payment-form {
            display: none;
            margin-top: 20px;
        }

        .payment-form.active {
            display: block;
        }

        /* Stripe Elements styling */
        #card-element {
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background: white;
            margin-bottom: 15px;
        }

        #card-element:focus {
            border-color: #35B4AD;
            box-shadow: 0 0 0 3px rgba(53, 180, 173, 0.1);
        }

        #card-errors {
            color: #e74c3c;
            margin-top: 10px;
            font-size: 14px;
        }

        .pay-button {
            width: 100%;
            background: linear-gradient(135deg, #35B4AD 0%, #2a9089 100%);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            font-family: "Red Hat Display", sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .pay-button:hover:not(:disabled) {
            background: linear-gradient(135deg, #2a9089 0%, #35B4AD 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(53, 180, 173, 0.3);
        }

        .pay-button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .loading-spinner {
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
            display: none;
        }

        .pay-button.loading .loading-spinner {
            display: inline-block;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
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

        .order-item:last-of-type {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
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

        .error-message {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 10px;
            display: none;
        }

        .success-message {
            color: #27ae60;
            font-size: 14px;
            margin-top: 10px;
            display: none;
        }
    </style>

    <div class="checkout-container">
        <!-- Checkout Form -->
        <div class="checkout-form">
            <form id="checkout-form">
                <!-- Contact Section -->
                <div class="form-section">
                    <h2 class="section-title">Contact</h2>
                    <div class="form-group">
                        <input type="email" id="email" class="form-input" placeholder="Email address" required>
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
                        <select class="form-select" id="country" required>
                            <option value="AE">United Arab Emirates</option>
                            <option value="SA">Saudi Arabia</option>
                            <option value="KW">Kuwait</option>
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <input type="text" id="first_name" class="form-input" placeholder="First name" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="last_name" class="form-input" placeholder="Last name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" id="address" class="form-input" placeholder="Address" required>
                    </div>
                    <div class="form-group">
                        <input type="text" id="apartment" class="form-input" placeholder="Apartment, suite, etc. (optional)">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <input type="text" id="city" class="form-input" placeholder="City" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Emirate</label>
                            <select class="form-select" id="state" required>
                                <option value="AUH">Abu Dhabi</option>
                                <option value="DXB">Dubai</option>
                                <option value="SHJ">Sharjah</option>
                                <option value="AJM">Ajman</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="tel" id="phone" class="form-input" placeholder="Phone" required>
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
                        <span class="shipping-label">Standard Delivery</span>
                        <span class="shipping-price">{{ isset($shipping) && $shipping == 0 ? 'FREE' : 'AED ' . number_format($shipping ?? 25, 2) }}</span>
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
                        <div class="payment-option active" onclick="selectPayment('stripe')">
                            <input type="radio" name="payment" value="stripe" class="payment-radio" checked>
                            <span class="payment-label">Credit / Debit Card</span>
                        </div>

                        <div class="payment-option" onclick="selectPayment('cod')">
                            <input type="radio" name="payment" value="cod" class="payment-radio">
                            <span class="payment-label">Cash on Delivery (COD)</span>
                        </div>
                    </div>

                    <!-- Stripe Payment Form -->
                    <div id="stripe-form" class="payment-form active">
                        <div id="card-element">
                            <!-- Stripe Elements will create form elements here -->
                        </div>
                        <div id="card-errors" role="alert"></div>
                    </div>

                    <div class="error-message" id="error-message"></div>
                    <div class="success-message" id="success-message"></div>

                    <button type="submit" id="pay-button" class="pay-button">
                        <span class="loading-spinner"></span>
                        <span class="button-text">Pay AED {{ number_format($finalTotal ?? 608, 2) }}</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Order Summary -->
        <div class="order-summary">
            <h3 class="summary-title">Order Summary</h3>

            @if(isset($formattedItems))
                @foreach($formattedItems as $item)
                    <div class="order-item">
                        <div class="item-image">
                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"
                                 onerror="this.src='{{ asset('assets/imgs/default-product.jpg') }}'">
                        </div>
                        <div class="item-details">
                            <div class="item-name">{{ $item['name'] }}</div>
                            <div class="item-variant">Size: {{ $item['size'] ?? '400g' }}</div>
                            <div class="item-quantity">Qty: {{ $item['quantity'] }}</div>
                        </div>
                        <div class="item-price">AED {{ number_format($item['total'], 2) }}</div>
                    </div>
                @endforeach
            @else
                <!-- Fallback hardcoded items -->
                <div class="order-item">
                    <div class="item-image">
                        <img src="{{ asset('assets/imgs/balkees-img1.webp') }}" alt="Lemon Zest & Ginger Fusion">
                    </div>
                    <div class="item-details">
                        <div class="item-name">Lemon Zest & Ginger Fusion</div>
                        <div class="item-variant">Size: 400g</div>
                        <div class="item-quantity">Qty: 1</div>
                    </div>
                    <div class="item-price">AED 304.00</div>
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
                    <div class="item-price">AED 304.00</div>
                </div>
            @endif

            <div class="summary-row">
                <span>Subtotal ({{ $cartCount ?? 2 }} item{{ ($cartCount ?? 2) != 1 ? 's' : '' }})</span>
                <span>AED {{ number_format($subtotal ?? 608, 2) }}</span>
            </div>

            <div class="summary-row">
                <span>Shipping</span>
                <span>{{ isset($shipping) && $shipping == 0 ? 'FREE' : 'AED ' . number_format($shipping ?? 25, 2) }}</span>
            </div>

            <div class="summary-row">
                <span>Tax (5%)</span>
                <span>AED {{ number_format($tax ?? 30.4, 2) }}</span>
            </div>

            <div class="summary-row total">
                <span>Total</span>
                <span>AED {{ number_format($finalTotal ?? 663.4, 2) }}</span>
            </div>
        </div>
    </div>

    <!-- Stripe JS -->
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Initialize Stripe
        const stripe = Stripe('{{ config('services.stripe.key') }}');
        const elements = stripe.elements();

        // Create card element
        const cardElement = elements.create('card', {
            style: {
                base: {
                    fontSize: '16px',
                    color: '#424770',
                    '::placeholder': {
                        color: '#aab7c4',
                    },
                },
                invalid: {
                    color: '#9e2146',
                },
            },
        });

        cardElement.mount('#card-element');

        // Handle real-time validation errors from the card Element
        cardElement.on('change', ({error}) => {
            const displayError = document.getElementById('card-errors');
            if (error) {
                displayError.textContent = error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission
        const form = document.getElementById('checkout-form');
        const payButton = document.getElementById('pay-button');
        const buttonText = document.querySelector('.button-text');
        const errorMessage = document.getElementById('error-message');
        const successMessage = document.getElementById('success-message');

        // Add event listeners for payment option changes
        document.querySelectorAll('input[name="payment"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const paymentType = this.value;
                const stripeForm = document.getElementById('stripe-form');

                // Update visual state
                document.querySelectorAll('.payment-option').forEach(option => {
                    option.classList.remove('active');
                });
                this.closest('.payment-option').classList.add('active');

                // Show/hide stripe form and update button text
                if (paymentType === 'stripe') {
                    stripeForm.classList.add('active');
                    buttonText.textContent = 'Pay AED {{ number_format($finalTotal ?? 663.4, 2) }}';
                } else {
                    stripeForm.classList.remove('active');
                    buttonText.textContent = 'Place Order';
                }

                // Clear any card errors when switching to COD
                if (paymentType === 'cod') {
                    document.getElementById('card-errors').textContent = '';
                }
            });
        });

        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const selectedPayment = document.querySelector('input[name="payment"]:checked').value;

            if (selectedPayment === 'cod') {
                handleCODPayment();
                return;
            }

            // Validate form
            if (!validateForm()) {
                showErrorMessage('Please fill in all required fields.');
                return;
            }

            // Disable button and show loading state
            payButton.disabled = true;
            payButton.classList.add('loading');
            buttonText.textContent = 'Processing...';
            hideMessages();

            try {
                // Create payment intent
                const response = await fetch('{{ route('payment.intent') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                });

                const { client_secret, error } = await response.json();

                if (error) {
                    throw new Error(error);
                }

                // Confirm payment with Stripe
                const {error: stripeError, paymentIntent} = await stripe.confirmCardPayment(client_secret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: document.getElementById('first_name').value + ' ' + document.getElementById('last_name').value,
                            email: document.getElementById('email').value,
                            phone: document.getElementById('phone').value,
                            address: {
                                line1: document.getElementById('address').value,
                                city: document.getElementById('city').value,
                                state: document.getElementById('state').value,
                                country: document.getElementById('country').value,
                            }
                        }
                    }
                });

                if (stripeError) {
                    throw new Error(stripeError.message);
                } else {
                    // Payment succeeded - redirect to success page
                    const formData = new URLSearchParams();
                    formData.append('payment_intent', paymentIntent.id);
                    formData.append('email', document.getElementById('email').value);
                    formData.append('first_name', document.getElementById('first_name').value);
                    formData.append('last_name', document.getElementById('last_name').value);
                    formData.append('address', document.getElementById('address').value);
                    formData.append('apartment', document.getElementById('apartment').value);
                    formData.append('city', document.getElementById('city').value);
                    formData.append('state', document.getElementById('state').value);
                    formData.append('country', document.getElementById('country').value);
                    formData.append('phone', document.getElementById('phone').value);

                    window.location.href = '{{ route('payment.success') }}?' + formData.toString();
                }
            } catch (error) {
                console.error('Error:', error);
                showErrorMessage(error.message || 'An error occurred during payment');
            } finally {
                // Re-enable button
                payButton.disabled = false;
                payButton.classList.remove('loading');
                buttonText.textContent = 'Pay AED {{ number_format($finalTotal ?? 663.4, 2) }}';
            }
        });

        function selectPayment(type) {
            // Remove active class from all options
            document.querySelectorAll('.payment-option').forEach(option => {
                option.classList.remove('active');
            });

            // Add active class to selected option
            event.currentTarget.classList.add('active');

            // Update the radio button
            document.querySelector(`input[name="payment"][value="${type}"]`).checked = true;

            // Show/hide stripe form
            const stripeForm = document.getElementById('stripe-form');
            if (type === 'stripe') {
                stripeForm.classList.add('active');
                buttonText.textContent = 'Pay AED {{ number_format($finalTotal ?? 663.4, 2) }}';
            } else {
                stripeForm.classList.remove('active');
                buttonText.textContent = 'Place Order';
            }
        }

        function handleCODPayment() {
            // Validate form first
            if (!validateForm()) {
                showErrorMessage('Please fill in all required fields.');
                return;
            }

            // Disable button and show loading state
            payButton.disabled = true;
            payButton.classList.add('loading');
            buttonText.textContent = 'Processing...';
            hideMessages();

            // Collect form data
            const formData = new FormData();
            formData.append('email', document.getElementById('email').value);
            formData.append('first_name', document.getElementById('first_name').value);
            formData.append('last_name', document.getElementById('last_name').value);
            formData.append('address', document.getElementById('address').value);
            formData.append('apartment', document.getElementById('apartment').value);
            formData.append('city', document.getElementById('city').value);
            formData.append('state', document.getElementById('state').value);
            formData.append('country', document.getElementById('country').value);
            formData.append('phone', document.getElementById('phone').value);

            // Process COD order
            fetch('{{ route('cod.process') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showSuccessMessage('Order placed successfully! You will pay upon delivery.');

                    // Redirect to success page
                    setTimeout(() => {
                        window.location.href = data.redirect_url;
                    }, 1500);
                } else {
                    throw new Error(data.message || 'Error processing order');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showErrorMessage(error.message || 'Error processing your order');
            })
            .finally(() => {
                // Re-enable button
                payButton.disabled = false;
                payButton.classList.remove('loading');
                buttonText.textContent = 'Place Order';
            });
        }

        function showErrorMessage(message) {
            errorMessage.textContent = message;
            errorMessage.style.display = 'block';
            successMessage.style.display = 'none';
        }

        function showSuccessMessage(message) {
            successMessage.textContent = message;
            successMessage.style.display = 'block';
            errorMessage.style.display = 'none';
        }

        function hideMessages() {
            errorMessage.style.display = 'none';
            successMessage.style.display = 'none';
        }

        // Form validation
        function validateForm() {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.style.borderColor = '#e74c3c';
                } else {
                    field.style.borderColor = '#ddd';
                }
            });

            return isValid;
        }
    </script>
@endsection
