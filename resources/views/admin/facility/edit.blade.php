@extends('admin.layouts.master')
@section('title', 'Cập nhật tiện ích')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="my-2">Cập nhật tiện ích</h3>
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{ route('facilities.update', $data->id) }}" enctype="multipart/form-data"
                                method="POST">
                                @csrf
                                @method('put')
                                <div class="mb-3">
                                    <label for="" class="form-label">Tên tiện ích <span
                                            class="text-danger">*</span></label>
                                    <input name="name" type="text" value="{{ old('name', $data->name ?? '') }}"
                                        class="form-control" placeholder="Wifi">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="icon" class="form-label">Icon <span class="text-danger">*</span></label>
                                    <select name="icon" id="icon" class="form-select">
                                        <option value="fa-solid fa-wifi" @if ($data->icon === 'fa-solid fa-wifi') selected @endif>Wifi</option>
                                        <option value="fas fa-fan" @if ($data->icon === 'fas fa-fan') selected @endif>Quạt</option>
                                        <option value="fa-solid fa-bed" @if ($data->icon === 'fa-solid fa-bed') selected @endif>Giường</option>
                                        <option value="fa-solid fa-temperature-full" @if ($data->icon === 'fa-solid fa-temperature-full') selected @endif>Bình nóng lạnh</option>
                                        <option value="fa-solid fa-snowflake" @if ($data->icon === 'fa-solid fa-snowflake') selected @endif>Điều hoà</option>
                                        <option value="fa-solid fa-kitchen-set" @if ($data->icon === 'fa-solid fa-kitchen-set') selected @endif>Kệ bếp</option>
                                        <option value="fa-solid fa-jug-detergent" @if ($data->icon === 'fa-solid fa-jug-detergent') selected @endif>Máy giặt</option>
                                        <option value="far fa-snowflake" @if ($data->icon === 'far fa-snowflake') selected @endif>Tủ lạnh</option>
                                        <option value="fa-solid fa-motorcycle" @if ($data->icon === 'fa-solid fa-motorcycle') selected @endif>Bãi để xe</option>
                                        <option value="fa-solid fa-camera" @if ($data->icon === 'fa-solid fa-camera') selected @endif>Camera an ninh</option>
                                        <option value="fas fa-calendar-plus" @if ($data->icon === 'fas fa-calendar-plus') selected @endif>Khác</option>
                                    </select>
                                    @error('icon')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Mô tả <span
                                            class="text-danger">*</span></label>
                                    <textarea name="description" id="description-facility2" class="form-control" cols="30" rows="5">{{ old('description', $data->description ?? '') }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <button class="btn btn-primary" type="submit"> Cập nhật </button>
                                    <button class="btn btn-warning" type="submit"> <a
                                            href="{{ route('facilities.index') }}" class="text-white">Trở về</a> </button>
                                </div>
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
        CKEDITOR.replace('description-facility2', {
            filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
            filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
            filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
            filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
            filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
            filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
        });
    </script>
@endpush
