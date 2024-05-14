<!DOCTYPE html>
<html lang="zxx">

<head>

    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if ($global_setting)
        <meta name="title" content="{{ $global_setting->meta_title }}" />
        <meta name="author" content="{{ $global_setting->meta_author }}" />
        <meta name="keywords" content="{{ $global_setting->meta_keyword }}" />
        <meta name="description" content="{{ $global_setting->meta_description }}" />
    @endif
   

    @if ($global_setting && $global_setting->favicon && asset($global_setting->favicon))
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset($global_setting->favicon) }}" />
    @else
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('no_image.jpg') }}" />
    @endif

    <script src="{{ asset('fe/js/jquery-3.6.0.min.js') }}"></script>

    <script src="{{ asset('fe/js/jquery-3.6.0.min.js') }}"></script>
    {{--    icon facebook --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('fontawesome/css/v4-shims.css') }}" />

    <!-- External CSS libraries -->
    <link rel="stylesheet" type="text/css" href="{{ asset('fe/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('fe/css/animate.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('fe/css/bootstrap-submenu.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('fe/css/bootstrap-select.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('fe/fonts/font-awesome/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('fe/fonts/flaticon/font/flaticon.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('fe/fonts/linearicons/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('fe/css/jquery.mCustomScrollbar.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('fe/css/bootstrap-datepicker.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('fe/css/slick.css') }}" />
    <link href="{{ asset('be/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('fe/css/leaflet.css') }}" type="text/css" />
    {{--    css cua dropzone --}}
    <link href="{{ asset('be/assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('be/assets/libs/dropify/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('fe/css/skins/default.css') }}" rel="stylesheet" type="text/css" />
    <!-- Custom stylesheet -->
    <link rel="stylesheet" type="text/css" href="{{ asset('fe/css/initial.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('fe/css/style.css') }}" />
    <!-- dselect -->
    <link rel="stylesheet" href="https://unpkg.com/@jarstone/dselect/dist/css/dselect.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('fe/css/skins/default.css') }}" />

    <!-- Favicon icon -->
    <link href="{{ asset('be/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('be/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('be/assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('be/assets/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />

    <link href="{{ asset('be/assets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;500;600;700&amp;display=swap"
        rel="stylesheet" />

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->


    <link rel="stylesheet" type="text/css" href="{{ asset('fe/css/ie10-viewport-bug-workaround.css') }}" />
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css"
        type="text/css" media="all" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        
        <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id={{ $global_setting->analytic }}"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '{{ $global_setting->analytic }}');
</script>

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8125952063456560"
     crossorigin="anonymous"></script>
     
     <script async custom-element="amp-auto-ads"
        src="https://cdn.ampproject.org/v0/amp-auto-ads-0.1.js">
</script>
</head>

