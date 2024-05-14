@extends('admin.layouts.master')
@section('title', 'Cập nhật vai trò')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="my-2">Cập nhật vai trò</h3>
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="{{ route('roles.update', $data->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="id" value="{{ $data->id }}" class="d-none">
                                    <div class="mb-3">
                                        <label for="example-palaceholder" class="form-label">Tên vai trò</label>
                                        <input type="text" name="name" id="example-palaceholder" class="form-control"
                                            value="{{ old('name', $data->name ?? '') }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button class="btn btn-primary waves-effect waves-light">Cập nhật</button>
                                    <a href="{{ route('roles.index') }}"
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
