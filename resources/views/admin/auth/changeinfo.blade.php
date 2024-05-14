@extends('admin.layouts.master')
@section('title', 'Cập nhật thông tin')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 col-xl-4">
        <div class="text-center">
            <a href="{{ route('home-admin') }}">
                <img src="{{ asset('fe/img/logos/logo.png') }}" alt="" height="100" class="mx-auto">
            </a>
        </div>
        <div class="card">

            <div class="card-body p-4">

                <div class="text-center mb-4">
                    <h4 class="text-uppercase mt-0">Cập nhật thông tin</h4>
                </div>

                <form action="{{ route('admin-change-info',$data->id) }}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    @method('put')
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Họ Tên</label>
                        <input id="name" placeholder="Họ tên" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $data->name }}"  autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="emailaddress" class="form-label">Số điện thoại</label>
                        <input id="phone" placeholder="Số điện thoại" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $data->phone}}"  autocomplete="name" autofocus>
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Ảnh đại diện</label>
                         <div class="file form-group clearfix d-flex align-items-center gap-3">
                            <div class="mb-3 mt-3" style="text-align:center;">
                                <img src="{{ !$data->avatar==null ?  asset($data->avatar) : 'https://worldapheresis.org/wp-content/uploads/2022/04/360_F_339459697_XAFacNQmwnvJRqe1Fe9VOptPWMUxlZP8.jpeg' }}" style="width: 70px;min-height:70px;height:70px;border-radius:100% ;object-fit: cover;" alt="">
                                <input type="hidden" name='old_avatar' value="{{ $data->avatar }}">
                            </div>
                        <div class="d-flex h-25">
                            <label for="file">
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
                                /* grid-gap: .5em; */
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
                    </div>
                    <div class="mb-3 text-center d-grid">
                        <button class="btn btn-primary" type="submit"> Cập nhật </button>
                    </div>

                </form>

            </div> <!-- end card-body -->
        </div>
        <!-- end card -->
        <!-- end row -->

    </div> <!-- end col -->
</div>
@endsection
