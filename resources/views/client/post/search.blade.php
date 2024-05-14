@extends('client/layouts/master')
@section('title', 'Tin tức')
@section('content')
    <!-- Sub banner start -->
    <div class="sub-banner">
        <div class="container">
            <div class="breadcrumb-area">
                <h1>Danh sách bài viết</h1>
            </div>
            <nav class="breadcrumbs">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Danh sách bài viết</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Sub Banner end -->
    <!-- Content -->
    <!-- Blog body start -->
    <div class="blog-body content-area-15">
        <div class="container">
            <div class="row">
                @if ($totalPosts)
                    <h6>Kết quả: {{ $totalPosts }} bài viết</h6>
                @elseif($totalPosts == 0)
                    <h6>Kết quả: Không tìm thấy bài viết!</h6>
                @endif
                <div class="col-lg-8 col-md-12 col-sm-12">
                    @foreach ($posts as $key => $value)
                        <div class="blog-1">
                            <div class="blog-image">
                                <img src="{{ asset($value->image) }}" alt="img-2" class="w-100" height="500px">
                                <div class="profile-user">
                                    <img src="{{ $value->user->avatar? asset($value->user->avatar) : asset('fe/img/logos/no-image-user.jpeg') }}" alt="user">
                                </div>
                                <div class="date-box">
                                    @if (isset($value->created_at))
                                        <span>{{ $value->created_at->format('d') }}
                                        </span>{{ substr($value->created_at->format('F'), 0, 3) }}
                                    @endif
                                </div>
                            </div>
                            <div class="detail">
                                <div class="post-meta clearfix">
                                    <ul>
                                        <li>
                                            <strong><a href="">By: <span
                                                        class="fw-bolder">{{ $value->user->name }}</span></a></strong>
                                        </li>
                                    </ul>
                                </div>
                                <h3>
                                    <a href="{{ route('posts-detail', $value->slug) }}">{{ $value->title }}</a>
                                </h3>
                                <p> {{ $value->metaDescription }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="col-lg-4 col-md-12 col-sm-12">
                    @include('client.layouts.partials.r-sidebar')
                </div>
            </div>
        </div>
    </div>
    <!-- Blog body end -->
@endsection
