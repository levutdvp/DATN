@extends('client.layouts.master')
@section('content')
    <!-- Blog body start -->
    <div class="blog-body">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-12 col-sm-12" style="max-height: 100%;">
                    <div class="sidebar" style="height: 100%;">

                        <!-- Archives start -->
                        <div class="sidebar-widget archives">
                            <div class="main-title-2">
                                <h1>Quản lý</h1>
                            </div>
                            <ul class="list-unstyled">
                                <li class="{{ Request::is('room-posts/') ? 'active' : '' }}"><i
                                        class="fas fa-newspaper px-2"></i><a href="{{ route('room-posts.index') }}">Quản lý
                                        tin đăng</a></li>
                                <li class="{{ Request::is('room-posts/create') ? 'active' : '' }}"><i
                                        class="fas fa-edit px-2"></i><a href="{{ route('room-posts.create') }}">Đăng tin
                                        mới</a></li>
                                <li class="{{ Request::is('points-history') ? 'active' : '' }}"><i
                                        class="fas fa-list-alt px-2"></i><a href="{{ route('points.history') }}">Lịch sử
                                        giao
                                        dịch</a></li>
                              
                                <li class="{{ Request::is('room-posts-deleted') ? 'active' : '' }}"><i
                                        class="fas fa-trash px-2"></i><a href="{{ route('room-posts-deleted') }}">Thùng
                                        rác</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-lg-10 col-md-12 col-sm-12">
                    {{-- <div class="container"> --}}
                    @yield('main')
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
