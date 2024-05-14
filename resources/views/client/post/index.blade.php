@extends('client/layouts/master')
@section('title', 'Tin tức')
@section('content')
    <!-- Sub banner start -->
    <div class="sub-banner">
        <div class="container">
            <div class="breadcrumb-area">
                <h1>Danh sách bài viết</h1>
            </div>
            <nav class="breadcrumbs">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Danh sách bài viết</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Sub Banner end -->
    <!-- Content -->
    <!-- Blog body start -->
    <div class="pt-4 blog-body content-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <!-- Blog box start -->
                    @if (isset($data))
                        @if (count($data) > 0)
                            @foreach ($data as $key => $value)
                                <div class="blog-1">
                                    <div class="blog-image">
                                        <div>
                                            <img src="{{ $value->image }}" alt="Ảnh tin tức" class="img-fluid w-100"
                                                style="height: 500px;">
                                        </div>

                                        <div class="profile-user">
                                            <img src="{{ $value->user->avatar ? $value->user->avatar :  asset('fe/img/logos/no-image-user.jpeg')  }}"
                                                alt="user">
                                        </div>
                                        <div class="date-box" style="width: 116px;height: 44px">
                                            <span>{{ $value->updated_at->format('Y-m-d') }}</span>
                                        </div>
                                    </div>
                                    <div class="detail">
                                        <div class="post-meta clearfix">
                                            <ul>
                                                <li>
                                                    <strong><a href="#">{{ $value->user->name }}</a></strong>
                                                </li>

                                                <li class="float-right"><a href="#"><i
                                                            class="fa fa-eye"></i></a>{{ number_format($value->view) }}</li>
                                            </ul>
                                        </div>
                                        <h3>
                                            <a class="fs-6 text-uppercase"
                                                href="{{ route('posts-detail', $value->slug) }}">{{ $value->metaTitle }}</a>
                                        </h3>
                                        <p>{{ $value->metaDescription }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endif
                    <!-- Blog box end -->

                    <!-- Phân trang -->
                    {{ $data->links() }}
                    <!-- End phân trang -->
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    @include('client.layouts.partials.r-sidebar')
                </div>
            </div>
        </div>
        <!-- Blog body end -->

    @endsection
