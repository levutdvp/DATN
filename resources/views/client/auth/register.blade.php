@extends('client.auth.index')
@section('title', 'Đăng ký | Trọ Ơi')
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
                <div class="form-section" style="width:100%">
                    <div class="form-inner">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('fe/img/logos/logo.png') }}" alt="" width="300px" />
                        </a>
                        <h3>Tạo mới tài khoản</h3>
                        <form method="POST" name="register" action="{{ route('register') }}" onsubmit="return ValidateRegister()" enctype="multipart/form-data" ">
                            @csrf
                            <div class="form-group clearfix">
                                <input
                                id="name" placeholder="Họ tên" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus
                                />
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group clearfix">
                                <input
                                id="name" placeholder="Số điện thoại" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"  autocomplete="name" autofocus
                                />
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group clearfix">
                                <input
                                id="email" type="email" placeholder="Địa chỉ email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email"
                                />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group clearfix">
                                <input id="password" type="password" placeholder="Mật khẩu" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="form-group clearfix">
                                <input id="password-confirm" type="password" placeholder="Xác nhận mật khẩu" class="form-control" name="password_confirmation"  autocomplete="new-password">
                            </div>
                            <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
                                crossorigin="anonymous"></script>
                            <script>
                            $(() => {
                                function readURL(input) {
                                    if (input.files && input.files[0]) {
                                        var reader = new FileReader();
                                        reader.onload = function(e) {
                                            $('#show-image').attr('src', e.target.result);
                                        };
                                        reader.readAsDataURL(input.files[0]);
                                    }
                                }

                                $("#file").change(function() {
                                    readURL(this);
                                });
                            });
                            </script>
                            <script>
                                dselect(document.querySelector('#dselect-example'))
                            </script>
                            <div class="form-group clearfix">
                                <button type="submit" onclick="ValidateRegister()" class="btn-md btn-theme w-100">
                                    Đăng ký
                                </button>
                            </div>
                            <div class="extra-login clearfix">
                                <span>Đăng nhập với</span>
                            </div>
                        </form>
                        <div class="clearfix"></div>
                        <div class="social-list">
                            <a href="{{'/auth/google'}}" class="google-bg">
                                <i class="fa fa-google"></i>
                            </a>
                        </div>
                        <p>
                            Bạn đã có tài khoản ?
                            <a href="/client-login"
                            ><span class="text-sub">Đăng nhập</span></a
                            >
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function ValidateRegister(){
        let flag= true;
        let dataPhone =document.querySelector(('#phone').value)
        if(dataPhone.trim()===''){
            flag=false;
            document.querySelector('#error_phone').innerHTML='KH BỎ TRỐNG'
        }
        return flag;
    }
</script>
@endsection
