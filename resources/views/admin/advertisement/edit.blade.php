@extends('admin.layouts.master')
@section('title', 'Sửa ảnh quảng cáo')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="my-2">Cập nhật ảnh quảng cáo</h3>
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="{{ route('advertisements.update', $data->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="mb-3">
                                        <label>Vị trí hiển thị</label>
                                        <select name="location" class="form-control">
                                            <option value="top"
                                                {{ old('location', $data->location) == 'top' ? 'selected' : '' }}>Top
                                            </option>
                                            <option value="bottom"
                                                {{ old('location', $data->location) == 'bottom' ? 'selected' : '' }}>Bottom
                                            </option>
                                        </select>
                                        @error('location')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-palaceholder" class="form-label">Đường dẫn</label>
                                        <input type="text" name="url" id="example-palaceholder" class="form-control"
                                            value="{{ old('url', $data->url ?? '') }}">
                                        @error('url')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-textarea" class="form-label">Ảnh</label>
                                        <input id="image" type="file" class="form-control" name="image"
                                            accept="image/*"><br>
                                        @if ($data->image && asset($data->image))
                                            <img id="image_preview" src="{{ asset($data->image) }}" alt=""
                                                width="100px" height="100px">
                                        @else
                                            <img id="image_preview" src="{{ asset('no_image.jpg') }}" alt=""
                                                width="100px" height="100px"><br>
                                        @endif
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button class="btn btn-primary waves-effect waves-light">Cập nhật</button>
                                    <a href="{{ route('advertisements.index') }}"
                                        class="btn btn-warning waves-effect text-light">Trở về</a>
                                </form>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row-->
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div><!-- end col -->
        </div>
        <!-- end row -->
    </div> <!-- container -->
@endsection
