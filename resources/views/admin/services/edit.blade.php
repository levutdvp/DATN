@extends('admin.layouts.master')
@section('title', 'Cập nhật dịch vụ')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title p-2 fs-3 text ">Cập nhật dịch Vụ</h4>
                    @if ($errors->any())
                    <p class=" alert alert-danger col-lg-8">
                        Dữ liệu không hợp lệ vui lòng kiểm tra lại
                    </p>
                    @endif
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{ route('services.update',$services_one->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="text" value="{{$services_one->id}}" name="id" hidden>
                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Tên gói <span class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{$services_one->name}}" id="simpleinput" class="form-control" placeholder="Tên Gói">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="example-email" class="form-label">Giá Point<span class="text-danger">*</span></label>
                                    <input type="number" name="price" value="{{$services_one->price}}" class="form-control" placeholder="Giá" value="{{ old('type') }}">
                                    @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="example-palaceholder" class="form-label">Số ngày <span class="text-danger">*</span></label>
                                    <input type="text" name="date_number" value="{{$services_one->date_number}}" id="example-palaceholder" class="form-control" placeholder="Số Ngày">
                                    @error('date_number')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                <label class="form-label">Màu sắc</label>
                                    <input type="color" class="form-control" id="colorpicker-default" value="{{$services_one->color}}" name="color">
                                    @error('color')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="example-textarea" class="form-label">Mô tả <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="description" id="description" placeholder="Mô Tả" rows="5">{{$services_one->description}}</textarea>
                                    @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button class="btn btn-primary waves-effect waves-light">Sửa</button>
                                {{-- <button class="btn btn-waring waves-effect waves-light">Thêm</button> --}}
                                <button class="btn"><a class="btn btn-info" href="{{ route('services.index') }}">Quay lại</a></button>

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
    CKEDITOR.replace('description');
</script>
@endpush
