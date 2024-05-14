@extends('admin.layouts.master')
@section('title', 'Thêm quyền')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="my-2">Thêm quyền</h3>
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="{{ route('permissions.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('post')
                                    <div class="mb-3">
                                        <label for="example-palaceholder" class="form-label">Tên quyền</label>
                                        <input type="text" name="name" id="example-palaceholder" class="form-control"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button class="btn btn-primary waves-effect waves-light">Thêm</button>
                                    <a href="{{ route('permissions.index') }}"
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
