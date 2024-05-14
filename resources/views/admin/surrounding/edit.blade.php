@extends('admin.layouts.master')
@section('title', 'Cập nhật tiện ích xung quanh')
@section('content')
    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-6">
                    <div class="card">

                        <div class="card-body p-4">

                            <div class="text-center mb-4">
                                <h4 class="text-uppercase mt-0">Cập nhật</h4>
                            </div>

                            <form action="{{ route('surrounding.update', $data->id) }}" method="POST">
                                @csrf
                                @method('put')
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <div class="mb-3">
                                    <label for="" class="form-label">Tên tiện ích</label>
                                    <input class="form-control" name="name" type="text" value="{{ $data->name }}"
                                        placeholder="Tên tiện ích xung quanh...">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Tên tiện ích</label>
                                    <input class="form-control" name="icon" type="text" placeholder="Icon..."
                                        value="{{ $data->icon }}">
                                    @error('icon')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="mb-3 text-center d-grid">
                                    <button class="btn btn-primary" type="submit"> Cập nhật </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
