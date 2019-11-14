<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('brand/favicon.png') }}" type="image/png">

    <title>{{ show_title($title) }}</title>

    <!-- Utilities CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('customer/vendors/linericon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/vendors/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/vendors/lightbox/simpleLightbox.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/vendors/nice-select/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/vendors/animate-css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/vendors/jquery-ui/jquery-ui.css') }}">

    <!-- Fonts -->
    <script src="https://kit.fontawesome.com/fa22834e6d.js"></script>

    <!-- ScrollReveal -->
    <script src="https://unpkg.com/scrollreveal@4"></script>
    <!-- Masonry -->
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js"></script>

    <!-- main css -->
    <link href="{{ asset('users/app.css') }}" rel="stylesheet">
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

    <output id="alert-response">
        {{--  Flexbox container for aligning the toasts  --}}
        <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center toast-floatable hide w-100 h-100" style="min-height: 200px; background: rgba(0,0,0,.2);">
            {{--  Then put toasts within --}}
            <div id="cart-toast" role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-autohide="false">
                <div class="toast-header">
                    <svg class="bd-placeholder-img rounded mr-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                        <rect width="100%" height="100%" fill="#28a745"></rect>
                    </svg>
                    <strong class="mr-auto">Well Done!</strong>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    <p class="text-center">The outfit has been added to your bag.</p>
                    <div class="d-flex flex-column align-items-center">
                        <button type="button" class="white_bg_btn inverse text-uppercase mb-2" data-dismiss="toast" aria-label="Close">
                            Continue Shopping
                        </button>
                        <a class="white_bg_btn inverse text-uppercase" href="{{ route('cart') }}">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </output>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('customer/js/jquery-3.2.1.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('customer/js/stellar.js') }}"></script>
    <script src="{{ asset('customer/vendors/lightbox/simpleLightbox.min.js') }}"></script>
    <script src="{{ asset('customer/vendors/isotope/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('customer/vendors/isotope/isotope-min.js') }}"></script>
    <script src="{{ asset('customer/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('customer/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('customer/vendors/jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{ asset('customer/vendors/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('customer/vendors/flipclock/timer.js') }}"></script>
    <script src="{{ asset('customer/vendors/counter-up/jquery.counterup.js') }}"></script>
    <script src="{{ asset('customer/js/mail-script.js') }}"></script>
    <script src="{{ asset('customer/js/theme.js') }}"></script>
    <script src="{{ asset('customer/js/jquery.printElement.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js"></script>

    <script src="{{ asset('users/app.js') }}"></script>
    <script src="{{ asset('customer/js/app.js') }}"></script>
    <script src="{{ asset('customer/js/app.payment.js') }}"></script>
    <script src="{{ asset('customer/js/app.appointment.js') }}"></script>
    <script src="{{ asset('customer/js/app.outfit.js') }}"></script>
    <script src="{{ asset('customer/js/app.wishlist.js') }}"></script>

    <script>
        var Url = {
            "nt_url" : "{{ URL::to('users/notification/refresh') }}",
            "ct_rf_url" : "{{ URL::to('users/cart/refresh') }}",
            "ct_ic_rf_url" : "{{ URL::to('users/cart/icon/refresh') }}",
            "wl_rf_url" : "{{ URL::to('users/wishlist/refresh') }}",
            "nz_rf_url" : "{{ URL::to('users/payment/checkout/address_details/refresh-nz') }}",
            "inz_rf_url" : "{{ URL::to('users/payment/checkout/address_details/refresh-inz') }}",
            "ct_sc_url" : "{{ asset('users/app.js') }}",
            "uf_sc_url" : "{{ asset('customer/js/app.outfit.js') }}",
            "wl_sc_url" : "{{ asset('customer/js/app.wishlist.js') }}",
            "py_sc_url" : "{{ asset('customer/js/app.payment.js') }}"
        };
    </script>
</body>

</html>
