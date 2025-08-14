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
    }

    .nav-menu {
        display: flex;
        list-style: none;
        gap: 1.5rem;
    }

    .nav-actions {
        display: flex;
        gap: 1rem;
        font-size: 20px;
    }

    /* Cart badge */
    .cart-badge {
        background-color: #ec5f5f;
        color: #fff;
        font-size: 10px;
        padding: 2px 5px;
        border-radius: 50%;
        margin-left: 2px;
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
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 5px;
        margin: 5px 10px;
    }

    /* ----------------------------- */
    /* MOBILE SCREEN STYLES BELOW ⬇ */
    /* ----------------------------- */

    @media screen and (max-width: 768px) {
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

        .nav-actions,
        .nav-menu li {
            font-size: 18px;
        }

        .nav-menu li {
            list-style: none;
        }

        .nav-menu li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            text-transform: uppercase;
        }
    }
</style>


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
                    <a href="#" class="brand-logo"><img src="{{ asset('assets/imgs/logo.png') }}" alt=""
                            style="width: 5rem;"></a>

                    <ul class="nav-menu">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Service</a></li>
                        <li><a href="#">Product</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>

                    <div class="nav-actions">
                        <div class="action-icon">👤</div>
                        <div class="action-icon cart-icon">
                            🛒
                            <span class="cart-badge">0</span>
                        </div>
                    </div>

                    <!-- Mobile Menu Toggle -->
                    <div class="mobile-menu-toggle">
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
