<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') {{ config('app.name') }}</title>

    @if (env('APP_ENV') === 'development')
        <!-- General CSS Files -->
        <link rel="stylesheet" href="{{ asset('/assets/modules/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/assets/modules/fontawesome/css/all.min.css') }}">

        <!-- CSS Libraries -->

        <!-- Template CSS -->
        <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('/assets/css/components.css') }}">
    @else
        <!-- General CSS Files -->
        <link rel="stylesheet" href="{{ secure_asset('/assets/modules/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ secure_asset('/assets/modules/fontawesome/css/all.min.css') }}">

        <!-- CSS Libraries -->

        <!-- Template CSS -->
        <link rel="stylesheet" href="{{ secure_asset('/assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ secure_asset('/assets/css/components.css') }}">
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
    <div id="app">
        @yield('content')
    </div>
    @stack('before-script')
    @if (env('APP_ENV') === 'development')
        <!-- General JS Scripts -->
        <script src="{{ asset('/assets/modules/jquery.min.js') }}"></script>
        <script src="{{ asset('/assets/modules/popper.js') }}"></script>
        <script src="{{ asset('/assets/modules/tooltip.js') }}"></script>
        <script src="{{ asset('/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
        <script src="{{ asset('/assets/modules/moment.min.js') }}"></script>
        <script src="{{ asset('/assets/js/stisla.js') }}"></script>

        <!-- JS Libraries -->

        <!-- Page Specific JS File -->

        <!-- Template JS File -->
        <script src="{{ asset('/assets/js/scripts.js') }}"></script>
        <script src="{{ asset('/assets/js/custom.js') }}"></script>
    @else
        <!-- General JS Scripts -->
        <script src="{{ secure_asset('/assets/modules/jquery.min.js') }}"></script>
        <script src="{{ secure_asset('/assets/modules/popper.js') }}"></script>
        <script src="{{ secure_asset('/assets/modules/tooltip.js') }}"></script>
        <script src="{{ secure_asset('/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ secure_asset('/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
        <script src="{{ secure_asset('/assets/modules/moment.min.js') }}"></script>
        <script src="{{ secure_asset('/assets/js/stisla.js') }}"></script>

        <!-- JS Libraries -->

        <!-- Page Specific JS File -->

        <!-- Template JS File -->
        <script src="{{ secure_asset('/assets/js/scripts.js') }}"></script>
        <script src="{{ secure_asset('/assets/js/custom.js') }}"></script>
    @endif

    <!-- CDN JS Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    @if ($message = Session::get('failed'))
        <script>
            Swal.fire('{{ $message }}');
        </script>
    @endif

    @stack('page-script')
</body>

</html>
