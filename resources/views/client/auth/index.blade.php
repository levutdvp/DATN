<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from storage.googleapis.com/theme-vessel-items/checking-sites/hotel-alpha-html/HTML/main/forgot-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Aug 2023 14:25:51 GMT -->
<head>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />

    <!-- External CSS libraries -->
    <link rel="stylesheet" type="text/css" href="{{ asset('fe/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('fe/css/animate.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('fe/css/bootstrap-submenu.css') }}" />
    <link
        rel="stylesheet"
        type="text/css"
        href="{{ asset('fe/css/bootstrap-select.min.css') }}"
    />
    <link
        rel="stylesheet"
        type="text/css"
        href="{{ asset('fe/fonts/font-awesome/css/font-awesome.min.css') }}"
    />
    <link
        rel="stylesheet"
        type="text/css"
        href="{{ asset('fe/fonts/flaticon/font/flaticon.css') }}"
    />
    <link rel="stylesheet" type="text/css" href="{{ asset('fe/fonts/linearicons/style.css') }}" />
    <link
        rel="stylesheet"
        type="text/css"
        href="{{ asset('fe/css/jquery.mCustomScrollbar.css') }}"
    />
    <link
        rel="stylesheet"
        type="text/css"
        href="{{ asset('fe/css/bootstrap-datepicker.min.css') }}"
    />
    <link rel="stylesheet" type="text/css" href="{{ asset('fe/css/dropzone.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('fe/css/slick.css') }}" />
    <link rel="stylesheet" href="{{ asset('fe/css/leaflet.css') }}" type="text/css" />

    <!-- Custom stylesheet -->
    <link rel="stylesheet" type="text/css" href="{{ asset('fe/css/initial.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('fe/css/style.css') }}" />
    <!-- dselect -->
    <link
        rel="stylesheet"
        href="https://unpkg.com/@jarstone/dselect/dist/css/dselect.css"
    />
    <link rel="stylesheet" type="text/css" href="{{ asset('fe/css/skins/default.css') }}"/>

    <!-- Favicon icon -->
    @if ($global_setting && $global_setting->favicon && asset($global_setting->favicon))
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset($global_setting->favicon) }}" />
    @else
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('no_image.jpg') }}" />
    @endif

    <!-- Google fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet"
    />
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet"
    />
    <link
        href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;500;600;700&amp;display=swap"
        rel="stylesheet"
    />

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link
        rel="stylesheet"
        type="text/css"
        href="{{ asset('fe/css/ie10-viewport-bug-workaround.css') }}"
    />

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9
      ]><script src="{{ asset('fe/js/ie8-responsive-file-warning.js') }}"></script
    ><![endif]-->
    <script src="{{ asset('fe/js/ie-emulation-modes-warning.js') }}"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="{{ asset('fe/js/html5shiv.min.js') }}"></script>
    <script src="{{ asset('fe/js/respond.min.js') }}"></script>
    <![endif]-->
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TFC5925"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div class="page_loader"></div>

<!-- Option Panel -->
<!-- /Option Panel -->

<!-- Login section start -->
@yield('content')
<!-- Login section end -->

<script src="{{ asset('fe/js/jquery.min.js') }}"></script>
<script src="{{ asset('fe/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('fe/js/bootstrap-submenu.js') }}"></script>
<script src="{{ asset('fe/js/jquery.mb.YTPlayer.js') }}"></script>
<script src="{{ asset('fe/js/wow.min.js') }}"></script>
<script src="{{ asset('fe/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('fe/js/jquery.easing.1.3.js') }}"></script>
<script src="{{ asset('fe/js/jquery.scrollUp.js') }}"></script>
<script src="{{ asset('fe/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('fe/js/jquery.filterizr.js') }}"></script>
<script src="{{ asset('fe/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('fe/js/slick.min.js') }}"></script>
<script src="{{ asset('fe/js/sidebar.js') }}"></script>
<script src="{{ asset('fe/js/app.js') }}"></script>
<script src="{{ asset('fe/js/dropzone.js') }}"></script>
<script src="{{ asset('fe/js/jquery.magnific-popup.min.js') }}"></script>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="{{ asset('fe/js/ie10-viewport-bug-workaround.js') }}"></script>
<!-- Custom javascript -->

<script src="https://unpkg.com/@jarstone/dselect/dist/js/dselect.js"></script>
<!-- dselect -->
<script>
    dselect(document.querySelector('#dselect-example'))
</script>
<!-- Custom javascript -->

</body>

<!-- Mirrored from storage.googleapis.com/theme-vessel-items/checking-sites/hotel-alpha-html/HTML/main/forgot-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Aug 2023 14:25:51 GMT -->
</html>
