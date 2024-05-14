@extends('admin.layouts.master')
@section('title', 'Cập nhật mật khẩu')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 col-xl-4">
        <div class="text-center">
            <a href="{{ route('home-admin') }}">
                <img src="{{ asset('fe/img/logos/logo.png') }}" alt="" height="100" class="mx-auto">
            </a>
        </div>
        <div class="card">

            <div class="card-body p-4">

                <div class="text-center mb-4">
                    <h4 class="text-uppercase mt-0">Cập nhật mật khẩu</h4>
                </div>

                <form action="{{ route('admin-change-password',auth()->user()->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Mật khẩu hiện tại</label>
                        <input id="password" type="password" placeholder="Mật khẩu hiện tại" class="form-control @error('password') is-invalid @enderror" name="old_password"  autocomplete="new-password">
                        @error('old_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="emailaddress" class="form-label">Mật khẩu mới</label>
                        <input id="password" type="password" placeholder="Mật khẩu mới" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="emailaddress" class="form-label">Xác nhận mật khẩu</label>
                        <input id="password_confirmation" type="password" placeholder="Xác nhận mật khẩu" class="form-control" name="password_confirmation"  autocomplete="new-password">
                    </div>
                    <div class="mb-3 text-center d-grid">
                        <button class="btn btn-primary" type="submit"> Cập nhật </button>
                    </div>

                </form>

            </div> <!-- end card-body -->
        </div>
        <!-- end card -->
        <!-- end row -->

    </div> <!-- end col -->
</div>
@endsection
