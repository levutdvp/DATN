@extends('client.layouts.master')
@section('content')

    <!-- Content -->

    <div class="sub-banner">
        <div class="container">
            <div class="breadcrumb-area">
                <h1>Tin yêu thích</h1>
            </div>
            <nav class="breadcrumbs">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Tin yêu thích</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Blog body start -->
    <div class="blog-body content-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-12 col-sm-12 d-flex flex-column">

                    <div class="row wow fadeInUp delay-04s">


                        @if (isset($data))
                            @if (count($data) > 0)
                                @foreach ($data as $key => $value)
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="hotel-box " style="position: relative;">
                                            {{-- <form action="{{ route('unbookmarkbm', $value->id) }}" method="post">
                                                @csrf
                                                @method('delete') --}}
                                            <button
                                                style="position: absolute; top: 15px; right: 15px; z-index: 999; background: none; border: none">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="2em"
                                                    data-id="{{ $value->id }}" class="unbookmarkbtn"
                                                    viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                    <style>
                                                        svg {
                                                            fill: #f3a35f
                                                        }
                                                    </style>
                                                    <path
                                                        d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                                                </svg>
                                            </button>
                                            {{-- </form> --}}
                                            <!-- Photo thumbnail -->
                                            <div class="photo-thumbnail" style="position: relative;">
                                                <div class="text-white"
                                                    style="position: absolute; bottom:10px ; left: 15px;z-index: 100;">
                                                    {{ number_format($value->roomPost->price) }} VND/Tháng
                                                </div>
                                                <div class="photo" style="position: relative">
                                                    @if ($value->roomPost->service_id != null)
                                                        @if ($value->roomPost->service->id === 1)
                                                            <label
                                                                style="text-align: center;color:white;font-weight: 800; background: linear-gradient(45deg, orange, red);position: absolute;top:100px;left:-40px;width:220px;height:30px;z-index:50;padding:2px;border-radius:20%;transform: rotate(-40deg);transform-origin: 0 0;font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe
                                                                UI", Roboto, "Helvetica Neue" , Arial, "Noto Sans" ,
                                                                sans-serif, "Apple Color Emoji" , "Segoe UI Emoji"
                                                                , "Segoe UI Symbol" , "Noto Color Emoji" ;">Phòng
                                                                tốt</label>
                                                        @elseif ($value->roomPost->service->id === 2)
                                                            <label
                                                                style="text-align: center;color:white;font-weight: 800; background: linear-gradient(45deg, green, yellow);position: absolute;top:100px;left:-40px;width:220px;height:30px;z-index:50;padding:2px;border-radius:20%;transform: rotate(-40deg);transform-origin: 0 0;font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe
                                                                UI", Roboto, "Helvetica Neue" , Arial, "Noto Sans" ,
                                                                sans-serif, "Apple Color Emoji" , "Segoe UI Emoji"
                                                                , "Segoe UI Symbol" , "Noto Color Emoji" ;">Phòng
                                                                tốt</label>
                                                        @else
                                                            <label
                                                                style="text-align: center;color:white;font-weight: 800; background: linear-gradient(45deg, pink, blue);position: absolute;top:100px;left:-40px;width:220px;height:30px;z-index:50;padding:2px;border-radius:20%;transform: rotate(-40deg);transform-origin: 0 0;font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe
                                                                UI", Roboto, "Helvetica Neue" , Arial, "Noto Sans" ,
                                                                sans-serif, "Apple Color Emoji" , "Segoe UI Emoji"
                                                                , "Segoe UI Symbol" , "Noto Color Emoji" ;">Phòng
                                                                tốt</label>
                                                        @endif
                                                    @endif
                                                    <img src="{{ $value->roomPost->image }}" style="height: 300px"
                                                        alt="photo" class="img-fluid w-100">
                                                    <a href="{{ route('room-post-detail', $value->roomPost->id) }}">
                                                        <label class="" style="cursor: pointer; font-size: 20px;"
                                                            for="">Xem Chi Tiết</label>
                                                    </a>
                                                </div>

                                            </div>
                                            <!-- Detail -->
                                            <div style="height: 240px" class="detail clearfix">
                                                <h3>
                                                    <a style="color:{{ $value->roomPost->service_id ? $value->roomPost->service->color : '' }}"
                                                        href="{{ route('room-post-detail', $value->roomPost->id) }}">{!! strlen($value->roomPost->name) > 50 ? substr(strip_tags($value->roomPost->name), 0, 50) . '...' : $value->roomPost->name !!}</a>
                                                </h3>
                                                
                                                <p class="location">
                                                    <a href="rooms-details.html">
                                                        <i class="fa fa-map-marker"></i>{{ $value->roomPost->address_full }}
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <h2>Bạn chưa lưu tin!</h2>
                            @endif
                        @endif
                    </div>

                    <!-- Blog box end -->

                    <!-- Phân trang -->
                    {{ $data->links() }}
                    <!-- End phân trang -->
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12">
                    {{-- <div class="sidebar">
                        <!-- Top 10 -->
                        @if ($room_posts)
                            @if (count($room_posts))
                                <div class="sidebar-widget recent-news">
                                    <div class="main-title-2">
                                        <h1>Top 10 phòng trọ</h1>
                                    </div>
                                    @foreach ($room_posts as $key => $post)
                                        <div class="recent-news-item mb-3">
                                            <div class="thumb">
                                                <a href="#">
                                                    <img src="{{ $post->image }}" alt="small-img">
                                                </a>
                                            </div>
                                            <div class="content">
                                                <h3 class="media-heading">
                                                    <a href="rooms-details.html">{{ $post->name }}</a>
                                                </h3>
                                                <div class="listing-post-meta">
                                                    {{ $post->price }}
                                                </div>
                                                <div>
                                                    @if (count($post->facilities) > 0)
                                                        <ul class="row facilities-list clearfix">
                                                            @foreach ($post->facilities as $value)
                                                                <li class="col-2">
                                                                    <i class="flaticon-bed"></i>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                        @endif


                        <!-- Danh mục -->
                        <div class="sidebar-widget category-posts">
                            <div class="main-title-2">
                                <h1>Danh mục phòng</h1>
                            </div>
                            <ul class="list-unstyled list-cat">
                                @if ($categories)
                                    @foreach ($categories as $value)
                                        <li><a
                                                href="#">{{ $value->name }}<span>({{ $value->room_posts_count }})</span></a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                        <!-- Bài viết gần đây -->

                        @if ($posts)
                            @if (count($posts))
                                <div class="sidebar-widget recent-news">
                                    <div class="main-title-2">
                                        <h1>Bài viết gần đây</h1>
                                    </div>
                                    @foreach ($posts as $value)
                                        <div class="recent-news-item mb-3">
                                            <div class="thumb">
                                                <a href="#">
                                                    <img src="{{ $value->image }}" alt="small-img">
                                                </a>
                                            </div>
                                            <div class="content">
                                                <h3 class="media-heading">
                                                    <a href="rooms-details.html">{{ $value->title }}</a>
                                                </h3>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @endif


                        <!-- Tag -->
                        <div class="sidebar-widget tags-box">
                            <div class="main-title-2">
                                <h1>Tags</h1>
                            </div>
                            <ul class="tags">
                                <li><a href="#">Gần trường</a></li>
                                <li><a href="#">Khuyến mãi</a></li>
                                <li><a href="#">View đẹp</a></li>
                                <li><a href="#">Chung cư</a></li>
                                <li><a href="#">Nhà trọ</a></li>
                                <li><a href="#">Nam Từ Liêm</a></li>
                                <li><a href="#">Đống Đa</a></li>
                                <li><a href="#">Hồ Tây</a></li>
                            </ul>
                        </div>
                        <!-- Truyền thông -->
                        <div class="social-media sidebar-widget clearfix">
                            <div class="main-title-2">
                                <h1>Truyền thông</h1>
                            </div>
                            <ul class="social-list">
                                <li><a href="#" class="facebook-bg"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#" class="twitter-bg"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" class="linkedin-bg"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#" class="google-bg"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#" class="rss-bg"><i class="fa fa-rss"></i></a></li>
                            </ul>
                        </div>
                    </div> --}}
                    @include('client.layouts.partials.r-sidebar')
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('.unbookmarkbtn').on('click', function() {
            let button = $(this);
            let id = button.data('id');
            let divToDelete = button.closest('.hotel-box');
            $.ajax({
                url: '{{ route('unbookmarkbm', ['id' => 'id']) }}', // Sử dụng id thay vì 'id'
                method: 'DELETE',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    $('#bookmarkQty').text(response.bm);
                    divToDelete.remove();
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
    });
</script>

@endpush
