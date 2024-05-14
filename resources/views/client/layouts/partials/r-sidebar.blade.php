<div class="sidebar">
    <!-- Top 10 -->
    <div class="sidebar-widget recent-news" style="padding: 12px">
        <div class="main-title-2">
            <h5>Top 10 phòng trọ</h5>
        </div>
        @if (count(room_posts()) > 0)
            @foreach (room_posts() as $key => $post)
                <div class="recent-news-item mb-3">
                    <div class="thumb">
                        <a href="{{ route('room-post-detail', $post->slug) }}">
                            <img src="{{ asset($post->image) }}" alt="small-img" style="width: 80px; height: 80px;">
                        </a>
                    </div>
                    <div class="content">
                        <h5 style="color:{{ $post->service_id ? $post->service->color : '' }}" class="media-heading">
                            <a style="display: -webkit-box;
                            -webkit-line-clamp: 1;
                            -webkit-box-orient: vertical;overflow: hidden;color:{{ $post->service_id ? $post->service->color : '' }}; font-size: 14px; text-transform: uppercase;"
                                href="{{ route('room-post-detail', $post->slug) }}">{{ $post->name }}
                            </a>
                        </h5>
                        <div class="listing-post-meta">
                            {{ number_format($post->price) }}
                            VND/Tháng

                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>Tin đăng phòng trống</p>
        @endif
    </div>

    <!-- Danh mục -->
    <div class="sidebar-widget category-posts">
        <div class="main-title-2">
            <h5>Danh mục phòng</h5>
        </div>
        <ul class="list-unstyled list-cat">
            @if (categories())
                @foreach (categories() as $value)
                    <li><a href="{{ route('search-filter', ['room_type_filter' => $value->id]) }}">{{ $value->name }}<span>({{ $value->room_posts_count }})</span></a>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>

    <!-- Bài viết gần đây -->

    @if (posts())
        @if (count(posts()))
            <div class="sidebar-widget recent-news">
                <div class="main-title-2">
                    <h1>Bài viết gần đây</h1>
                </div>
                @foreach (posts() as $value)
                    <div class="recent-news-item mb-3">
                        <div class="thumb">
                            <a href="#">
                                <img src="{{ asset($value->image) }}" alt="small-img" width="80px" height="80px">
                            </a>
                        </div>
                        <div class="content">
                            <h6 class="text-uppercase" style="font-size: 14px">
                                <a style="display: -webkit-box;
                                -webkit-line-clamp: 1;
                                -webkit-box-orient: vertical;overflow: hidden;"
                                    href="{{ route('posts-detail', $value->slug) }}">{{ $value->title }}
                            </h6>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endif

    @foreach ($global_sidebar_top_ad as $item)
        <div class="social-media sidebar-widget clearfix">
            <a href="{{ $item->url }}">
                <div class="photo-thumbnail p-2">
                    <div class="">
                        @if ($item->image && asset($item->image))
                            <img class="w-100" src="{{ asset($item->image) }}" alt="photo" height="200px">
                        @else
                            <img class=" w-100" src="{{ asset('no_image.jpg') }}" alt="photo" height="200px">
                        @endif
                    </div>
                </div>
            </a>
        </div>
    @endforeach

{{--    @foreach ($global_sidebar_bottom_ad as $item)--}}
{{--        <div class="social-media sidebar-widget clearfix">--}}
{{--            <a href="{{ $item->url }}">--}}
{{--                <div class="photo-thumbnail p-2">--}}
{{--                    <div class="">--}}
{{--                        @if ($item->image && asset($item->image))--}}
{{--                            <img class="w-100" src="{{ asset($item->image) }}" alt="photo" height="200px">--}}
{{--                        @else--}}
{{--                            <img class=" w-100" src="{{ asset('no_image.jpg') }}" alt="photo" height="200px">--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    @endforeach--}}


</div>
