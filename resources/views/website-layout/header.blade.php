<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Default styles (desktop view) */
        .header-wrap {
            background-color: #fff;
            font-family: Arial, sans-serif;
        }

        .header-wrap .top-header {
            background-color: #1a1a1a;
            color: #fff;
            padding: 8px 0;
            font-size: 13px;
            text-align: center;
        }

        .header-wrap .top-header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 1rem;
        }

        .header-wrap .store-locator {
            color: #fff;
            text-decoration: none;
            font-size: 13px;
        }

        .main-navbar {
            padding: 1rem 0;
        }

        .navbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 1.5rem;
        }

        .nav-menu a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
        }

        .nav-actions {
            display: flex;
            gap: 1rem;
            font-size: 20px;
        }

        .action-icon {
            cursor: pointer;
            position: relative;
        }

        /* Cart badge */
        .cart-badge {
            background-color: #ec5f5f;
            color: #fff;
            font-size: 10px;
            padding: 2px 5px;
            border-radius: 50%;
            position: absolute;
            top: -5px;
            right: -5px;
            min-width: 16px;
            text-align: center;
        }

        /* Mobile menu icon */
        .mobile-menu-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
            gap: 3px;
        }

        .mobile-menu-toggle .menu-line {
            width: 25px;
            height: 3px;
            background-color: #333;
        }

        /* Info banner */
        .info-banner {
            background-color: #f8f4ef;
            font-size: 13px;
            padding: 10px 0;
        }

        .info-content {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            max-width: 1200px;
            margin: 0 auto;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 5px;
            margin: 5px 10px;
        }

        /* Cart Sidebar Styles */
        .cart-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .cart-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .cart-sidebar {
            position: fixed;
            top: 0;
            right: -400px;
            width: 400px;
            height: 100vh;
            background-color: #fff;
            z-index: 10000;
            transition: right 0.3s ease;
            display: flex;
            flex-direction: column;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.2);
        }

        .cart-sidebar.active {
            right: 0;
        }

        .cart-header {
            padding: 20px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f8f4ef;
        }

        .cart-title {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            flex: 1;
        }

        .cart-close {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #666;
            padding: 5px;
        }

        .cart-close:hover {
            color: #333;
        }

        .cart-body {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
        }

        .cart-item {
            display: flex;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 80px;
            height: 80px;
            background-color: #f5f5f5;
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
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .item-price {
            color: #c8956d;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .quantity-btn {
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            width: 30px;
            height: 30px;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .quantity-btn:hover {
            background-color: #e5e5e5;
        }

        .quantity-input {
            width: 50px;
            text-align: center;
            border: 1px solid #ddd;
            padding: 5px;
            border-radius: 4px;
        }

        .remove-item {
            background: none;
            border: none;
            color: #ec5f5f;
            cursor: pointer;
            font-size: 12px;
            text-decoration: underline;
        }

        .remove-item:hover {
            color: #d44343;
        }

        .empty-cart {
            text-align: center;
            padding: 50px 20px;
            color: #666;
        }

        .empty-cart i {
            font-size: 48px;
            margin-bottom: 15px;
            color: #ddd;
        }

        .cart-footer {
            padding: 20px;
            border-top: 1px solid #eee;
            background-color: #f9f9f9;
        }

        .cart-summary {
            margin-bottom: 15px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .summary-row.total {
            font-weight: bold;
            font-size: 18px;
            border-top: 1px solid #ddd;
            padding-top: 8px;
            color: #333;
        }

        .shipping-note {
            font-size: 12px;
            color: #666;
            margin-bottom: 15px;
            text-align: center;
        }

        .checkout-btn {
            width: 100%;
            background-color: #c8956d;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .checkout-btn:hover {
            background-color: #b8855d;
        }

        .checkout-btn:disabled {
            background-color: #ddd;
            cursor: not-allowed;
        }

        /* Progress indicator */
        .shipping-progress {
            background-color: #f0f0f0;
            height: 4px;
            border-radius: 2px;
            margin: 10px 0;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background-color: #4CAF50;
            border-radius: 2px;
            transition: width 0.3s ease;
        }

        .progress-text {
            font-size: 12px;
            color: #666;
            text-align: center;
            margin-top: 5px;
        }

        /* ----------------------------- */
        /* MOBILE SCREEN STYLES BELOW ⬇ */
        /* ----------------------------- */

        @media screen and (max-width: 768px) {
            .cart-sidebar {
                width: 100%;
                right: -100%;
            }

            .navbar-content {
                position: relative;
            }

            .nav-menu {
                position: fixed;
                top: 0;
                left: -100%;
                width: 80%;
                height: 100vh;
                background-color: #fff;
                flex-direction: column;
                padding: 2rem 1.5rem;
                gap: 1.5rem;
                transition: left 0.3s ease-in-out;
                z-index: 9999;
                box-shadow: 5px 0 15px rgba(0, 0, 0, 0.2);
            }

            .nav-menu.active {
                left: 0;
            }

            .mobile-menu-toggle {
                display: flex;
                flex-direction: column;
                gap: 5px;
                cursor: pointer;
            }

            .mobile-menu-toggle .menu-line {
                width: 25px;
                height: 3px;
                background-color: #333;
            }

            /* Mobile nav actions - KEEP CART ICON VISIBLE */
            .nav-actions {
                display: flex !important;
                gap: 1rem;
                font-size: 20px;
            }

            /* Mobile navbar layout fix */
            .navbar-content {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .nav-menu li {
                list-style: none;
            }

            .nav-menu li a {
                text-decoration: none;
                color: #333;
                font-weight: bold;
                text-transform: uppercase;
                font-size: 18px;
            }

            /* Better mobile header layout */
            .top-header-content {
                flex-direction: column;
                gap: 5px;
                text-align: center;
            }

            .info-content {
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="header-wrap">
        <div class="top-header">
            <div class="top-header-content">
                <div class="header-left">
                    <!-- Left side content can be added here -->
                </div>
                <div class="header-center">
                    Sign up to our newsletter for 10% off your first order
                </div>
                <div class="header-right">
                    <a href="#" class="store-locator">
                        <span class="location-icon">📍</span>
                        Store Locator
                    </a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="header-inner">

                <!-- Main Navigation -->
                <nav class="main-navbar" id="mainNavbar">
                    <div class="navbar-content">
                        <a href="#" class="brand-logo"><img src="{{ asset('assets/imgs/logo.png') }}"
                                alt="" style="width: 5rem;"></a>

                        <ul class="nav-menu" id="navMenu">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About</a></li>
                            <li><a href="#">Service</a></li>
                            <li><a href="#">Product</a></li>
                            <li><a href="#">Contact Us</a></li>
                        </ul>

                        <div class="nav-actions">
                            <div class="action-icon cart-icon" onclick="toggleCart()">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="cart-badge" id="cartBadge">2</span>
                            </div>
                        </div>

                        <!-- Mobile Menu Toggle -->
                        <div class="mobile-menu-toggle" onclick="toggleMobileMenu()">
                            <div class="menu-line"></div>
                            <div class="menu-line"></div>
                            <div class="menu-line"></div>
                        </div>
                    </div>
                </nav>

            </div>
        </div>
        <!-- Info Banner -->
        <div class="info-banner">
            <div class="container">

                <div class="info-content">
                    <div class="info-item">
                        <div class="info-icon">🚚</div>
                        <span>Free shipping on AED 500+ orders (UAE)</span>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">📧</div>
                        <span>Sign up for 10% off!</span>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">⭐</div>
                        <span>500+ 5 star reviews</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cart Overlay -->
    <div class="cart-overlay" id="cartOverlay" onclick="closeCart()"></div>

    <!-- Cart Sidebar -->
    <div class="cart-sidebar" id="cartSidebar">
        <div class="cart-header">
            <h2 class="cart-title">YOUR CART</h2>
            <button class="cart-close" onclick="closeCart()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="cart-body" id="cartBody">
            <!-- Cart items will be populated here -->
        </div>

        <div class="cart-footer" id="cartFooter">
            <!-- Cart summary will be populated here -->
        </div>
    </div>

    <script>
        // Sample cart data
        let cartItems = [{
                id: 1,
                name: "Cinnamon & Sesame Seed Fusion",
                price: 304.00,
                quantity: 1,
                image: "https://via.placeholder.com/80x80/c8956d/ffffff?text=Product"
            },
            {
                id: 2,
                name: "Black Seed Fusion",
                price: 304.00,
                quantity: 1,
                image: "https://via.placeholder.com/80x80/8B4513/ffffff?text=Seed"
            }
        ];

        // Mobile menu toggle function
        function toggleMobileMenu() {
            const navMenu = document.getElementById('navMenu');
            navMenu.classList.toggle('active');
        }

        function toggleCart() {
            const overlay = document.getElementById('cartOverlay');
            const sidebar = document.getElementById('cartSidebar');

            overlay.classList.toggle('active');
            sidebar.classList.toggle('active');

            if (sidebar.classList.contains('active')) {
                updateCartDisplay();
            }
        }

        function closeCart() {
            const overlay = document.getElementById('cartOverlay');
            const sidebar = document.getElementById('cartSidebar');

            overlay.classList.remove('active');
            sidebar.classList.remove('active');
        }

        function updateCartDisplay() {
            const cartBody = document.getElementById('cartBody');
            const cartFooter = document.getElementById('cartFooter');
            const cartBadge = document.getElementById('cartBadge');

            // Update cart badge
            const totalItems = cartItems.reduce((sum, item) => sum + item.quantity, 0);
            cartBadge.textContent = totalItems;

            if (cartItems.length === 0) {
                cartBody.innerHTML = `
                        <div class="empty-cart">
                            <i class="fas fa-shopping-cart"></i>
                            <h3>Your cart is reserved for 10 Minutes</h3>
                            <p>The stock is limited! Finalize your order now</p>
                        </div>
                    `;
                cartFooter.innerHTML = '';
                return;
            }

            // Render cart items
            cartBody.innerHTML = cartItems.map(item => `
                    <div class="cart-item">
                        <div class="item-image">
                            <img src="${item.image}" alt="${item.name}">
                        </div>
                        <div class="item-details">
                            <div class="item-name">${item.name}</div>
                            <div class="item-price">Dhs. ${item.price.toFixed(2)} AED</div>
                            <div class="quantity-controls">
                                <button class="quantity-btn" onclick="updateQuantity(${item.id}, ${item.quantity - 1})">−</button>
                                <input type="number" class="quantity-input" value="${item.quantity}" onchange="updateQuantity(${item.id}, this.value)">
                                <button class="quantity-btn" onclick="updateQuantity(${item.id}, ${item.quantity + 1})">+</button>
                            </div>
                            <button class="remove-item" onclick="removeItem(${item.id})">Remove</button>
                        </div>
                    </div>
                `).join('');

            // Calculate totals
            const subtotal = cartItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const shipping = subtotal >= 500 ? 0 : 25;
            const total = subtotal + shipping;
            const freeShippingProgress = Math.min((subtotal / 500) * 100, 100);
            const amountToFreeShipping = Math.max(500 - subtotal, 0);

            // Render cart footer
            cartFooter.innerHTML = `
                    <div class="shipping-progress">
                        <div class="progress-bar" style="width: ${freeShippingProgress}%"></div>
                    </div>
                    <div class="progress-text">
                        ${amountToFreeShipping > 0 
                            ? `You are Dhs. ${amountToFreeShipping.toFixed(2)} AED away from FREE SHIPPING!`
                            : 'You qualify for FREE SHIPPING!'
                        }
                    </div>
                    
                    <div class="cart-summary">
                        <div class="summary-row">
                            <span>Subtotal (${totalItems} item${totalItems !== 1 ? 's' : ''})</span>
                            <span>Dhs. ${subtotal.toFixed(2)} AED</span>
                        </div>
                        <div class="summary-row">
                            <span>Shipping</span>
                            <span>${shipping === 0 ? 'FREE' : `Dhs. ${shipping.toFixed(2)} AED`}</span>
                        </div>
                        <div class="summary-row total">
                            <span>Total</span>
                            <span>Dhs. ${total.toFixed(2)} AED</span>
                        </div>
                    </div>
                    
                    <div class="shipping-note">
                        Your cart is reserved for 10 Minutes. The stock is limited! Finalize your order now
                    </div>
                    
                    <button class="checkout-btn" onclick="checkout()">
                        Checkout → 
                    </button>
                `;
        }

        function updateQuantity(itemId, newQuantity) {
            newQuantity = parseInt(newQuantity);
            if (newQuantity < 1) {
                removeItem(itemId);
                return;
            }

            const item = cartItems.find(item => item.id === itemId);
            if (item) {
                item.quantity = newQuantity;
                updateCartDisplay();
            }
        }

        function removeItem(itemId) {
            cartItems = cartItems.filter(item => item.id !== itemId);
            updateCartDisplay();
        }

        function checkout() {
            alert('Proceeding to checkout...');
            // Here you would redirect to checkout page
        }

        // Initialize cart display
        updateCartDisplay();

        // Close cart when clicking outside
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('cartSidebar');
            const cartIcon = document.querySelector('.cart-icon');
            const navMenu = document.getElementById('navMenu');
            const mobileToggle = document.querySelector('.mobile-menu-toggle');

            // Close cart if clicked outside
            if (!sidebar.contains(event.target) && !cartIcon.contains(event.target)) {
                if (sidebar.classList.contains('active')) {
                    closeCart();
                }
            }

            // Close mobile menu if clicked outside
            if (!navMenu.contains(event.target) && !mobileToggle.contains(event.target)) {
                if (navMenu.classList.contains('active')) {
                    navMenu.classList.remove('active');
                }
            }
        });
    </script>
</body>

</html>
