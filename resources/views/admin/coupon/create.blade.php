@extends('admin.layouts.master')
@section('title')
    Thêm mã giảm giá
@endsection
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="my-2">Thêm mã giảm giá</h3>
                        @if ($errors->any())
                            <p class=" alert alert-danger">
                                Dữ liệu không hợp lệ vui lòng kiểm tra lại
                            </p>
                        @endif
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="{{ route('coupons.store') }}" method="POST">
                                    @csrf
                                    @method('post')
                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">Tên mã giảm giá<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="name" id="simpleinput" class="form-control"
                                            placeholder="Tên mã giảm giá..." value="{{ old('name') }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Kiểu<span
                                                class="text-danger">*</span></label>

                                        <div class="form-check mb-1">
                                            <input type="radio" name="type"
                                                value="percent"{{ old('type') == 'percent' ? 'checked' : '' }}
                                                id="genderM" class="form-check-input">
                                            <label for="genderM" class="form-check-label">Phần trăm</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio"
                                                value="price"{{ old('type') == 'price' ? 'checked' : '' }} name="type"
                                                id="genderF" class="form-check-input">
                                            <label for="genderF" class="form-check-label">Giá tiền</label>
                                        </div>
                                        @error('type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-palaceholder" class="form-label">Giá trị<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="value" id="example-palaceholder" class="form-control"
                                            placeholder="Giá trị..." value="{{ old('value') }}">
                                        @error('value')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-textarea" class="form-label">Mô tả<span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" placeholder="Mô tả ..." name="description" id="description" rows="5">{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-palaceholder" class="form-label">Số lượng<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="quantity" id="example-palaceholder" class="form-control"
                                            placeholder="Số lượng..." value="{{ old('quantity') }}">
                                        @error('quantity')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-disable" class="form-label">Ngày bắt đầu<span
                                                class="text-danger">*</span></label>
                                        <input type="datetime-local" name="start_date" class="form-control"
                                            value="{{ old('start_date') }}">
                                        @error('start_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-disable" class="form-label">Ngày kết thúc<span
                                                class="text-danger">*</span></label>
                                        <input type="datetime-local" name="end_date" class="form-control"
                                            value="{{ old('end_date') }}">
                                        @error('end_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button class="btn btn-primary waves-effect waves-light">Thêm</button>
                                    <a href="{{ route('coupons.index') }}"
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
