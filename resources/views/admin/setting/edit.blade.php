@extends('admin.layouts.master')
@section('title', 'Setting')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Cài đặt</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="{{ route('settings.update', $data) }}" enctype="multipart/form-data"
                                    method="post">
                                    @csrf
                                    @method('put')
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Logo</label>
                                        <input id="image" type="file" class="form-control" name="logo"
                                            accept="image/*"><br>
                                        @if ($data->logo && asset($data->logo))
                                            <img id="image_preview" src="{{ asset($data->logo) }}" alt=""
                                                width="100px" height="100px">
                                        @else
                                            <img id="image_preview" src="{{ asset('no_image.jpg') }}" alt=""
                                                width="100px" height="100px">
                                        @endif
                                        @error('logo')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Favicon</label>
                                        <input id="image-favi" type="file" class="form-control" name="favicon"
                                            accept="image/*"><br>
                                        @if ($data->favicon && asset($data->favicon))
                                            <img id="image_preview_favi" src="{{ asset($data->favicon) }}" alt=""
                                                width="100px" height="100px">
                                        @else
                                            <img id="image_preview_favi" src="{{ asset('no_image.jpg') }}" alt=""
                                                width="100px" height="100px">
                                        @endif
                                        @error('favicon')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-email" class="form-label">Điện thoại hỗ trợ</label>
                                        <input type="text" name="support_phone" class="form-control"
                                            value="{{ old('support_phone', $data->support_phone ?? '') }}">
                                        @error('support_phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-palaceholder" class="form-label">Email</label>
                                        <input type="email" name="email" id="example-palaceholder" class="form-control"
                                            value="{{ old('email', $data->email ?? '') }}">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-palaceholder" class="form-label">Địa chỉ</label>
                                        <input type="text" name="address" id="example-palaceholder" class="form-control"
                                            value="{{ old('address', $data->address ?? '') }}">
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-palaceholder" class="form-label">Meta title</label>
                                        <input type="text" name="meta_title" id="example-palaceholder"
                                            class="form-control" value="{{ old('meta_title', $data->meta_title ?? '') }}">
                                        @error('meta_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-palaceholder" class="form-label">Meta author</label>
                                        <input type="text" name="meta_author" id="example-palaceholder"
                                            class="form-control"
                                            value="{{ old('meta_author', $data->meta_author ?? '') }}">
                                        @error('meta_author')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-palaceholder" class="form-label">Meta description</label>
                                        <input type="text" name="meta_description" id="example-palaceholder"
                                            class="form-control"
                                            value="{{ old('meta_description', $data->meta_description ?? '') }}">
                                        @error('meta_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-palaceholder" class="form-label">Meta keyword</label>
                                        <input type="text" name="meta_keyword" id="example-palaceholder"
                                            class="form-control"
                                            value="{{ old('meta_keyword', $data->meta_keyword ?? '') }}">
                                        @error('meta_keyword')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-email" class="form-label">Google analytic</label>
                                        <input type="text" name="analytic" class="form-control"
                                            value="{{ old('analytic', $data->analytic ?? '') }}">
                                        @error('analytic')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Cập
                                        nhật</button>
                                </form>

                            </div> <!-- end col -->

                        </div>
                        <!-- end row-->

                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div><!-- end col -->
        </div>
        <!-- end row -->
        <!-- Start Content-->


    </div> <!-- container -->
    </div> <!-- container -->
@endsection
