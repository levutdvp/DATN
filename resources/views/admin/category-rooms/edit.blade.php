@extends('admin.layouts.master')
@section('title','Sửa danh mục tin đăng')

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mt-0">Chỉnh sửa danh mục tin đăng</h5>
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="{{ route('category-rooms.update',$data->id) }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">Tên</label>
                                        <input type="hidden" name="id" value="{{ $data->id }}" class="d-none">
                                        <input type="text" name="name" id="simpleinput"
                                               class="form-control"placeholder="Name"  value="{{$data->name }}">
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- <div class="mb-3">
                                        <label class="form-label">Slug:</label>
                                        <input type="text" name="type" class="form-control" placeholder="Type"
                                               value="{{$data->slug }}" disabled>
                                        @error('type')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div> --}}
                                    <div class="mb-3">
                                        <label for="example-textarea" class="form-label">Description</label>
                                        <textarea class="form-control" name="description" id="description" rows="5">{{ $data->description }}</textarea>
                                        @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <button class="btn btn-primary waves-effect waves-light">Cập nhật</button>
                                    <a href="{{ route('category-rooms.index') }}"
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
