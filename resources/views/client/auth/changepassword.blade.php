@extends('client.layouts.master')
@section('title', 'Cập nhật mật khẩu | Trọ Ơi')
@section('content')
<div class="login-section">
    <div class="container-fluid">
        <div class="row login-box" style="width:100%;display:flex;justify-content: center;margin-bottom:20px">
            <div class="col-lg-6 bg-color-15 none-992 bg-img1" style="width:40%;">
                <div class="info clearfix">
                    <h1> <span>Cập nhật mật khẩu</span></h1>
                    <p>Sứ mệnh của chúng tôi là xây dựng một cộng đồng trực tuyến cho những người đang tìm phòng trọ, cho thuê phòng trọ, và chủ nhà. Cộng đồng này có thể giúp họ chia sẻ kinh nghiệm, đánh giá, và thông tin hữu ích về thị trường phòng trọ. </p>
                </div>
            </div>
            <div class="col-lg-6 align-self-center pad-0 form-section" style="width:40%;">
                <div class="form-section" style="width:100%">
                            <div class="form-inner">
                                <a href="{{ route('home') }}">
                                    <img src="{{ asset('fe/img/logos/logo.png') }}" alt="" width="300px" />
                                </a>
                                <h3>Cập nhật mật khẩu</h3>
                                <form method="POST" name="register" action="{{ route('changepassword.update',auth()->user()->id) }}" onsubmit="return ValidateRegister()" enctype="multipart/form-data" ">
                                    @csrf
                                    @method('put')
                                    <div class="form-group clearfix">
                                        <input id="password" type="password" placeholder="Mật khẩu hiện tại" class="form-control @error('old_password') is-invalid @enderror" name="old_password"  autocomplete="new-password">
                                        @error('old_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group clearfix">
                                        <input id="password" type="password" placeholder="Mật khẩu mới" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group clearfix">
                                        <input id="password_confirmation" type="password" placeholder="Xác nhận mật khẩu" class="form-control" name="password_confirmation"  autocomplete="new-password">
                                    </div>
                                    <div class="form-group clearfix">
                                        <button type="submit" onclick="ValidateRegister()" class="btn-md btn-theme w-100">
                                            Cập nhật
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
            </div>
        </div>
    </div>
</div>
@endsection
