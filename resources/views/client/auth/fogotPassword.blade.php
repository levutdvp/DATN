@extends('client.auth.index')
@section('title', 'Quên mật khẩu | Trọ Ơi')
@section('content')
<div class="login-section">
    <div class="container-fluid">
        <div class="row login-box">

            <div class="col-lg-6 bg-color-15 none-992 bg-img">
                <div class="info clearfix">
                    <h1>Chào mừng bạn đến với <span>Trọ ơi</span></h1>
                    <p>Sứ mệnh của chúng tôi là xây dựng một cộng đồng trực tuyến cho những người đang tìm phòng trọ, cho thuê phòng trọ, và chủ nhà. Cộng đồng này có thể giúp họ chia sẻ kinh nghiệm, đánh giá, và thông tin hữu ích về thị trường phòng trọ. </p>
                </div>
            </div>
            <div class="col-lg-6 align-self-center pad-0 form-section">
                <div class="form-inner">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('fe/img/logos/logo.png') }}" alt="" width="300px" />
                    </a>
                    <h3>Nhập email của bạn</h3>
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="form-group clearfix">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn-md btn-theme w-100">Xác nhận</button>
                        </div>
                        <div class="extra-login clearfix">
                            <span>Hoặc đăng nhập với: </span>
                        </div>
                    </form>
                    <div class="clearfix"></div>
                    <div class="social-list">
                        <a href="{{'/auth/google'}}" class="google-bg">
                            <i class="fa fa-google"></i>
                        </a>
                    </div>
                    <p><a href="/client-login">Đăng nhập</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
