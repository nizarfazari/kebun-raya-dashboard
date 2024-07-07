<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') {{ config('app.name') }}</title>
    @vite('resources/css/app.css')
    @if (env('APP_ENV') === 'development')
        <link rel="stylesheet" href="{{ asset('/assets/modules/select2/dist/css/select2.min.css') }}">
        <!-- General CSS Files -->
        <link rel="stylesheet" href="{{ asset('/assets/modules/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/assets/modules/fontawesome/css/all.min.css') }}">
        <!-- CSS Libraries -->

        <!-- Template CSS -->
        <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('/assets/css/components.css') }}">


        <link rel="stylesheet" href="{{ asset('/assets/modules/summernote/summernote-bs4.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('/assets/modules/select2/dist/css/select2.min.css') }}">
        <!-- General CSS Files -->
        <link rel="stylesheet" href="{{ asset('/assets/modules/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/assets/modules/fontawesome/css/all.min.css') }}">
        <!-- CSS Libraries -->

        <!-- Template CSS -->
        <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('/assets/css/components.css') }}">


        <link rel="stylesheet" href="{{ asset('/assets/modules/summernote/summernote-bs4.css') }}">
    @endif

    @stack('page-styles')
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>

<body>

    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        @include('includes.header')
        @include('includes.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <section class="section" style="z-index: auto">
                @yield('header')

                @yield('content')
            </section>
        </div>

    </div>

    @stack('before-script')
    @if (env('APP_ENV') === 'development')
        <script src="{{ asset('/assets/modules/jquery.min.js') }}"></script>
        <script src="{{ asset('/assets/modules/popper.js') }}"></script>
        <script src="{{ asset('/assets/modules/tooltip.js') }}"></script>
        <script src="{{ asset('/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
        <script src="{{ asset('/assets/js/stisla.js') }}"></script>
        <script src="{{ asset('/assets/modules/moment.min.js') }}"></script>
        <script src="{{ asset('/assets/modules/sweetalert/sweetalert.min.js') }}"></script>
        <script src="{{ asset('/assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('/assets/modules/summernote/summernote-bs4.js') }}"></script>
        <!-- JS Libraies -->

        <!-- Page Specific JS File -->

        <!-- Template JS File -->
        <script src="{{ asset('/assets/js/scripts.js') }}"></script>
        <script src="{{ asset('/assets/js/custom.js') }}"></script>
    @else
        <script src="{{ asset('/assets/modules/jquery.min.js') }}"></script>
        <script src="{{ asset('/assets/modules/popper.js') }}"></script>
        <script src="{{ asset('/assets/modules/tooltip.js') }}"></script>
        <script src="{{ asset('/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
        <script src="{{ asset('/assets/modules/sweetalert/sweetalert.min.js') }}"></script>
        <script src="{{ asset('/assets/modules/moment.min.js') }}"></script>
        <script src="{{ asset('/assets/js/stisla.js') }}"></script>
        <script src="{{ asset('/assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('/assets/modules/summernote/summernote-bs4.js') }}"></script>
        <!-- JS Libraies -->

        <!-- Page Specific JS File -->

        <!-- Template JS File -->
        <script src="{{ asset('/assets/js/scripts.js') }}"></script>
        <script src="{{ asset('/assets/js/custom.js') }}"></script>
    @endif

    @stack('page-script')
</body>

</html>
