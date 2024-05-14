@extends('admin.layouts.master')
@section('title')
    Cập nhật banner
@endsection
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="my-2">Cập nhật banner</h3>
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="{{ route('banners.update', $data->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">Tên tiêu đề</label>
                                        <input type="text" name="title" id="simpleinput" class="form-control"
                                            value="{{ old('title', $data->title ?? '') }}">
                                        @error('title')
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
                                        <label for="example-textarea" class="form-label">Mô tả</label>
                                        <textarea class="form-control" name="description" id="description" rows="5">{{ old('description', $data->description ?? '') }}</textarea>
                                        @error('description')
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
                                    <a href="{{ route('banners.index') }}"
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
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
@endpush
