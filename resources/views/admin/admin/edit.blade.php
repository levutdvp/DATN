@extends('admin.layouts.master')
@section('title', 'Cập nhật admin')
@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Cập nhật admin</h4>
                            <form action="{{ route('admins.update', $data->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <input type='hidden' value="{{ $data->id }}" name="id">
                                <input type='hidden' value="{{ $data->password }}" name="password">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <div class="d-flex gap-1">
                                                <label for="simpleinput" class="form-label">Họ tên</label>
                                                <svg xmlns="http://www.w3.org/2000/svg" height="0.625em"
                                                    viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                    <style>
                                                        svg {
                                                            fill: #ff0000
                                                        }
                                                    </style>
                                                    <path
                                                        d="M208 32c0-17.7 14.3-32 32-32h32c17.7 0 32 14.3 32 32V172.9l122-70.4c15.3-8.8 34.9-3.6 43.7 11.7l16 27.7c8.8 15.3 3.6 34.9-11.7 43.7L352 256l122 70.4c15.3 8.8 20.5 28.4 11.7 43.7l-16 27.7c-8.8 15.3-28.4 20.6-43.7 11.7L304 339.1V480c0 17.7-14.3 32-32 32H240c-17.7 0-32-14.3-32-32V339.1L86 409.6c-15.3 8.8-34.9 3.6-43.7-11.7l-16-27.7c-8.8-15.3-3.6-34.9 11.7-43.7L160 256 38 185.6c-15.3-8.8-20.5-28.4-11.7-43.7l16-27.7C51.1 98.8 70.7 93.6 86 102.4l122 70.4V32z" />
                                                </svg>
                                            </div>
                                            <input type="text" id="simpleinput" class="form-control" name="name"
                                                placeholder="Họ tên" value="{{ old('name', $data->name ?? '') }}">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex gap-1">
                                                <label for="example-email" class="form-label">Email</label>
                                                <svg xmlns="http://www.w3.org/2000/svg" height="0.625em"
                                                    viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                    <style>
                                                        svg {
                                                            fill: #ff0000
                                                        }
                                                    </style>
                                                    <path
                                                        d="M208 32c0-17.7 14.3-32 32-32h32c17.7 0 32 14.3 32 32V172.9l122-70.4c15.3-8.8 34.9-3.6 43.7 11.7l16 27.7c8.8 15.3 3.6 34.9-11.7 43.7L352 256l122 70.4c15.3 8.8 20.5 28.4 11.7 43.7l-16 27.7c-8.8 15.3-28.4 20.6-43.7 11.7L304 339.1V480c0 17.7-14.3 32-32 32H240c-17.7 0-32-14.3-32-32V339.1L86 409.6c-15.3 8.8-34.9 3.6-43.7-11.7l-16-27.7c-8.8-15.3-3.6-34.9 11.7-43.7L160 256 38 185.6c-15.3-8.8-20.5-28.4-11.7-43.7l16-27.7C51.1 98.8 70.7 93.6 86 102.4l122 70.4V32z" />
                                                </svg>
                                            </div>
                                            <input type="email" id="example-email" name="email" class="form-control"
                                                placeholder="Email" value="{{ old('email', $data->email ?? '') }}">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div> <!-- end col -->

                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="vaitro" class="form-label">Vai trò</label>
                                            <select name="roles" class="form-select" id="vaitro">
                                                <option selected="" disabled="">Chọn vai trò</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        {{ $data->hasRole($role->name) ? 'selected' : '' }}>
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('roles')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <div class="d-flex gap-1">
                                                <label for="simpleinput" class="form-label">SĐT</label>
                                                <svg xmlns="http://www.w3.org/2000/svg" height="0.625em"
                                                    viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                    <style>
                                                        svg {
                                                            fill: #ff0000
                                                        }
                                                    </style>
                                                    <path
                                                        d="M208 32c0-17.7 14.3-32 32-32h32c17.7 0 32 14.3 32 32V172.9l122-70.4c15.3-8.8 34.9-3.6 43.7 11.7l16 27.7c8.8 15.3 3.6 34.9-11.7 43.7L352 256l122 70.4c15.3 8.8 20.5 28.4 11.7 43.7l-16 27.7c-8.8 15.3-28.4 20.6-43.7 11.7L304 339.1V480c0 17.7-14.3 32-32 32H240c-17.7 0-32-14.3-32-32V339.1L86 409.6c-15.3 8.8-34.9 3.6-43.7-11.7l-16-27.7c-8.8-15.3-3.6-34.9 11.7-43.7L160 256 38 185.6c-15.3-8.8-20.5-28.4-11.7-43.7l16-27.7C51.1 98.8 70.7 93.6 86 102.4l122 70.4V32z" />
                                                </svg>
                                            </div>
                                            <input type="text" id="simpleinput" class="form-control" name="phone"
                                                placeholder="Số điện thoại" value="{{ old('phone', $data->phone ?? '') }}">
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">

                                            <div class="d-flex gap-2 row">
                                                <div class="col-12">
                                                    <label for="example-fileinput" class="form-label">Ảnh đại diện</label>
                                                    <input type="file" style="" class="form-control" name="avatar"
                                                        accept="image/*" id="image" value="{{ old('avatar') }}">
                                                </div>
                                                <div class="col-6">
                                                    <img id="image_preview" src="{{ asset('no_image.jpg') }}"
                                                        alt="" width="100px" height="100px"><br>
                                                </div>
                                            </div>

                                            @error('avatar')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>

                                    </div> <!-- end col -->


                                </div>
                                <button class="btn btn-primary waves-effect waves-light">Cập nhật</button>
                                <a href="{{ route('admins.index') }}" class="btn btn-warning waves-effect text-light">Trở
                                    về</a>
                            </form>
                            <!-- end row-->

                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div><!-- end col -->
            </div>

        </div> <!-- container -->

    </div>
@endsection
