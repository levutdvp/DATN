@extends('admin.layouts.master')
@section('title')
    Thêm danh mục bài viết
@endsection
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="my-2 text-center">Thêm danh mục bài viết</h3>
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="{{ route('category-posts.store') }}" method="POST">
                                    @csrf
                                    @method('post')
                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">Tên<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="name" id="simpleinput"
                                            class="form-control" placeholder="Tên" value="{{ old('name') }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-textarea" class="form-label">Mô tả<span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" name="description" id="description" rows="5">{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <button class="btn btn-primary waves-effect waves-light">Thêm</button>
                                    <a href="{{ route('category-posts.index') }}" class="btn btn-warning waves-effect text-light">Trở
                                        về</a>


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
    <script>
        CKEDITOR.replace('description', {
            filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
            filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
            filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
            filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
            filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
            filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
        });
    </script>
@endpush
