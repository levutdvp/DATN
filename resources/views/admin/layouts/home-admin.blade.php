<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Chào mừng bạn đã đến trang quản trị</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->

    @if ($global_setting->favicon && asset($global_setting->favicon))
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset($global_setting->favicon) }}" />
    @else
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('no_image.jpg') }}" />
    @endif

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Plugins css -->
    <link href="{{ asset('be/assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('be/assets/libs/dropify/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('be/assets/css/app.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('be/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('be/assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="{{ asset('be/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <link rel="stylesheet" href="{{ asset('be/assets/css/toastr.css') }}">
    <!-- icons -->
    <link href="{{ asset('be/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('be/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('be/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('be/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('be/assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('be/assets/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('be/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('be/assets/css/bootstrap5-toggle.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ asset('be/assets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
</head>

<!-- body start -->


{{-- class="loading" data-layout-color="light" data-layout-mode="default" data-layout-size="fluid"
data-topbar-color="light" data-leftbar-position="fixed" data-leftbar-color="light" data-leftbar-size='default'
data-sidebar-user='true' --}}

<body>
    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->

        @include('admin.layouts.partials.topbar')
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        @include('admin.layouts.partials.l-sidebar')
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->


        <div class="content-page">
            <div class="">
                <!-- Start Content-->
                <img class="w-100 h-100" src="{{asset('be/assets/images/banner-admin.jpg')}}" alt="">
                <!-- content -->
            </div>

            <!-- Footer Start -->
            @include('admin.layouts.partials.footer')
            <!-- end Footer -->

        </div>
        <!-- End Page content -->


    </div>
    <!-- END wrapper -->

    <!-- Right Sidebar -->
    @include('admin.layouts.partials.r-sidebar')
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- Vendor -->


    <script src="{{ asset('be/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('be/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('be/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('be/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('be/assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('be/assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('be/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('be/assets/js/pages/materialdesign.init.js') }}"></script>
    <!-- knob plugin -->
    <script src="{{ asset('be/assets/libs/jquery-knob/jquery.knob.min.js') }}"></script>

    <script src="{{ asset('be/assets/libs/dropify/js/dropify.min.js') }}"></script>

    <!--Morris Chart-->
    <script src="{{ asset('be/assets/libs/raphael/raphael.min.js') }}"></script>

    <script src="{{ asset('be/assets/libs/morris.js06/morris.min.js') }}"></script>

    {{-- Ckeditor --}}
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('editor1');
    </script>

    {{-- load ảnh --}}
    <script>
        $(function() {
            function readURL(input, selector) {
                if (input.files && input.files[0]) {
                    let reader = new FileReader();

                    reader.onload = function(e) {
                        $(selector).attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#image").change(function() {
                console.log(123);
                readURL(this, '#image_preview');
            });

            $("#image-favi").change(function() {
                console.log(123);
                readURL(this, '#image_preview_favi');
            });
        })
    </script>

    <script src="{{ asset('input-mask/jquery.inputmask.js') }}"></script>
    <!-- Dashboar init js-->
    <script src="{{ asset('be/assets/js/pages/dashboard.init.js') }}"></script>

    <!-- Plugins js -->
    <script src="{{ asset('be/assets/libs/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('be/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('be/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('be/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('be/assets/js/bootstrap5-toggle.ecmas.min.js') }}"></script>
    <script src="{{ asset('be/assets/js/code.js') }}"></script>
    <script src="{{ asset('be/assets/js/pages/form-fileuploads.init.js') }}"></script>
    <script src="{{ asset('fe/js/ie8-responsive-file-warning.js') }}"></script>
    <script src="{{ asset('fe/js/ie-emulation-modes-warning.js') }}"></script>

    {{-- Hiển thị thông báo --}}
    <script src="{{ asset('be/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('be/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('be/assets/js/pages/form-advanced.init.js') }}"></script>
    <script src="{{ asset('be/assets/libs/selectize/js/standalone/selectize.min.js') }}"></script>
    <script src="{{ asset('be/assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('be/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('be/assets/js/pages/form-advanced.init.js') }}"></script>
    @stack('scripts')
</body>

</html>
