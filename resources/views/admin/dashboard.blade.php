@extends('admin.layouts.master')
@section('title', 'Dashboard | ADMIN - Trọ ơi')
@section('content')
    <div class="container-fluid">



        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">

                        <h4 class="header-title mt-0">Số tin đăng theo gói dịch vụ </h4>

                        <div class="widget-chart text-center">
                            <div id="chart-container" style="height: 245px;">

                            </div>
                            <ul class="list-inline chart-detail-list mb-0">
                               
                                <li class="list-inline-item">
                                    <h5 style="color: #f22424; font-size: 14px"><i class="fa fa-circle me-1"></i>VIP1</h5>
                                </li>
                                <li class="list-inline-item">
                                    <h5 style="color: #f2b424; font-size: 14px"><i class="fa fa-circle me-1"></i>VIP2</h5>
                                </li>
                                <li class="list-inline-item">
                                    <h5 style="color: #f72a79; font-size: 14px"><i class="fa fa-circle me-1"></i>VIP3</h5>
                                </li>
                            </ul>
                            <h5 style="color: #000000; font-size: 14px"><i class="fa fa-circle me-1"></i>Tin thường: {{ $countRoomPostNormal}} tin</h5>
                        </div>


                    </div>
                </div>
            </div><!-- end col -->
            
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @if ($totalRevenueCurrentYear > 0)
                                <h4 class="header-title mt-0">Doanh thu năm {{ $currentYear }}: {{ str_replace(',', '.', number_format($totalRevenueCurrentYear)) }}₫</h4>
                            @else
                                <div>Doanh thu năm {{ $currentYear }}</div>
                            @endif
                        </div>
                        @if ($revenueByMonth->count() > 0)
                        <div id="morris-bar-example" dir="ltr" style="height: 280px;" class="morris-chart"></div>
                        @else
                        <div>Chưa có doanh thu nào!</div>
                        @endif
                        <h2 class="fs-5 mt-1">Tổng thu các năm: {{ str_replace(',', '.', number_format($totalRevenueForYears)) }}₫
                        </h2>
                    </div>
                </div>
            </div><!-- end col -->


        </div>
        <!-- end row -->

        <div class="row">

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">

                        <h4 class="header-title mt-0 mb-4"><a href="{{ route('category-rooms.index') }}"
                                class="text-dark">Danh mục tin đăng</a></h4>

                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1 float-start" dir="ltr">
                                <input data-plugin="knob" data-width="70" data-height="70" data-fgColor="#f05050"
                                    data-bgColor="#F9B9B9" value="{{ $countCategoryRoomPostToActive }}" data-min="0"
                                    data-max="{{ $countCategoryRoomPost }}" data-skin="tron" data-angleOffset="180"
                                    data-readOnly="false" data-thickness=".15" />

                            </div>

                            <div class="widget-detail-1 text-end">
                                <h2 class="fs-5">Tổng: {{ $countCategoryRoomPost }}</h2>
                                <h2 class="text-muted pt-2 mb-1 fs-5">Hoạt động: {{ $countCategoryRoomPostToActive }}
                                </h2>
                                <p class="text-muted  mb-0">Vô hiệu: {{ $countCategoryRoomPost - $countCategoryRoomPostToActive }}</p>
                                <p class="text-muted  mb-1">Trong ngày: {{ $countCategoryRoomPostToDay }}</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">

                        <h4 class="header-title mt-0 mb-4"><a href="{{ route('admin-room-posts.index') }}"
                                class="text-dark">Tin đăng phòng</a></h4>

                        <div class="widget-box-2">
                            <div class="widget-detail-2 text-end">
                                <span class="badge bg-pink rounded-pill float-start mt-3">Tổng: {{ $countRoomPost }} <i
                                        class="mdi mdi-trending-up"></i> </span>
                                <h2 class="text-muted fs-5">Hoạt động: {{ $countRoomPostToActive }} </h2>
                                <p class="text-muted">Vô hiệu: {{ $countRoomPost - $countRoomPostToActive }}</p>
                                <p class="text-muted">Trong ngày: {{ $countRoomPostToDay }}</p>
                            </div>
                            <div class="progress progress-bar-alt-pink progress-sm">
                                <div class="progress-bar bg-pink" role="progressbar"
                                    aria-valuenow="{{ $countRoomPostToActive }}" aria-valuemin="0"
                                    aria-valuemax="{{ $countRoomPost }}"
                                    style="width: {{ $countRoomPost != 0 ? ($countRoomPostToActive / $countRoomPost) * 100 : 0 }}%;">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">

                        <h4 class="header-title mt-0 mb-4"><a href="{{ route('category-posts.index') }}"
                                class="text-dark">Danh mục bài viết</a></h4>

                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1 float-start" dir="ltr">
                                <input data-plugin="knob" data-width="70" data-height="70" data-fgColor="#faee43"
                                    data-bgColor="#f9f5b9" value="{{ $countCategoryPostToActive }}" data-min="0"
                                    data-max="{{ $countCategoryPost }}" data-skin="tron" data-angleOffset="180"
                                    data-readOnly="false" data-thickness=".15" />
                            </div>
                            <div class="widget-detail-1 text-end">
                                <h2 class="fs-5">Tổng: {{ $countCategoryPost }}</h2>
                                <h2 class="text-muted pt-2 mb-1 fs-5">Hoạt động: {{ $countCategoryPostToActive }}</h2>
                                <p class="text-muted  mb-0">Vô hiệu: {{ $countCategoryPost - $countCategoryPostToActive }}</p>
                                <p class="text-muted mb-1">Trong ngày: {{ $countCategoryPostToDay }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">

                        <h4 class="header-title mt-0 mb-4"><a href="{{ route('posts.index') }}" class="text-dark">Bài
                                viết</a></h4>

                        <div class="widget-box-2">
                            <div class="widget-detail-2 text-end">
                                <span class="badge bg-warning rounded-pill float-start mt-3">Tổng: {{ $countPost }} <i
                                        class="mdi mdi-trending-up"></i> </span>
                                <h2 class="text-muted fs-5">Đang hoạt động: {{ $countPostToActive }} </h2>
                                <p class="text-muted">Vô hiệu: {{ $countPost - $countPostToActive }}</p>
                                <p class="text-muted">Trong ngày: {{ $countPostToDay }}</p>

                            </div>
                            <div class="progress progress-bar-alt-warning progress-sm">
                                <div class="progress-bar bg-warning" role="progressbar"
                                    aria-valuenow="{{ $countPostToActive }}" aria-valuemin="0"
                                    aria-valuemax="{{ $countPost }}"
                                    style="width: {{ $countPost != 0 ? ($countPostToActive / $countPost) * 100 : 0 }}%;">
                                    <span class="visually-hidden">77% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->

        </div>
        <!-- end row -->

        <div class="row">

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">

                        <h4 class="header-title mt-0"><a href="{{ route('users.index') }}" class="text-dark">Tài khoản:
                                {{ $countAccount }}</a></h4>
                        <div class="row">
                            <div class="widget-chart-1 col-xl-6">
                                <div class="widget-detail-1">
                                    <h2 class="fs-6 badge bg-danger rounded-pill">Admin: {{ $countAccountAdmin }}</h2>
                                    <p class="text-muted" style="font-size: 10px">Trong ngày:
                                        {{ $countAccountAdminToDay }}</p>
                                </div>
                            </div>
                            <div class="widget-chart-1 col-xl-6">
                                <div class="widget-detail-1">
                                    <h2 class="fs-6 badge bg-warning rounded-pill">Vendor: {{ $countAccountVendor }}</h2>
                                    <p class="text-muted" style="font-size: 10px">Trong ngày:
                                        {{ $countAccountVendorToDay }}</p>
                                </div>
                            </div>
                            <div class="widget-chart-1 col-xl-6">
                                <div class="widget-detail-1">
                                    <h2 class="fs-6 badge bg-success rounded-pill"><a href="{{ route('roles.index') }}"
                                            class="text-white">Vai trò: {{ $countRole }}</a></h2>
                                </div>
                            </div>
                            <div class="widget-chart-1 col-xl-6">
                                <div class="widget-detail-1">
                                    <h2 class="fs-6 badge bg-info rounded-pill"><a
                                            href="{{ route('permissions.index') }}" class="text-white">Quyền:
                                            {{ $countPermission }}</a></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mt-0">Khác</h4>
                        <div class="row">
                            <div class="widget-chart-1 col-xl-6">
                                <div class="widget-detail-1">
                                    <h2 class="fs-6 badge bg-danger rounded-pill"><a href="{{ route('coupons.index') }}"
                                            class="text-white">Mã giảm giá: {{ $countCoupon }}</a></h2>
                                    <p class="text-muted" style="font-size: 10px">Hoạt động: {{ $countCouponToActive }}
                                    </p>
                                </div>
                            </div>
                            <div class="widget-chart-1 col-xl-6">
                                <div class="widget-detail-1">
                                    <h2 class="fs-6 badge bg-warning rounded-pill"><a href="{{ route('banners.index') }}"
                                            class="text-white">Banner: {{ $countBanner }}</a></h2>
                                    <p class="text-muted" style="font-size: 10px">Hoạt động: {{ $countBannerToActive }}
                                    </p>
                                </div>
                            </div>
                            <div class="widget-chart-1 col-xl-6">
                                <div class="widget-detail-1">
                                    <h2 class="fs-6 badge bg-success rounded-pill"><a
                                            href="{{ route('facilities.index') }}" class="text-white">Tiện ích:
                                            {{ $countFacility }}</a></h2>
                                </div>
                            </div>
                            <div class="widget-chart-1 col-xl-6">
                                <div class="widget-detail-1">
                                    <h2 class="fs-6 badge bg-info rounded-pill"><a
                                            href="{{ route('surroundings.index') }}" class="text-white">Xung quanh:
                                            {{ $countSurrounding }}</a></h2>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
            </div><!-- end col -->



        </div>
        <!-- end row -->


    </div> <!-- container-fluid -->
@endsection
@push('scripts')
    <script>
        // Xóa biểu đồ cũ nếu nó đã tồn tại
        var oldChart = document.getElementById('chart-container');
        while (oldChart.firstChild) {
            oldChart.removeChild(oldChart.lastChild);
        }

        // Tạo biểu đồ mới
        var services = {!! json_encode($services) !!};
        var countRoomPostToActive = {!! json_encode($countRoomPostToActive) !!};
        var data = [];
        var totalVIP = 0;
        services.forEach(function(service) {
            if (service.name === 'VIP 1' || service.name === 'VIP 2' || service.name === 'VIP 3') {
                data.push({
                    label: service.name,
                    value: service.room_posts_count
                });
            }

        });


        new Morris.Donut({
            element: 'chart-container',
            data: data,
            colors: ['#f22424', '#f2b424', '#f72a79'] // Có thể điều chỉnh mảng màu tùy thuộc vào dữ liệu

        });
    </script>

    <script>
        var oldChart = document.getElementById('morris-bar-example');
        if (oldChart) {
            oldChart.innerHTML = ''; // Xóa nội dung của phần tử
        }

        var revenueData = {!! json_encode($revenueByMonth) !!};

        var data = [];
        revenueData.forEach(function(item) {
            data.push({
                y: 'Tháng ' + item.month,
                a: item.total_revenue
            });
        });

        new Morris.Bar({
            element: 'morris-bar-example',
            data: data,
            xkey: 'y',
            ykeys: ['a'],
            labels: ['Doanh thu'],
            barSize: 10,
            hideHover: 'auto',
            resize: true,
            yLabelFormat: function(y) {
                // định dạng giá tiền Việt Nam
                return (Math.round(y)).toLocaleString('vi-VN', {
                    // style: 'currency',
                    // currency: 'VND',
                });
            }
        });
    </script>
@endpush