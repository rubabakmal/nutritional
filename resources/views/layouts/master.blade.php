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
