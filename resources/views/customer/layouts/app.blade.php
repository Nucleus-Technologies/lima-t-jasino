<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('brand/favicon.png') }}" type="image/png">

    <title>{{ showTitle($title) }}</title>

    <!-- Utilities CSS -->
    <link rel="stylesheet" href="{{ asset('customer/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/vendors/linericon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/vendors/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/vendors/lightbox/simpleLightbox.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/vendors/nice-select/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/vendors/animate-css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/vendors/jquery-ui/jquery-ui.css') }}">

    <!-- Fonts -->
    <script src="https://kit.fontawesome.com/fa22834e6d.js"></script>

    <!-- main css -->
    <link rel="stylesheet" href="{{ asset('customer/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/css/responsive.css') }}">
</head>

<body>

    {{-- Header Menu Area --}}
    @include('customer.layouts.partials._header')

    {{-- Page Banner Area--}}
    @yield('banner')

    {{-- Page Container--}}
    @yield('content')

    {{-- Newsletter Area --}}
    @include('customer.layouts.partials._newsletter')

    {{-- Footer Area --}}
    @include('customer.layouts.partials._footer')

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('customer/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('customer/js/popper.js') }}"></script>
    <script src="{{ asset('customer/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('customer/js/stellar.js') }}"></script>
    <script src="{{ asset('customer/vendors/lightbox/simpleLightbox.min.js') }}"></script>
    <script src="{{ asset('customer/vendors/nice-select/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('customer/vendors/isotope/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('customer/vendors/isotope/isotope-min.js') }}"></script>
    <script src="{{ asset('customer/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('customer/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('customer/vendors/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('customer/vendors/flipclock/timer.js') }}"></script>
    <script src="{{ asset('customer/vendors/counter-up/jquery.counterup.js') }}"></script>
    <script src="{{ asset('customer/js/mail-script.js') }}"></script>
    <script src="{{ asset('customer/js/theme.js') }}"></script>
    <script src="{{ asset('customer/js/app.js') }}"></script>
</body>

</html>