<body>

    <!-- Google Tag Manager (noscript) -->
    {{-- <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TFC5925" height="0" width="0"
            style="display: none; visibility: hidden"></iframe>
    </noscript>
    <div class="page_loader"></div> --}}

    {{-- Star Header --}}
    @include('client.layouts.partials.header')
    {{-- End Header --}}
    {{-- {{ session()->start() }} --}}
    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            @yield('content')
            <!-- content -->
        </div>
        {{--    Social Media Contact    --}}
        <div class="clearfix">

            {{-- <div class="media-button pull-left"> --}}
            <!-- Messenger Chat Plugin Code -->

            {{-- </div> --}}
            <div class="media-button pull-right">
                <div class="media-button-content">
                    <a href="tel:0363738586" class="call-icon" rel="nofollow">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        <div class="animated alo-circle"></div>
                        <div class="animated alo-circle-fill  "></div>
                        <span>Hotline:036 37 38 586</span>
                    </a>
                    <a href="https://www.facebook.com/profile.php?id=61553726249194" class="mes">
                        <i class="fa fa-facebook-official" aria-hidden="true"></i>
                        <span>Nhắn tin Facebook</span>
                    </a>
                    <a href="http://zalo.me/0363738586" class="zalo align-items-center">
                        <i class="fa pt-2" style="font-size: 11px" aria-hidden="true">Zalo</i>
                        <span>Zalo: 036 37 38 586</span>
                    </a>

                    <!-- Messenger Chat Plugin Code -->
                    <div id="fb-root"></div>

                    <!-- Your Chat Plugin code -->
                    <div id="fb-customer-chat" class="fb-customerchat">
                    </div>

                </div>

            </div>
        </div>


        <!-- Footer start #0b4c9f -->
        @include('client.layouts.partials.footer')
        <!-- Footer end -->

    </div>

    <script>
        var chatbox = document.getElementById('fb-customer-chat');
        chatbox.setAttribute("page_id", "153586964513136");
        chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml: true,
                version: 'v18.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

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
    <script src="{{ asset('fe/js/jquery.magnific-popup.min.js') }}"></script>


    <script src="{{ asset('be/assets/libs/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('be/assets/libs/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('be/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('be/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('be/assets/js/pages/form-fileuploads.init.js') }}"></script>


    {{-- <script src="https://unpkg.com/@jarstone/dselect/dist/js/dselect.js"></script>
    <!-- dselect -->
    <script>
        dselect(document.querySelector('#dselect-example'))
    </script> --}}
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>

    <script>
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav',
            focusOnSelect: true
        });
        $('.slider-nav').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: true,
            focusOnSelect: true,
            prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
            nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>'
        });

        $('.slider-nav').on('beforeChange', function(event, slick, currentSlide, nextSlide) {
            const thumbnailImageURL = slick.$slides.eq(nextSlide).find('img').attr('src');
            $('.slider-for').find('.img-main-slick').attr('src', thumbnailImageURL);
        });
    </script>
     
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    @stack('scripts')
    {{--    Contact media button --}}
    <script>
        $(document).ready(function() {
            $('.user-support').click(function(event) {
                $('.media-button-content').slideToggle();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // function bookmark() {
            $('.bookmark-button').click(function() {
                let button = $(this);
                let room_post_id = button.data('id');

                $.ajax({
                    url: '{{ route('bookmark') }}',
                    dataType: 'json',
                    method: 'GET',
                    data: {
                        room_post_id: room_post_id,
                    },
                    success: function(response) {
                        if (response.error) {
                            toastr.error(response.error, 'Thất bại');
                        } else {
                            $('#bookmarkQty').text(response.bm);
                            button.removeClass('bookmark-button').addClass('unbookmark-button');
                            button.off('click');

                            button.find('path').attr('d',
                                'M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9-4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z'
                            );
                        }

                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });
            // }
            // bookmark();
            // $('.unbookmark-button').click(function() {
            $(document).on('click', '.unbookmark-button', function() {
                let button = $(this);
                let room_post_id = button.data('id');

                $.ajax({
                    url: '{{ route('unbookmark', ['room_post_id' => 'room_post_id']) }}',
                    method: 'DELETE',
                    data: {
                        room_post_id: room_post_id,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        $('#bookmarkQty').text(response.bm);

                        button.removeClass('unbookmark-button').addClass('bookmark-button');
                        button.off('click');

                        // updateBookmarkCount(-1);

                        button.find('path').attr('d',
                            'M0 48C0 21.5 21.5 0 48 0l0 48V441.4l130.1-92.9c8.3-6 19.6-6 27.9 0L336 441.4V48H48V0H336c26.5 0 48 21.5 48 48V488c0 9-5 17.2-13 21.3s-17.6 3.4-24.9-1.8L192 397.5 37.9 507.5c-7.3 5.2-16.9 5.9-24.9 1.8S0 497 0 488V48z'
                        );

                        console.log('Item unbookmarked successfully');

                    },
                    error: function(error) {

                        console.error(error);
                    }
                });
            });
        });
    </script>

<amp-auto-ads type="adsense"
        data-ad-client="ca-pub-8125952063456560">
</amp-auto-ads>
</body>

</html>
