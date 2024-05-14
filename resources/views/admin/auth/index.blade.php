<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Trọ ơi</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

		<!-- App css -->

		<link href="{{ asset('be/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

		<!-- icons -->
		<link href="{{ asset('be/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />

    </head>

    <body class="loading authentication-bg authentication-bg-pattern">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                @yield('content')
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <!-- Vendor -->
        <script src="{{ asset('be/assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('be/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('be/assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('be/assets/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('be/assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('be/assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('be/assets/libs/feather-icons/feather.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('be/assets/js/app.min.js') }}"></script>


    </body>
</html>
