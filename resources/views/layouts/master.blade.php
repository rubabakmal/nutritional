<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('graindashboard/css/graindashboard.css') }}" rel="stylesheet">
    <style>
        .shop-now-btn {
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

        .shop-now-btn:hover {
            background-color: white;
            color: #35b4ad;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px #35b4ae76;
        }

        .btn-arrow {
            font-size: 1.2rem;
            font-weight: bold;
            transition: transform 0.3s ease;
        }

        .shop-now-btn:hover .btn-arrow {
            transform: translateX(5px);
        }


        .btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 10px;

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

        .side-nav-menu-item.active>.side-nav-menu-link,
        .side-nav-menu-link.active,
        .side-nav-menu-link:hover {
            color: #35b4ad;
        }

        .side-nav-menu-item.active>.side-nav-menu-link,
        .side-nav-menu-link.active,
        .side-nav-menu-link:focus {
            color: #35b4ad;
        }

        .side-nav-menu-item.active .side-nav-menu-icon,
        .side-nav-menu-link:hover .side-nav-menu-icon,
        .side-nav-menu-second-level>.side-nav-opened>.side-nav-menu-link .side-nav-menu-icon,
        .side-nav-menu-top-level>.side-nav-opened>.side-nav-menu-link .side-nav-menu-icon {
            color: #35b4ad;

        }

        .side-nav-control-icon {
            color: #35b4ad;
        }

        .side-nav-menu-second-level>.side-nav-opened>.side-nav-menu-link,
        .side-nav-menu-top-level>.side-nav-opened>.side-nav-menu-link {
            color: #35b4ad;
        }

        a {
            color: #35b4ad;
        }
    </style>
</head>

<body class="has-sidebar has-fixed-sidebar-and-header">
    @include('components.header')

    <main class="main">
        @include('components.sidebar')


        <div class="content">
            <div class="py-4 px-3 px-md-4">

                @yield('content')

            </div>

            @include('components.footer')

        </div>
    </main>


    <script src="{{ asset('graindashboard/js/graindashboard.js') }}"></script>
    <script src="{{ asset('graindashboard/js/graindashboard.vendor.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('scripts')
</body>

</html>
