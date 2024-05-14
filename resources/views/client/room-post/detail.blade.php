@extends('client.layouts.master')
@section('title', $roomposts->name)
@section('content')
    <!-- Sub banner start -->
    <div class="sub-banner">
        <div class="container">
            <div class="breadcrumb-area">
                <h1>Chi tiết tin đăng</h1>
            </div>
            <nav class="breadcrumbs">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Chi tiết phòng</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Sub Banner end -->
    <!-- Rooms detail section start -->
    <div class="content-area-15 rooms-detail-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-12 col-xs-12 sidebar">
                    <div class="rooms-detail-info">

                        <!-- sidebar start -->
                        <div class="rooms-detail-slider">
                            <div class="rooms-detail-slider mb-40 comon-slick">
                                <div class="slider slider-for pb-sm-3 slick comon-slick-inner wow">
                                    <div class="img-main-slick"><img src="{{ asset($roomposts->image) }}"
                                            class="img-fluid img-main" style="width: 100%;">
                                    </div>
                                    @foreach ($images as $image)
                                        <div class="img-main-slick">
                                            <img src=" {{ asset($image->name) }}" class="img-fluid img-main"
                                                style="width: 100%;">
                                        </div>
                                    @endforeach
                                </div>
                                <hr>
                                <div class="slider slider-nav d-lg-grid gap-3">
                                    <div class="p-1">
                                        <img src="{{ asset($roomposts->image) }}" class="w-100 h-100 img-slick img-fluid"
                                            alt="photo">
                                    </div>
                                    @foreach ($images as $image)
                                        <div class="p-1"><img src=" {{ asset($image->name) }}"
                                                class="w-100 h-100 img-slick img-fluid" alt="photo"
                                                style="width: 194px; background-size: 100%; background-repeat: no-repeat;">
                                        </div>
                                    @endforeach
                                </div>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="heading-rooms">

                                        <h3 style="font-size:24px;text-transform: uppercase; color:{{ $roomposts->service_id ? $roomposts->service->color : '' }}">
                                            {{ $roomposts->name }}</h3>

                                        <p>
                                            <i class="fas fa-map-marker-alt me-2"></i>{{ $roomposts->address_full }}
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center my-3">
                                            <div class="div d-flex">
                                                <p class="pe-5"><span class="text-danger"><i
                                                            class="fas fa-tag fa-rotate-90 me-2 text-danger"></i>{{ number_format($roomposts->price) }}
                                                        VND/Tháng</span>
                                                </p>
                                                <p><span><i class="fas fa-expand me-2"></i></i>{{ $roomposts->acreage }}
                                                        m2</span>
                                                </p>
                                            </div>
                                            <div class="dev">
                                                <p><i class="far fa-clock me-2"></i>{{ isset($roomposts->time_start)? timeposts($roomposts->time_start) : "--" }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="">
                                            <p for="">Danh mục: <span
                                                    class="fw-bold">{{ $roomposts->categoryroom->name }}</span></p>
                                        </div>
                                        <div class="mt-3 mb-3">

                                        </div>
                                    </div>
                                    <!-- Rooms details section start -->
                                    <div class="rooms-detail-slider ">
                                        <!-- Rooms description start -->
                                        <div class="rooms-description mb-30">
                                            <!-- Title -->
                                            <div class="main-title-2">
                                                <h1>Mô tả chi tiết</h1>
                                            </div>
                                            <!-- paragraph -->
                                            <div class="mb-0" style="overflow-wrap: break-word;">{!! $roomposts->description !!}
                                            </div>
                                        </div>
                                        <!-- Rooms description end -->

                                        <!-- Amenities start -->
                                        <div class="amenities mb-30 ">
                                            <div class="main-title-2">
                                                <h1>Tiện ích có sẵn</h1>
                                            </div>

                                            <div class="row">
                                                @foreach ($roomposts->facilities as $key => $value)
                                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                                        <i class="{{ $value->icon }} me-2"></i>{{ $value->name }}
                                                        {{-- <i class="{{ $value->icon }}"></i>{{ $value->name }} --}}
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                        <div class="amenities mb-30">
                                            <div class="main-title-2">
                                                <h1>Khu vực xung quanh</h1>
                                            </div>

                                            <div class="row">
                                                @foreach ($roomposts->surrounds as $key => $value)
                                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                                        <i class="{{ $value->icon }} me-2"></i>{{ $value->name }}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="amenities mb-30">
                                            <div class="main-title-2">
                                                <h1>Đặc điểm tin đăng</h1>
                                            </div>
                                            <table class="table border">
                                                <tr>
                                                    <td>Hình thức trọ:</td>
                                                    <td>
                                                        {{ $roomposts->managing == 'yes' ? 'Tự quản' : 'Chung chủ' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Số phòng trống:</td>
                                                    <td>
                                                        {{ $roomposts->empty_room }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Mã tin đăng:</td>
                                                    <td>
                                                        {{ $roomposts->id }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Loại tin đăng:</td>
                                                    <td>
                                                        @if ($roomposts->service_id != null)
                                                            {{ $roomposts->service->name }}
                                                        @else
                                                            Tin thường
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Ngày bắt đầu:</td>
                                                    <td>{{ $roomposts->created_at }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Ngày kết thúc:</td>
                                                    <td>{{ $roomposts->time_end ? $roomposts->time_end : '--' }}</td>
                                                </tr>

                                            </table>


                                        </div>











                                        <!-- Amenities end -->
                                        <!-- Similar room start -->
                                        {{-- <div class="similar-rooms "> --}}
                                        {{-- <div class="blog-section content-area comon-slick"> --}}
                                        <!-- Main title -->
                                        {{-- <div class="main-title-2">
                                            <h1>Phòng tương tự</h1>
                                        </div> --}}
                                        {{-- <div class="row wow fadeInUp delay-04s">
                                            @if (isset($caterooms))
                                                @if (count($caterooms) > 0)
                                                    @foreach ($caterooms as $key => $value)
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="hotel-box" style="position: relative;"
                                                                style="height:100%;"> --}}

                                        <div class="blog-section content-area comon-slick">
                                            <div class="main-title-2">
                                                <h1>Phòng tương tự</h1>
                                            </div>
                                            <div class="slick slider-2 row comon-slick-inner wow fadeInUp delay-04s">
                                                @if (isset($caterooms))
                                                    @if (count($caterooms) > 0)
                                                        @foreach ($caterooms as $key => $value)
                                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                                <div class="hotel-box mx-3" style="position: relative;"
                                                                    style="height:100%;">
                                                                    <?php
                                                                    $user_id = null; // Khởi tạo $user_id bằng null nếu người dùng chưa đăng nhập
                                                                    $isBookmarked = false; // Khởi tạo $isBookmarked bằng false nếu người dùng chưa đăng nhập

                                                                    if (Auth::check()) {
                                                                        $user_id = auth()->user()->id;
                                                                        $isBookmarked = \App\Models\Bookmark::where('user_id', $user_id)
                                                                            ->where('room_post_id', $value->id)
                                                                            ->exists();
                                                                    }
                                                                    $pathD = $isBookmarked ? 'M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9-4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z' : 'M0 48C0 21.5 21.5 0 48 0l0 48V441.4l130.1-92.9c8.3-6 19.6-6 27.9 0L336 441.4V48H48V0H336c26.5 0 48 21.5 48 48V488c0 9-5 17.2-13 21.3s-17.6 3.4-24.9-1.8L192 397.5 37.9 507.5c-7.3 5.2-16.9 5.9-24.9 1.8S0 497 0 488V48z';
                                                                    ?>
                                                                    <button
                                                                        style="position: absolute; top: 15px; right: 15px; z-index: 999; background: none; border: none">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            height="2em"
                                                                            class="{{ $isBookmarked ? 'unbookmark-button' : 'bookmark-button' }}"
                                                                            data-id="{{ $value->id }}"
                                                                            viewBox="0 0 384 512">
                                                                            <style>
                                                                                svg {
                                                                                    fill: #f4a460;
                                                                                }
                                                                            </style>
                                                                            <path d="{{ $pathD }}">
                                                                            </path>
                                                                        </svg>
                                                                    </button>
                                                                    {{-- @endif --}}
                                                                    <div class="photo-thumbnail"
                                                                        style="position: relative; height:50%;">
                                                                        <div class="text-white fw-bolder fs-5"
                                                                            style="position: absolute; bottom:10px ; left: 15px;z-index: 100;">
                                                                            {{ number_format($value->price) }}
                                                                            VND/Tháng
                                                                        </div>
                                                                        @if ($value->service_id != null)
                                                                            @if ($value->service->id === 1)
                                                                                <label
                                                                                    style="text-align: center;color:white;font-weight: 800; background: linear-gradient(45deg, orange, red);position: absolute;top:100px;left:-20px;width:200px;height:30px;z-index:50;padding:2px;border-radius:20%;transform: rotate(-40deg);transform-origin: 0 0;font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe
                                                                                    UI", Roboto, "Helvetica Neue" ,
                                                                                    Arial, "Noto Sans" ,
                                                                                    sans-serif, "Apple Color Emoji"
                                                                                    , "Segoe UI Emoji" , "Segoe UI Symbol"
                                                                                    , "Noto Color Emoji" ;">Phòng
                                                                                    tốt</label>
                                                                            @elseif ($value->service->id === 2)
                                                                                <label
                                                                                    style="text-align: center;color:white;font-weight: 800; background: linear-gradient(45deg, green, yellow);position: absolute;top:100px;left:-20px;width:200px;height:30px;z-index:50;padding:2px;border-radius:20%;transform: rotate(-40deg);transform-origin: 0 0;font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe
                                                                                    UI", Roboto, "Helvetica Neue" ,
                                                                                    Arial, "Noto Sans" ,
                                                                                    sans-serif, "Apple Color Emoji"
                                                                                    , "Segoe UI Emoji" , "Segoe UI Symbol"
                                                                                    , "Noto Color Emoji" ;">Phòng
                                                                                    tốt</label>
                                                                            @else
                                                                                <label
                                                                                    style="text-align: center;color:white;font-weight: 800; background: linear-gradient(45deg, pink, blue);position: absolute;top:100px;left:-20px;width:200px;height:30px;z-index:50;padding:2px;border-radius:20%;transform: rotate(-40deg);transform-origin: 0 0;font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe
                                                                                    UI", Roboto, "Helvetica Neue" ,
                                                                                    Arial, "Noto Sans" ,
                                                                                    sans-serif, "Apple Color Emoji"
                                                                                    , "Segoe UI Emoji" , "Segoe UI Symbol"
                                                                                    , "Noto Color Emoji" ;">Phòng
                                                                                    tốt</label>
                                                                            @endif
                                                                        @endif
                                                                        <div class="photo" style="height: 260px">
                                                                            <img src="{{ asset($value->image) }}"
                                                                                alt="photo"
                                                                                class="img-fluid w-100"
                                                                                style="height: 260px;">
                                                                            <a
                                                                                href="{{ route('room-post-detail', $value->slug) }}">
                                                                                <label class=""
                                                                                    style="cursor: pointer; font-size: 20px;"
                                                                                    for="">Xem Chi Tiết</label>
                                                                            </a>
                                                                        </div>

                                                                    </div>
                                                                    <!-- Detail -->
                                                                    <div class="detail clearfix" style="height: 240px;">
                                                                        <h3>
                                                                            <a style="text-transform: uppercase; font-size:16px;color:{{ $value->service_id ? $value->service->color : '' }}"
                                                                                href="{{ route('room-post-detail', $value->slug) }}"> {!! strlen($value->name) > 50 ? mb_strimwidth(strip_tags($value->name), 0, 50) . '...' : $value->name !!}</a>
                                                                        </h3>
                                                                        <p class="location">
                                                                            <a
                                                                                href="{{ route('room-post-detail', $value->slug) }}">
                                                                                <i class="fa-solid fa-location-dot fa-lg "
                                                                                    style="color: #f46b10;"></i>
                                                                                {{ mb_strimwidth($value->address_full, 0, 50) }}
                                                                            </a>
                                                                        </p>
                                                                        <div class="fecilities row">
                                                                            <ul class="d-flex justify-content-between">
                                                                                <p><span><i
                                                                                            class="fas fa-expand me-2"></i></i>{{ $value->acreage }}
                                                                                        m2</span>
                                                                                </p>
                                                                                <p><i
                                                                                        class="far fa-clock me-2"></i>{{ timeposts($value->created_at) }}
                                                                                </p>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        {{-- {{ $caterooms->links() }} --}}
                                                    @endif
                                                @endif
                                            </div>

                                        </div>


                                        {{-- </div> --}}

                                        <!-- Similar room end -->
                                        <!-- Location start -->
                                        {{-- <div class="row ">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <!-- Location start  -->
                                                <div class="main-title-2">
                                                    <h1>Bản đồ</h1>
                                                </div>
                                                <div class="location w-100 ">
                                                    <div class="map">
                                                        <!-- Main Title 2 -->
                                                        <div id="map" class="contact-map" style="height: 662px;">
                                                            <iframe
                                                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d59615.81210587678!2d105.71104243751117!3d20.95298673967121!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3134532bef4bcdb7%3A0xbcc7a679fcba07f6!2zSMOgIMSQw7RuZywgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1694537835765!5m2!1svi!2s"
                                                                width="100%" height="75%" style="border:0;"
                                                                allowfullscreen="" loading="lazy"
                                                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Location comments end -->
                                            </div>
                                        </div> --}}
                                        <div class="row clearfix tag-share">
                                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                                <!-- Tags box start -->
                                                {{-- <div class="tags-box hidden-mb-10">
                                                    <h4>Tags</h4>
                                                    <ul class="tags">
                                                        <li><a href="#">Rooms</a></li>
                                                        <li><a href="#">Promotion</a></li>
                                                        <li><a href="#">Travel</a></li>
                                                    </ul>
                                                </div> --}}
                                                <div class="sidebar-widget tags-box">
                                                    <div class="main-title-2">
                                                        <h1>Tags</h1>
                                                    </div>
                                                    <ul class="tags">

                                                        @foreach ($roomposts->tags as $tag)
                                                            <li>
                                                                @php
                                                                    $formattedSlug = str_replace('-', ' ', $tag->slug);
                                                                @endphp
                                                                <a
                                                                    href="{{ route('search-filter', ['name_filter' => $formattedSlug]) }}">
                                                                    {{ $tag->name }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>

                                                <!-- Tags box end -->
                                            </div>
                                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                                <!-- Blog Share start -->
                                                <div class="blog-share">
                                                    <h4>Share</h4>
                                                    <ul class="social-list">
                                                        {!! $shareComponent !!}
                                                    </ul>
                                                </div>
                                                <!-- Blog Share end -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Course details section end -->
                                </div>
                            </div>


                            <!-- Rooms description end -->
                        </div>
                        <!-- sidebar end -->
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-xs-12" style="padding-right: 0">
                    <div class="sidebar">
                        <!-- Search area box 3 start -->
                        <div class="sidebar-widget search-area-box-3 clearfix" style="padding: 12px">
                            <div class="contact-details">
                                <div class="row contact-item mb-3 align-items-center">
                                    <div class="col-md-4 mx-auto">
                                        <img src="{{ $roomposts->users->avatar ? asset($roomposts->users->avatar) : asset('fe/img/logos/no-image-user.jpeg') }}"
                                            alt=""style="background-size: contain;  background-repeat: no-repeat; border-radius: 50%; border: 2px solid #a1a1a1; height: 70px; width:70px;">


                                    </div>
                                    <div class="col-md-8">
                                        {{-- <h2> Được đăng bởi </h2> --}}
                                        <h5>{{ $roomposts->fullname }}</h5>

                                    </div>
                                </div>
                                <div class="heading-rooms">
                                    <div class="contact-item mb-3">
                                        <button class="btn btn-primary text-center text-light fs-6 fw-bold w-100"
                                            onclick="showPhoneNumber()">
                                            <i class="fa fa-phone fs-5 mx-2"></i>

                                            <span
                                                class="show-phone">{{ mb_strimwidth($roomposts->phone, 0, 2) . str_repeat('*', strlen($roomposts->phone) - 2) }}</span>

                                            <span style="display: none"
                                                class="hidden-phone">{{ $roomposts->phone }}</span>
                                        </button>
                                        <p>Bấm vào để hiện số điện thoại !</p>
                                    </div>
                                    @if ($roomposts->zalo)
                                        <div class="contact-item mb-3">
                                            <a target="_blank" href="https://zalo.me/{{ $roomposts->zalo }}"
                                                class="btn btn-outline-primary text-center fs-6 fw-bold w-100"
                                                onclick="showPhoneNumber()">
                                                <i class="fa-regular fa-comment-dots fs-5 mx-2"></i>
                                                <span class="show-phone">Chat qua Zalo</span>
                                            </a>
                                        </div>
                                    @endif


                                </div>

                            </div>


                        </div>
                    </div>

                    @include('client.layouts.partials.r-sidebar')
                    <!-- Tag -->


                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Rooms detail section end -->
@endsection
@push('scripts')
    <script>
        function showPhoneNumber() {
            var showPhone = document.querySelector(".show-phone");
            var hiddenPhone = document.querySelector(".hidden-phone");

            showPhone.style.display = "none"; // Ẩn nội dung có lớp show-phone
            hiddenPhone.style.display = "inline"; // Hiển thị nội dung có lớp hidden-phone
        }
    </script>

    <script>
          // Khởi tạo Slider 2
          $('.blog-section .slick').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            dots: true,
            prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
            nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    </script>


@endpush
