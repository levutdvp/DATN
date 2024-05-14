@extends('admin.layouts.master')
@section('title', 'Cập nhật thông tin người dùng')
@section('content')
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Cập nhật thông tin người dùng</h4>
                        <form action="{{ route('users.update',$data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                          
                            <input type='hidden'  value="{{ $data->password }}" name="password">
                        <div class="row">
                            @if ($errors->any())
                            <p class=" alert alert-danger">
                                Dữ liệu không hợp lệ vui lòng kiểm tra lại
                            </p>
                            @endif
                            <div class="col-lg-6">

                                    <div class="mb-3">
                                        <div class="d-flex gap-1">
                                            <label for="simpleinput" class="form-label">Họ tên</label>
                                            <svg xmlns="http://www.w3.org/2000/svg" height="0.625em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ff0000}</style><path d="M208 32c0-17.7 14.3-32 32-32h32c17.7 0 32 14.3 32 32V172.9l122-70.4c15.3-8.8 34.9-3.6 43.7 11.7l16 27.7c8.8 15.3 3.6 34.9-11.7 43.7L352 256l122 70.4c15.3 8.8 20.5 28.4 11.7 43.7l-16 27.7c-8.8 15.3-28.4 20.6-43.7 11.7L304 339.1V480c0 17.7-14.3 32-32 32H240c-17.7 0-32-14.3-32-32V339.1L86 409.6c-15.3 8.8-34.9 3.6-43.7-11.7l-16-27.7c-8.8-15.3-3.6-34.9 11.7-43.7L160 256 38 185.6c-15.3-8.8-20.5-28.4-11.7-43.7l16-27.7C51.1 98.8 70.7 93.6 86 102.4l122 70.4V32z"/></svg>
                                        </div>
                                        <input type="text" id="simpleinput" class="form-control" name="name" value="{{ $data->name }}" placeholder="Họ tên">
                                    </div>
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                    <div class="mb-3">
                                        <div class="d-flex gap-1">
                                            <label for="simpleinput" class="form-label">Email</label>
                                            <svg xmlns="http://www.w3.org/2000/svg" height="0.625em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ff0000}</style><path d="M208 32c0-17.7 14.3-32 32-32h32c17.7 0 32 14.3 32 32V172.9l122-70.4c15.3-8.8 34.9-3.6 43.7 11.7l16 27.7c8.8 15.3 3.6 34.9-11.7 43.7L352 256l122 70.4c15.3 8.8 20.5 28.4 11.7 43.7l-16 27.7c-8.8 15.3-28.4 20.6-43.7 11.7L304 339.1V480c0 17.7-14.3 32-32 32H240c-17.7 0-32-14.3-32-32V339.1L86 409.6c-15.3 8.8-34.9 3.6-43.7-11.7l-16-27.7c-8.8-15.3-3.6-34.9 11.7-43.7L160 256 38 185.6c-15.3-8.8-20.5-28.4-11.7-43.7l16-27.7C51.1 98.8 70.7 93.6 86 102.4l122 70.4V32z"/></svg>
                                        </div>
                                        <input type="email" id="example-email" name="email" class="form-control" placeholder="Email" value="{{ $data->email }}" >
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    </div>

                                    <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Cập nhật ảnh đại diện</label>
                                        <input type="file"  class="form-control" accept="image/*" id="image-input" name="new_avatar">
                                    </div>
                                @if ($data->avatar)
                                <input type="text" value="{{ $data->avatar }}" name="old_avatar" hidden>
                                <div class="mb-3">
                                    <img style="width:80px;height:80px;border-radius:50%"   id="show-image" src="{{ asset($data->avatar) }}" alt="">
                                    @error('avatar')
                                    <span class="text-danger">{{ $message }}</span>
                            @enderror
                                </div>
                                @endif

                            </div> <!-- end col -->

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Quyền</label>
                                    <select class="form-select" id="role_id" name="role">
                                        <option value="vendor" {{ $data->role === 'vendor' ? 'selected' : '' }}>Vendor</option>
                                        <option value="admin" {{ $data->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                      </select>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex gap-1">
                                        <label for="simpleinput" class="form-label">Số điện thoại</label>
                                        <svg xmlns="http://www.w3.org/2000/svg" height="0.625em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ff0000}</style><path d="M208 32c0-17.7 14.3-32 32-32h32c17.7 0 32 14.3 32 32V172.9l122-70.4c15.3-8.8 34.9-3.6 43.7 11.7l16 27.7c8.8 15.3 3.6 34.9-11.7 43.7L352 256l122 70.4c15.3 8.8 20.5 28.4 11.7 43.7l-16 27.7c-8.8 15.3-28.4 20.6-43.7 11.7L304 339.1V480c0 17.7-14.3 32-32 32H240c-17.7 0-32-14.3-32-32V339.1L86 409.6c-15.3 8.8-34.9 3.6-43.7-11.7l-16-27.7c-8.8-15.3-3.6-34.9 11.7-43.7L160 256 38 185.6c-15.3-8.8-20.5-28.4-11.7-43.7l16-27.7C51.1 98.8 70.7 93.6 86 102.4l122 70.4V32z"/></svg>
                                    </div>
                                    <input type="text" id="simpleinput" class="form-control" name="phone" value="{{ $data->phone }}" placeholder="Số điện thoại">
                                    @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                            </div> <!-- end col -->


                        </div>
                        <button class="btn btn-primary waves-effect waves-light">Cập nhật</button>
                        <a href="{{ route('users.index') }}"
                            class="btn btn-warning waves-effect text-light">Trở về</a>
                    </form>
                        <!-- end row-->

                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div><!-- end col -->
        </div>

    </div> <!-- container -->

</div>
@endsection
@push('scripts')
    <!-- Page level plugins -->
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

            $("#image-input").change(function() {
                readURL(this);
            });



        });
    </script>
@endpush
