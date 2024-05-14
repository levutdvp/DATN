@extends('admin.layouts.master')
@section('title', 'Thêm mới tiện ích xung quanh')
@section('content')
    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-6">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <h4 class="text-uppercase mt-0">Thêm mới</h4>
                            </div>
                            <form action="{{ route('surrounding.store') }}" method="POST">
                                @csrf
                                @method('post')
                                <div class="mb-3">
                                    <label for="" class="form-label">Tên tiện ích xung quanh</label>
                                    <input class="form-control" name="name" type="text"
                                        placeholder="Tên tiện ích xung quanh..." value="{{ old('name') }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Icon</label>
                                    <input class="form-control" name="icon" type="text" placeholder="Icon..."
                                        value="{{ old('icon') }}">
                                    @error('icon')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 text-center d-grid">
                                    <button class="btn btn-primary" type="submit"> Thêm mới </button>
                                </div>
                            </form>
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </div>
@endsection
