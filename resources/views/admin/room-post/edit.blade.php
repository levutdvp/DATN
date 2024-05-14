@extends('admin.layouts.master')
@section('title')
    Thêm tin đăng
@endsection
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <!-- Form row -->
        <form action="{{ route('admin-room-posts.update', $postroom->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $postroom->id }}" class="d-none">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mb-3">
                                Sửa tin đăng
                            </h4>
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label for="inputState" class="form-label">Tỉnh / thành phố:<span
                                            class="text-danger">*</span></label>
                                    <select id="city" class="form-select" name="city_id">
                                        <option value="{{ $cities->name }}">{{ $cities->name }}</option>

                                    </select>
                                    @error('city_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="inputState" class="form-label">Quận / Huyện:<span
                                            class="text-danger">*</span></label>
                                    <select id="district" class="form-select" name="district_id">
                                        <option value="{{ $districts->name }}">
                                            {{ $districts->name }}</option>
                                    </select>
                                    @error('district_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="inputState" class="form-label">Phường / Xã:<span
                                            class="text-danger">*</span></label>
                                    <select id="ward" class="form-select" name="ward_id">
                                        <option value="{{ $wards->name }}"> {{ $wards->name }}</option>
                                    </select>
                                    @error('ward_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="inputAddress2" class="form-label">Địa chỉ chính xác:<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Nhập số nhà , tên đường phố " value="{{ $postroom->address }}" />
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="inputAddress2" class="form-label">Địa chỉ của bạn sẽ hiển
                                        thị như sau:</label>
                                    <input type="text" class="form-control" id="full_address" name="address_full"
                                        placeholder="Nhập số nhà , tên đường phố " readonly
                                        value="{{ $postroom->address_full }}" />
                                </div>
                            </div>
                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card-->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row"></div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="inputEmail4" class="form-label">Tiêu đề:<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name"
                                        placeholder="Nhập tiêu đề của bài viết" value="{{ $postroom->name }}" />
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="inputState" class="form-label">Chuyên mục cho thuê:<span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" name="category_room_id">
                                        <option value="">Chọn chuyên mục</option>
                                        @foreach ($categoryRooms as $categoryRoom)
                                            <option value="{{ $categoryRoom->id }}"
                                                {{ $postroom->category_room_id == $categoryRoom->id ? 'selected' : false }}>
                                                {{ $categoryRoom->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_room_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Giá cho thuê: <span class="text-danger">*</span></label>
                                    <div class="input-group clockpicker" data-placement="top" data-align="top">
                                        <input type="text" name="price" class="form-control"
                                            
                                            value="{{ $postroom->price }}">
                                        <span class="input-group-text">/Tháng</span>
                                    </div>
                                    @error('price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Diện tích:<span class="text-danger">*</span></label>
                                    <div class="input-group clockpicker" data-placement="top" data-align="top">
                                        <input type="text" placeholder="Diện tích" name="acreage"
                                            class="form-control" value="{{ $postroom->acreage }}">
                                        <span class="input-group-text">m²</span>
                                    </div>
                                    @error('acreage')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="inputAddress" class="form-label">Số lượng phòng trống:<span
                                            class="text-danger">*</span></label>
                                    <input type="text" placeholder="Số lượng phòng trống" name="empty_room"
                                        class="form-control" value="{{ $postroom->empty_room }}">
                                    @error('empty_room')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="inputState" class="form-label">Hình thức chung chủ<span
                                            class="text-danger">*</span></label>
                                    <select class="form-select mb-3" name="managing">
                                        <option value="yes" {{ $postroom->managing == 'yes' ? 'selected' : false }}>Có
                                        </option>
                                        <option value="no" {{ $postroom->managing == 'no' ? 'selected' : false }}>
                                            Không
                                        </option>
                                    </select>
                                    @error('managing')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-lg-12 col-md-12 mb-3">
                                <label class="input-group">Mô tả chi tiết:<span class="text-danger">*</span></label>
                                <div class="form-group message">
                                    <textarea class="form-control " style="height: 110px" id="description" name="description"
                                        placeholder="Write message" aria-label="Write message">{{ $postroom->description }}</textarea>
                                </div>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="col-lg-12 col-md-12 mb-3">
                                <label class="input-group">Tiện ích:<span class="text-danger">*</span></label>
                                <div class="row p-3 ">
                                    @foreach ($facilities as $facility)
                                        <div class="form-check col-md-3 col-4 mb-2">
                                            <input class="form-check-input" name="facility[]" type="checkbox"
                                                value="{{ $facility->id }}"
                                                {{ in_array($facility->id, $facilityArray) ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                {{ $facility->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                @error('facility')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-lg-12 col-md-12 mb-3">
                                <label class="input-group">Khu vực xung quanh:<span class="text-danger">*</span></label>
                                <div class="row p-3 ">
                                    @foreach ($surrounding as $surround)
                                        <div class="form-check col-md-3 col-4 mb-2">
                                            <input class="form-check-input" name="surrounding[]" type="checkbox"
                                                value="{{ $surround->id }}"
                                                {{ in_array($surround->id, $surroundingArray) ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                {{ $surround->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                @error('surrounding')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>




                            <!-- Ảnh nổi bật -->
                            <div class="col-lg-12 col-md-12 mb-3">
                                <h4 class="header-title">Tải lên ảnh nổi bật</h4>
                                <p class="sub-header">
                                    Kéo hoặc chọn file
                                </p>
                                <input type="file" data-plugins="dropify" data-height="300" name="imageroom" />
                                <input type="text" value="{{ $postroom->image }}" name="old_imageroom" hidden>

                                <div class="col-4">
                                    <img src="{{ asset($postroom->image) }}" alt=""
                                        style="width: 150px; height: 150px" id="image_preview">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tags</label>
                                <input type="text" class="selectize-close-btn form-control" name="tags"
                                    value="{{ old('tags', $tags ?? '') }}">
                                @error('tags')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <!-- end card-->
                </div>
                <!-- end col-->
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="inputAddress" class="form-label">Họ và tên: <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="fullname" placeholder="Nhập họ tên của bạn"
                                        value="{{ $postroom->fullname }}" class="form-control">
                                    @error('fullname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="inputAddress" class="form-label">Số điện thoại:<span
                                            class="text-danger">*</span></label>
                                    <input type="text" value="{{ $postroom->phone }}"
                                        placeholder="Nhập số điện thoại của bạn" name="phone" class="form-control">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="inputAddress" class="form-label">Email: <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="email" placeholder="Nhập email của bạn"
                                        value="{{ $postroom->email }}" class="form-control">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="inputAddress" class="form-label">Zalo:</label>
                                    <input type="text" value="{{ $postroom->zalo }}"
                                        placeholder="Nhập số Zalo của bạn" name="zalo" class="form-control">
                                    @error('zalo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                Sửa tin đăng phòng
                            </button>
                        </div>
                    </div>
                    <!-- end card-->
                </div>
                <!-- end col-->
            </div>
            <!-- end row -->
        </form>
        <div class="sidebar row p-3">
            <h6 class="mb-0 text-uppercase">Sửa ảnh chi tiết </h6>
            <hr>
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Sửa ảnh</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form method="post" action="{{ route('admin-update-room-posts-image') }}"
                                enctype="multipart/form-data">
                                @csrf
                                @foreach ($multiImgs as $key => $item)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td><img class="image" src="{{ asset($item->name) }}"
                                                style="width:120px; height: 120px;">
                                        </td>
                                        <td> <input type="file" class="form-group" name="image[{{ $item->id }}]">
                                        </td>
                                        <td class="">
                                            <input type="submit" class="btn btn-primary px-4" value="Sửa" />

                                            <a href="{{ route('admin-delete-room-posts-image', ['id' => $item->id]) }}"
                                                class="btn btn-danger">Xoá</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </form>
                            <form method="post" action="{{ route('admin-create-room-post-image') }}" id="myForm"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id_room" value="{{ $postroom->id }}">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="upload__box">
                                                    <div class="upload__btn-box">
                                                        <label class="upload__btn btn-primary">
                                                            <p class="btn-md btn-theme">Chọn ảnh</p>
                                                            <input type="file" name="add_image[]" multiple=""
                                                                data-max_length="20" class="upload__inputfile">
                                                        </label>
                                                    </div>
                                                    <div class="upload__img-wrap"></div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input type="submit" class="btn btn-success px-4" value="Thêm">
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- container -->
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        CKEDITOR.replace('description');
        var citis = document.getElementById("city");
        var districts = document.getElementById("district");
        var wards = document.getElementById("ward");
        var full_address = document.getElementById("full_address");
        var address = document.getElementById("address");
        var thanhpho;
        var quanhuyen;
        var xaphuong;
        var Parameter = {
            url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
            method: "GET",
            responseType: "application/json",
        };
        var promise = axios(Parameter);
        promise.then(function(result) {
            renderCity(result.data);
        });

        function renderCity(data) {
            for (const x of data) {
                var opt = document.createElement('option');
                opt.value = x.Name;
                opt.text = x.Name;
                var asd = x.Id;
                opt.setAttribute('data-id', x.Id);
                citis.options.add(opt);
            }


            citis.onchange = function() {
                district.length = 1;
                ward.length = 1;
                if (this.options[this.selectedIndex].dataset.id != "") {
                    const result = data.filter(n => n.Id === this.options[this.selectedIndex].dataset.id);

                    for (const k of result[0].Districts) {
                        var opt = document.createElement('option');
                        opt.value = k.Name;
                        opt.text = k.Name;
                        var aaa = k.Id;
                        opt.setAttribute('data-id', k.Id);
                        district.options.add(opt);
                    }
                    var selectedThanhPho = citis.options[citis.selectedIndex];
                    thanhpho = selectedThanhPho.textContent;
                    console.log(thanhpho);

                }
            };

            district.onchange = function() {
                ward.length = 1;
                const dataCity = data.filter((n) => n.Id === citis.options[citis.selectedIndex].dataset.id);
                if (this.options[this.selectedIndex].dataset.id != "") {
                    const dataWards = dataCity[0].Districts.filter(n => n.Id === this.options[this.selectedIndex]
                        .dataset.id)[0].Wards;

                    for (const w of dataWards) {
                        var opt = document.createElement('option');
                        opt.value = w.Name;
                        opt.text = w.Name;
                        opt.setAttribute('data-id', w.Id);
                        wards.options.add(opt);

                    }
                    // district.value + '-' +
                    var selectedQuanHuyen = district.options[district.selectedIndex];
                    quanhuyen = selectedQuanHuyen.textContent
                    console.log(quanhuyen);
                }
            };

            wards.addEventListener("change", function() {
                var selectedXaPhuong = wards.options[wards.selectedIndex];
                xaphuong = selectedXaPhuong.textContent;
                console.log(xaphuong);

                full_address.value = xaphuong + " - " + quanhuyen + " - " + thanhpho;
            });


            address.addEventListener("input", function() {
                var addressValue = address.value;
                full_address.value = addressValue + " - " + xaphuong + " - " + quanhuyen + " - " + thanhpho;
            });
        }

        $(document).ready(function() {
            $('.upload__inputfile').each(function() {
                $(this).on('change', function(e) {
                    var imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                    var maxLength = $(this).attr('data-max_length');
                    var imgArray = [];

                    Array.from(e.target.files).forEach(function(f) {
                        if (f.type.match('image.*') && imgArray.length < maxLength) {
                            imgArray.push(f);
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                var html =
                                    `<div class='upload__img-box'><div style='background-image: url(${e.target.result})' data-number='${$(".upload__img-close").length}' data-file='${f.name}' class='img-bg'><div class='upload__img-close'></div></div></div>`;
                                imgWrap.append(html);
                            };
                            reader.readAsDataURL(f);
                        }
                    });
                });
            });

            $('body').on('click', '.upload__img-close', function(e) {
                var file = $(this).parent().data('file');
                var imgArray = [];

                Array.from($('.upload__inputfile')[0].files).forEach(function(f) {
                    imgArray.push(f);
                });

                imgArray = imgArray.filter(function(item) {
                    return item.name !== file;
                });

                $(this).parent().parent().remove();
            });
        });
    </script>
@endpush
