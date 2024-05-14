@extends('client/layouts/master')
@section('title', 'Chi tiết bài viết')
@section('content')
    <!-- Sub banner start -->
    <div class="sub-banner">
        <div class="container">
            <div class="breadcrumb-area">
                <h1>Chi tiết bài viết</h1>
            </div>
            <nav class="breadcrumbs">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Chi tiết bài viết</li>
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
            <div class="col-lg-8 col-md-12 col-sm-12">
                @if (isset($data))
                    <div class="blog-1 blog-big mb-50">
                        <div class="blog-image">
                            <img src="{{asset($data->image) }}" alt="Ảnh tin tức" class="img-fluid w-100" style="height: 500px;">
                            <div class="profile-user">
                                <img src="{{ $data->user->avatar? asset($data->user->avatar) : asset('fe/img/logos/no-image-user.jpeg') }}" alt="user">
                            </div>
                            <div class="date-box" style="width: 116px;height: 45px">
                                <span>{{ $data->updated_at->format('Y-m-d') }}</span>
                            </div>
                        </div>
                        <div class="detail">
                            <div class="post-meta clearfix">
                                <ul>
                                    <li>
                                        <strong><a href="#">By: {{ $data->user->name }}</a></strong>
                                    </li>
                                    <li class="float-right"><a href="#"><i class="fa fa-eye"></i></a>{{ number_format($data->view) }}</li>
                                </ul>
                            </div>
                            <h3>
                                <a href="#">{{ $data->metaTitle }}</a>
                            </h3>
                            <blockquote>
                                {{ $data->metaDescription }}
                            </blockquote>
                           <br>

                            <div class="row mb-30">
                                <div class=" col-xs-12">
                                    <p>{!! $data->description !!}</p>
                                </div>
                            </div>
                           <div class="row clearfix tag-shere">
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                    <!-- Tags box start -->
                                    <div class="tags-box hidden-mb-10">
                                        <h2>Tags</h2>
                                        <ul class="tags">
                                            @foreach ($postTags as $item)
                                                <li><a href="{{route('tags-show', $item->slug)}}">{{ $item->name }}</a></li>
                                            @endforeach

                                            {{-- @foreach ($postTags as $tag)
                                            <li>
                                                @php
                                                    $formattedSlug = str_replace('-', ' ', $tag->slug);
                                                @endphp
                                                <a href="{{ route('search-filter', ['name_filter' => $formattedSlug]) }}">
                                                    {{ $tag->name }}
                                                </a>
                                            </li>
                                        @endforeach --}}
                                        </ul>
                                    </div>
                                @endif

                                <!-- Tags box end -->
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                <!-- Blog Share start -->
                                <div class="blog-share">
                                    <h2>Share</h2>
                                    <ul class="social-list">
                                        {!! $shareComponent !!}
                                    </ul>
                                </div>
                                <!-- Blog Share end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 col-sm-12">
                @include('client.layouts.partials.r-sidebar')
            </div>
        </div>
    </div>
</div>
<!-- Blog body end -->
@endsection
