<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ show_title_admin($title) }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('brand/favicon-x.png') }}" type="image/png">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <!-- Icons -->
    <link href="{{ asset('admin/js/plugins/nucleo/css/nucleo.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/fa22834e6d.js"></script>

    <script src="https://cdn.tiny.cloud/1/y3gwk3acv87mmxpcgzhy5fzs19hh8dx7frmcggpf9lnyfr92/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- CSS Files -->
    <link href="{{ asset('admin/js/plugins/chart.js/dist/Chart.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/argon-dashboard.css?v=1.1.0') }}" rel="stylesheet">
    <link href="{{ asset('users/app.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/app.css') }}" rel="stylesheet">
</head>

<body class="@yield('body_class')">

    @if ($title !== 'Login')
        @include('admin.layouts.partials._nav')
    @endif

    {{-- Page Container--}}
    <div class="main-content">
        @yield('content')
    </div>

    <output id="alert-response">
        @include('flash::message')
    </output>

    <!--   Core   -->
    <script src="{{ asset('admin/js/plugins/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/chart.js/dist/Chart.extension.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js"></script>

    <!--   Optional JS   -->
    <script src="{{ asset('users/app.js') }}"></script>
    <script src="{{ asset('admin/js/helpers.js') }}"></script>
    <script src="{{ asset('admin/js/app.js') }}"></script>
    <script src="{{ asset('admin/js/app.appointment.js') }}"></script>
    <script src="{{ asset('admin/js/app.regioncity.js') }}"></script>
    <script src="{{ asset('admin/js/app.relaypoint.js') }}"></script>

    <!--   Argon JS   -->
    <script src="{{ asset('admin/js/argon-dashboard.min.js?v=1.1.0') }}"></script>
    <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>

    <script>
        window.TrackJS &&
            TrackJS.install({
            token: "ee6fab19c5a04ac1a32a645abde4613a",
            application: "argon-dashboard-free"
        });

        var Url = {
            "nt_url" : "{{ URL::to('admin/notification/refresh') }}"
        };
    </script>
</body>

</html>
