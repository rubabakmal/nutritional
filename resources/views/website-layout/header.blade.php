{{-- resources/views/website-layout/header.blade.php --}}
@php
    use App\Models\Cart;
    // Get cart count for initial display
    $cartCount = Cart::getCartCount();
@endphp

<style>
    /* Header Styles */
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

    .brand-logo img {
        width: 5rem;
    }

    .nav-menu {
        display: flex;
        list-style: none;
        gap: 1.5rem;
        margin: 0;
        padding: 0;
    }

    .nav-menu a {
        text-decoration: none;
        color: #333;
        font-weight: 500;
    }

    .nav-menu a:hover {
        color: #c8956d;
    }

    .nav-actions {
        display: flex;
        gap: 1rem;
        font-size: 20px;
        z-index: 1000;
        position: relative;
    }

    .action-icon {
        cursor: pointer;
        position: relative;
        color: #333;
    }

    .action-icon:hover {
        color: white;
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
        line-height: 12px;
        font-weight: bold;
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
        z-index: 9998;
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
        z-index: 9999;
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
        margin: 0;
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
        font-size: 14px;
    }

    .item-price {
        color: #35b4ad;
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

    .cart-text {
        color: #35b4ad !important;
        text-decoration: none;
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

    /* Mobile Styles */
    @media screen and (max-width: 768px) {
        .cart-sidebar {
            width: 100%;
            right: -100%;
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
            z-index: 9997;
            box-shadow: 5px 0 15px rgba(0, 0, 0, 0.2);
        }

        .nav-menu.active {
            left: 0;
        }

        .mobile-menu-toggle {
            display: flex;
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

    .checkout {
        width: 100%;
    }
</style>

<div class="header-wrap">
    <div class="top-header">
        <div class="top-header-content">
            <div class="header-left"></div>
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
            <nav class="main-navbar" id="mainNavbar">
                <div class="navbar-content">
                    <a href="{{ url('/') }}" class="brand-logo">
                        <img src="{{ asset('assets/imgs/logo.png') }}" alt="Logo">
                    </a>

                    <ul class="nav-menu" id="navMenu">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Service</a></li>
                        <li><a href="#">Product</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>

                    <div class="nav-actions">
                        <div class="action-icon" onclick="toggleCart()" id="cartIcon">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="cart-badge" id="cartBadge">{{ $cartCount }}</span>
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
<div class="cart-overlay" id="cartOverlay"></div>

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
    // CSRF token for Laravel AJAX requests
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
        '{{ csrf_token() }}';

    // Mobile menu toggle
    function toggleMobileMenu() {
        const navMenu = document.getElementById('navMenu');
        navMenu.classList.toggle('active');
    }

    // Toggle cart sidebar
    function toggleCart() {
        const overlay = document.getElementById('cartOverlay');
        const sidebar = document.getElementById('cartSidebar');

        overlay.classList.toggle('active');
        sidebar.classList.toggle('active');

        if (sidebar.classList.contains('active')) {
            loadCartFromDatabase();
        }
    }

    // Close cart
    function closeCart() {
        const overlay = document.getElementById('cartOverlay');
        const sidebar = document.getElementById('cartSidebar');

        overlay.classList.remove('active');
        sidebar.classList.remove('active');
    }

    // Load cart items from database
    function loadCartFromDatabase() {
        fetch('{{ route('cart.items') }}', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    displayCartItems(data.items, data.total, data.count);
                    updateCartBadge(data.count);
                } else {
                    console.error('Error loading cart:', data.message);
                    showEmptyCart();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showEmptyCart();
            });
    }

    // Display cart items (same as before but with database data)
    function displayCartItems(items, total, count) {
        const cartBody = document.getElementById('cartBody');
        const cartFooter = document.getElementById('cartFooter');

        if (items.length === 0) {
            showEmptyCart();
            return;
        }

        // Render cart items
        cartBody.innerHTML = items.map(item => `
            <div class="cart-item">
                <div class="item-image">
                    <img src="${item.image}" alt="${item.name}" onerror="this.src='{{ asset('assets/imgs/default-product.jpg') }}'">
                </div>
                <div class="item-details">
                    <div class="item-name">${item.name}</div>
                    <div class="item-price">AED ${parseFloat(item.price).toFixed(2)}</div>
                    <div class="quantity-controls">
                        <button class="quantity-btn" onclick="updateQuantityInDatabase(${item.id}, ${item.quantity - 1})">−</button>
                        <input type="number" class="quantity-input" value="${item.quantity}" onchange="updateQuantityInDatabase(${item.id}, this.value)" min="1">
                        <button class="quantity-btn" onclick="updateQuantityInDatabase(${item.id}, ${item.quantity + 1})">+</button>
                    </div>
                    <button class="remove-item" onclick="removeItemFromDatabase(${item.id})">Remove</button>
                </div>
            </div>
        `).join('');

        // Calculate shipping and totals (same logic as before)
        const subtotal = total;
        const shipping = subtotal >= 500 ? 0 : 25;
        const finalTotal = subtotal + shipping;
        const freeShippingProgress = Math.min((subtotal / 500) * 100, 100);
        const amountToFreeShipping = Math.max(500 - subtotal, 0);

        // Render footer
        cartFooter.innerHTML = `
       

                 <a href="{{ route('cart') }}" class="cart-text">
                       <span>All Cart Products</span>
                </a>
            <div class="shipping-progress">
                <div class="progress-bar" style="width: ${freeShippingProgress}%"></div>
            </div>
            <div class="progress-text">
                ${amountToFreeShipping > 0 
                    ? `You are AED ${amountToFreeShipping.toFixed(2)} away from FREE SHIPPING!`
                    : 'You qualify for FREE SHIPPING!'
                }
            </div>
            
            <div class="cart-summary">
                <div class="summary-row">
                    <span>Subtotal (${count} item${count !== 1 ? 's' : ''})</span>
                    <span>AED ${subtotal.toFixed(2)}</span>
                </div>
                <div class="summary-row">
                    <span>Shipping</span>
                    <span>${shipping === 0 ? 'FREE' : `AED ${shipping.toFixed(2)}`}</span>
                </div>
                <div class="summary-row total">
                    <span>Total</span>
                    <span>AED ${finalTotal.toFixed(2)}</span>
                </div>
            </div>
            
            <div class="shipping-note">
                Your cart is reserved for 10 Minutes. The stock is limited! Finalize your order now
            </div>
            
            <div class="text-center">
                <a href="#" class="shop-now-btn checkout">
                    Checkout
                    <span class="btn-arrow">→</span>
                </a>
            </div>
        `;
    }

    // Show empty cart
    function showEmptyCart() {
        const cartBody = document.getElementById('cartBody');
        const cartFooter = document.getElementById('cartFooter');

        cartBody.innerHTML = `
            <div class="empty-cart">
                <i class="fas fa-shopping-cart"></i>
                <h3>Your cart is empty</h3>
                <p>Start shopping to add items to your cart</p>
            </div>
        `;
        cartFooter.innerHTML = '';
    }

    // Update quantity in database
    function updateQuantityInDatabase(productId, newQuantity) {
        newQuantity = parseInt(newQuantity);
        if (newQuantity < 0) return;

        fetch('{{ route('cart.update') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: newQuantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadCartFromDatabase(); // Reload cart
                    showNotification('Cart updated', 'success');
                } else {
                    showNotification(data.message || 'Error updating cart', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error updating cart', 'error');
            });
    }

    // Remove item from database
    function removeItemFromDatabase(productId) {
        if (!confirm('Remove this item from cart?')) return;

        fetch('{{ route('cart.remove') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    product_id: productId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadCartFromDatabase(); // Reload cart
                    showNotification('Item removed', 'success');
                } else {
                    showNotification(data.message || 'Error removing item', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error removing item', 'error');
            });
    }

    // Update cart badge
    function updateCartBadge(count) {
        const cartBadge = document.getElementById('cartBadge');
        if (cartBadge) {
            cartBadge.textContent = count;
            // Add animation
            cartBadge.style.transform = 'scale(1.2)';
            setTimeout(() => {
                cartBadge.style.transform = 'scale(1)';
            }, 200);
        }
    }

    // Add to cart function (called from product pages)
    function addToCart(productId, productName, productPrice, productImage) {
        fetch('{{ route('cart.add') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: 1
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateCartBadge(data.cart_count);
                    showNotification('Product added to cart!', 'success');

                    // Show cart after adding item
                    setTimeout(() => {
                        toggleCart();
                    }, 500);
                } else {
                    showNotification(data.message || 'Error adding to cart', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error adding to cart', 'error');
            });
    }

    // Show notification
    function showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = `alert alert-${type === 'success' ? 'success' : 'danger'} notification-toast`;
        notification.innerHTML = `
            <i class="fas fa-${type === 'success' ? 'check' : 'exclamation'}-circle me-2"></i>
            ${message}
        `;

        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 10000;
            min-width: 300px;
            padding: 15px;
            border-radius: 5px;
            color: white;
            background-color: ${type === 'success' ? '#28a745' : '#dc3545'};
            animation: slideIn 0.3s ease;
        `;

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

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Load initial cart count
        fetch('{{ route('cart.items') }}', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateCartBadge(data.count);
                }
            })
            .catch(error => console.error('Error loading cart count:', error));
    });

    // Event listeners (same as before)
    document.addEventListener('click', function(event) {
        const sidebar = document.getElementById('cartSidebar');
        const cartIcon = document.getElementById('cartIcon');
        const navMenu = document.getElementById('navMenu');
        const mobileToggle = document.querySelector('.mobile-menu-toggle');

        if (!sidebar.contains(event.target) && !cartIcon.contains(event.target)) {
            if (sidebar.classList.contains('active')) {
                closeCart();
            }
        }

        if (!navMenu.contains(event.target) && !mobileToggle.contains(event.target)) {
            if (navMenu.classList.contains('active')) {
                navMenu.classList.remove('active');
            }
        }
    });

    document.getElementById('cartSidebar').addEventListener('click', function(event) {
        event.stopPropagation();
    });

    document.getElementById('cartOverlay').addEventListener('click', function() {
        closeCart();
    });

    // CSS for animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideOut {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
    `;
    document.head.appendChild(style);
</script>
