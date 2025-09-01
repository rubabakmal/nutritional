<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Old+Standard+TT:ital,wght@0,400;0,700;1,400&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Radio+Canada+Big:ital,wght@0,400..700;1,400..700&family=Red+Hat+Display:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


    <link rel="stylesheet" href="{{ asset('assets/imgs/css/main.css') }}">
    <title>NUTRITIONAL REMEDIES</title>
</head>

<body>

    <body class="@yield('body-class', 'default-page')">
        @include('website-layout.header')
        <div class="main">
            @yield('content')
        </div>
        @include('website-layout.footer')
    </body>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script>
        // Add click functionality
        document.querySelectorAll('.goal-card').forEach(card => {
            card.addEventListener('click', function() {
                // Remove active class from all cards
                document.querySelectorAll('.goal-card').forEach(c => c.classList.remove('active'));
                // Add active class to clicked card
                this.classList.add('active');
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                loop: false,
                margin: 20,
                nav: false, // ⛔ Don't show arrows
                dots: false,
                responsive: {
                    0: {
                        items: 1
                    },
                    576: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },
                    992: {
                        items: 3
                    }
                }
            });
        });


        $('.gift-carousel').owlCarousel({
            loop: true,
            margin: 15,
            nav: true,
            dots: false,
            navText: [
                '<i class="fas fa-chevron-left"></i>',
                '<i class="fas fa-chevron-right"></i>'
            ],
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                }
            }
        });
    </script>

    <script>
        $('.most-loved-carousel').owlCarousel({
            loop: true,
            margin: 20,
            nav: false, // disable default nav
            dots: false,
            autoplay: false,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                992: {
                    items: 3
                },
                1200: {
                    items: 4
                }
            }
        });

        // Custom Navigation
        $('.custom-next').click(function() {
            $('.most-loved-carousel').trigger('next.owl.carousel');
        });
        $('.custom-prev').click(function() {
            $('.most-loved-carousel').trigger('prev.owl.carousel');
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const menuToggle = document.querySelector(".mobile-menu-toggle");
            const navMenu = document.querySelector(".nav-menu");

            menuToggle.addEventListener("click", function() {
                navMenu.classList.toggle("active");
            });
        });
    </script>


    <script>
        // Simple test function with detailed logging
        function testAddToCart(productId) {
            console.log('=== ADD TO CART TEST ===');
            console.log('Product ID:', productId);
            console.log('CSRF Token:', document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'));
            console.log('Session ID from Laravel:', '{{ session()->getId() }}');

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            if (!csrfToken) {
                console.error('❌ CSRF Token not found!');
                alert('CSRF Token missing! Check app.blade.php');
                return;
            }

            const requestData = {
                product_id: productId,
                quantity: 1
            };

            console.log('Request Data:', requestData);
            console.log('Making request to:', '/cart/add');

            fetch('/cart/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(requestData)
                })
                .then(response => {
                    console.log('Response Status:', response.status);
                    console.log('Response Headers:', response.headers);
                    return response.json();
                })
                .then(data => {
                    console.log('✅ Response Data:', data);

                    if (data.success) {
                        alert('✅ Product added to cart! Check console for details.');
                        console.log('Cart Count:', data.cart_count);
                        console.log('Cart Total:', data.cart_total);

                        // Update badge if exists
                        const badge = document.getElementById('cartBadge');
                        if (badge) {
                            badge.textContent = data.cart_count;
                        }
                    } else {
                        console.error('❌ Failed to add to cart:', data.message);
                        alert('❌ Failed: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('❌ Network Error:', error);
                    alert('❌ Network Error: ' + error.message);
                });
        }

        // Test cart endpoints on page load
        document.addEventListener('DOMContentLoaded', function() {
            console.log('=== TESTING CART ENDPOINTS ===');

            // Test cart items endpoint
            fetch('/cart/items')
                .then(response => response.json())
                .then(data => {
                    console.log('📦 Cart Items Response:', data);
                })
                .catch(error => {
                    console.error('❌ Cart Items Error:', error);
                });

            // Test debug endpoint if available
            fetch('/debug-cart')
                .then(response => response.json())
                .then(data => {
                    console.log('🔍 Debug Cart Response:', data);
                })
                .catch(error => {
                    console.log('ℹ️ Debug endpoint not available (normal)');
                });
        });
    </script>
    <script>
        // Debug cart functionality
        console.log('CSRF Token:', document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'));
        console.log('Session ID:', '{{ session()->getId() }}');

        // Test cart API endpoint
        fetch('/cart/items', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log('Cart Items Response:', data);
            })
            .catch(error => {
                console.error('Cart API Error:', error);
            });
    </script>
</body>

</html>
