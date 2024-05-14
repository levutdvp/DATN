
@extends('client.layouts.master')
@section('title', 'Cập nhật thông tin tài khoản | Trọ Ơi')
@section('content')
<div class="login-section">
    <div class="container-fluid">
        <div class="row login-box" style="width:100%;display:flex;justify-content: center;margin-bottom:20px">
            <div class="col-lg-6 bg-color-15 none-992 bg-img1" style="width:40%;"">
                <div class="info clearfix">
                    <h1><span>Cập nhật thông tin</span></h1>
                    <p>Sứ mệnh của chúng tôi là xây dựng một cộng đồng trực tuyến cho những người đang tìm phòng trọ, cho thuê phòng trọ, và chủ nhà. Cộng đồng này có thể giúp họ chia sẻ kinh nghiệm, đánh giá, và thông tin hữu ích về thị trường phòng trọ. </p>
                </div>
            </div>
            <div class="col-lg-6 align-self-center pad-0 form-section" style="width:40%;"">
                <div class="form-section" style="width:100%">
                    <div class="form-inner">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('fe/img/logos/logo.png') }}" alt="" width="300px" />
                        </a>
                        <h3>Cập nhật thông tin</h3>
                        <form method="POST" name="register" action="{{ route('changeinfo.update',$data->id) }}" enctype="multipart/form-data" >
                            @csrf
                            @method('put')
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <div class="form-group clearfix">
                                <input
                                id="name" placeholder="Họ tên" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $data->name }}"  autocomplete="name" autofocus
                                />
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group clearfix">
                                <input
                                id="phone" placeholder="Số điện thoại" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $data->phone}}"  autocomplete="name" autofocus
                                />
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="file form-group clearfix d-flex align-items-center gap-5">
                                    <div class="mb-3 mt-3" style="text-align:center;">
                                        <img src='{{ !$data->avatar==null ?  asset($data->avatar) : asset('fe/img/logos/no-image-user.jpeg') }}' style="width: 70px;min-height:70px;height:70px;border-radius:100% ;object-fit: cover;" alt="">
                                        <input type="hidden" name='old_avatar' value="{{ $data->avatar }}">
                                    </div>
                                <div class="d-flex h-25">
                                    <label for="file">Chọn ảnh đại diện mới
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M288 109.3V352c0 17.7-14.3 32-32 32s-32-14.3-32-32V109.3l-73.4 73.4c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l128-128c12.5-12.5 32.8-12.5 45.3 0l128 128c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L288 109.3zM64 352H192c0 35.3 28.7 64 64 64s64-28.7 64-64H448c35.3 0 64 28.7 64 64v32c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V416c0-35.3 28.7-64 64-64zM432 456a24 24 0 1 0 0-48 24 24 0 1 0 0 48z"/></svg>
                                    </label>
                                    <div class="d-flex align-items-center gap-5">
                                        <input id="file" type="file" class="form-control mr-2 @error('avatar') is-invalid @enderror" name="new_avatar" value="{{ old('avatar') }}"  autocomplete="email"/>
                                        @error('avatar')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 mt-3" style="text-align:center;">
                                    <img src="" style="width: 70px;min-height:70px;border-radius:100% ;     object-fit: cover;"
                                        id="show-image" alt="">
                                </div>
                                <style>
                                    input[type=file] { display: none; }
                                    label[for=file] {
                                        display: grid;
                                        grid-auto-flow: column;
                                        grid-gap: .5em;
                                        justify-items: center;
                                        align-content: center;
                                        padding: .85em 1.5em;
                                        border-radius: 2em;
                                        border: .2px solid gainsboro;
                                        transition: 1s;
                                        &:hover, &:focus, &:active {
                                            background: #F4A460;
                                            color:black;
                                        }
                                    }
                                </style>
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
                                    Thay đổi
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
