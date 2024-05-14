@extends('client.layouts.partials.l-sidebar')
@section('title', 'Sửa tin đăng')
@section('main')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 ">
            <!-- Contact form start -->
            <div class="contact-form">
                <form action="{{ route('room-posts.update', $postroom->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $postroom->id }}" class="d-none">

                    <div class="sidebar row p-3">
                        <h4>Khu vực</h4>
                        <hr class="dashed-line">
                        <div class="col-lg-4 col-md-4 mb-3">
                            <div class="form-group">
                                <label class="input-group">Tỉnh / thành phố:<span class="text-danger">*</span> </label>
                                <select class="form-select mb-3" id="city" name="city_id">
                                    <option value="{{ $citie->name }}">{{ $citie->name }}</option>
                                </select>
                                @error('city_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 mb-3">
                            <div class="form-group ">
                                <label class="input-group">Quận / Huyện:<span class="text-danger">*</span></label>
                                <select class="form-select  mb-3" id="district" name="district_id">
                                    <option value="{{ $district->name }}">
                                        {{ $district->name }}</option>
                                </select>
                                @error('district_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 mb-3">
                            <div class="form-group ">
                                <label class="input-group">Phường / Xã:<span class="text-danger">*</span>
                                </label>
                                <select class="form-select mb-3" name="ward_id" id="ward">

                                    <option value="{{ $ward->name }}"> {{ $ward->name }}</option>
                                </select>
                                @error('ward_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <label class="input-group">Địa chỉ chính xác:<span class="text-danger">*</span></label>
                            <div class="form-group ">
                                <input class="form-control" type="text" name="address" id="address"
                                    placeholder="Nhập số nhà , tên đường phố " aria-label="Nhập số nhà , tên đường phố"
                                    value="{{ $postroom->address }}">
                            </div>
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-12 col-md-12 mt-3">
                            <label class="input-group">Địa chỉ của bạn sẽ hiển thị như sau:<span
                                    class="text-danger">*</span></label>
                            <div class="form-group">
                                <input class="form-control" type="text" id="full_address" name="address_full"
                                    placeholder="Nhập số nhà , tên đường phố " aria-label="Nhập số nhà , tên đường phố"
                                    readonly value="{{ $postroom->address_full }}">
                            </div>
                            @error('empty_room')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="sidebar row p-3">
                        <h4 class="mb-3">Thông tin mô tả</h4>
                        <div class="col-lg-12 col-md-12 mb-3">
                            <label class="input-group">Tiêu đề:<span class="text-danger">*</span></label>
                            <div class="form-group ">
                                <input class="form-control" type="text" name="name"
                                    placeholder="Nhập tiêu đề của bài viết" aria-label="Nhập tiêu đề của bài viết"
                                    value="{{ $postroom->name }}">
                            </div>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-md-4 mb-3">
                            <div class="form-group ">
                                <label class="input-group">Chuyên mục cho thuê:<span class="text-danger">*</span></label>
                                <select class="form-select mb-3" name="category_room_id">
                                    <option value="">Chọn chuyên mục</option>
                                    @foreach ($category_rooms as $categoryRoom)
                                        <option value="{{ $categoryRoom->id }}"
                                            {{ $postroom->category_room_id == $categoryRoom->id || old('category_room_id') == $categoryRoom->id ? 'selected' : false }}>
                                            {{ $categoryRoom->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_room_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 mb-3">
                            <div class="form-group ">
                                <label class="input-group">Giá cho thuê: <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="text" name="price" 
                                        class="form-control" value="{{ $postroom->price }}">
                                    <span class="input-group-text">/Tháng</span>
                                </div>
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 mb-3">
                            <div class="form-group ">
                                <label class="input-group">Diện tích:<span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="text" placeholder="Diện tích" name="acreage" class="form-control"
                                        value="{{ $postroom->acreage }}">
                                    <span class="input-group-text">m²</span>
                                </div>
                                @error('acreage')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-3">
                            <div class="form-group ">
                                <label class="input-group">Số lượng phòng trống:<span class="text-danger">*</span></label>
                                <input type="text" placeholder="Số lượng phòng trống" name="empty_room"
                                    class="form-control" value="{{ $postroom->empty_room }}">
                            </div>
                            @error('empty_room')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-6 col-md-6 mb-3">
                            <div class="form-group ">
                                <label class="input-group">Trọ tự quản<span class="text-danger">*</span></label>
                                <select class="form-select mb-3" name="managing">

                                    <option value="yes" {{ $postroom->managing == 'yes' ? 'selected' : false }}>Có
                                    </option>
                                    <option value="no" {{ $postroom->managing == 'no' ? 'selected' : false }}>Không
                                    </option>
                                </select>
                            </div>
                            @error('managing')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="col-lg-12 col-md-12 mb-3">
                            <label class="input-group">Mô tả chi tiết:<span class="text-danger">*</span></label>
                            <div class="form-group message">
                                <textarea class="form-control " style="height: 110px" name="description" id="description"
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
                                        <input class="form-check-input" id="facility-{{ $facility->id }}"
                                            name="facility[]" type="checkbox" value="{{ $facility->id }}"
                                            {{ in_array($facility->id, $facilityArray) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="facility-{{ $facility->id }}">
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
                                        <input class="form-check-input" id="surround-{{ $surround->id }}"
                                            name="surrounding[]" type="checkbox" value="{{ $surround->id }}"
                                            {{ in_array($surround->id, $surroundingArray) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="surround-{{ $surround->id }}">
                                            {{ $surround->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('surrounding')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>



                        <!-- Upload file -->
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
                        <!-- Nhiều ảnh -->
                        <div class="mb-3">
                            <label class="form-label">Tags</label>
                            <input type="text" class="selectize-close-btn form-control" name="tags"
                                value="{{ old('tags', $tags ?? '') }}">
                            @error('tags')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="sidebar row p-3">
                        <h4>Liên hệ</h4>
                        <hr class="dashed-line">

                        <div class="row">
                            <div class="col-lg-6 col-md-4 mb-3">
                                <div class="form-group ">
                                    <label class="input-group">Họ và tên: <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="fullname" placeholder="Nhập họ tên của bạn"
                                            value="{{ $postroom->fullname }}" class="form-control">
                                    </div>
                                    @error('fullname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-4 mb-3">
                                <div class="form-group ">
                                    <label class="input-group">Số điện thoại:<span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input type="text" value="{{ $postroom->phone }}"
                                            placeholder="Nhập số điện thoại của bạn" name="phone" class="form-control">
                                    </div>
                                </div>
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-4 mb-3">
                                <div class="form-group ">
                                    <label class="input-group">Email: <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input type="text" value="{{ $postroom->email }}" name="email"
                                            placeholder="Nhập email của bạn" class="form-control">
                                    </div>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-4 mb-3">
                                <div class="form-group ">
                                    <label class="input-group">Zalo:</label>
                                    <div class="input-group mb-3">
                                        <input type="text" value="{{ $postroom->zalo }}"
                                            placeholder="Nhập số Zalo của bạn" name="zalo" class="form-control">
                                    </div>
                                    @error('zalo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- End upload file -->

                    <div class="sidebar row p-3">
                        <div class="col-lg-12 col-md-12 clearfix">
                            <div class=" text-center pull-left">
                                <a href="{{ route('room-posts.index') }}" class="btn-md btn-theme btn-4 btn-7">Quay lại
                                    danh sách</a>

                            </div>
                            <div class="send-btn text-center d-flex gap-2 pull-right">
                                <button type="submit" class="btn-md  btn-danger btn-7">Hủy
                                </button>
                                <button type="submit" class="btn-md btn-theme btn-4 btn-7">Sửa
                                    tin đăng mới
                                </button>
                            </div>
                        </div>
                    </div>
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
                                    <form method="post" action="{{ route('update-room-posts-image') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @foreach ($multiImgs as $key => $item)
                                            <tr>
                                                <th scope="row">{{ $key + 1 }}</th>
                                                <td><img class="image" src="{{ asset($item->name) }}"
                                                        style="width:120px; height: 120px;">
                                                </td>
                                                <td> <input type="file" class="form-group"
                                                        name="image[{{ $item->id }}]">
                                                </td>
                                                <td class="">
                                                    <input type="submit" class="btn btn-primary px-4" value="Sửa" />

                                                    <a href="{{ route('delete-room-posts-image', ['id' => $item->id]) }}"
                                                        class="btn btn-danger">Xoá</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </form>
                                    <form method="post" action="{{ route('create-room-post-image') }}" id="myForm"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id_room" value="{{ $postroom->id }}">
                                        <table class="table table-striped">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="upload__box">
                                                            <div class="upload__btn-box">
                                                                <label class="upload__btn">
                                                                    <p class="btn-md btn-theme btn-4 btn-7">Chọn ảnh</p>
                                                                    <input type="file" name="add_image[]"
                                                                        multiple="" data-max_length="20"
                                                                        class="upload__inputfile">
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
            <!-- Contact form end -->
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('be/assets/libs/selectize/js/standalone/selectize.min.js') }}"></script>
    <script src="{{ asset('be/assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('be/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        CKEDITOR.replace('description');
        var citis = document.getElementById("city");
        var districts = document.getElementById("district");
        var wards = document.getElementById("ward");
        var full_address = document.getElementById("full_address");
        var address = document.getElementById("address");
        var thanhpho1 = document.getElementById("thanhpho1");
        // console.log(phuongxa1.value);
        var thanhpho;
        var quanhuyen;
        var xaphuong;
        var Parameter = {
            url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
            method: "GET",
            responseType: "application/json",
        };
        // console.log(phuongxa1.value);
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
                        opt.setAttribute('data-id', k.Id);
                        district.options.add(opt);
                    }
                    var selectedThanhPho = citis.options[citis.selectedIndex];
                    console.log(selectedThanhPho.textContent);
                    thanhpho = selectedThanhPho.textContent;
                }
            };

            district.onchange = function() {
                ward.length = 1;
                const dataCity = data.filter((n) => n.Id === citis.options[citis.selectedIndex].dataset.id);
                if (this.options[this.selectedIndex].dataset.id != "") {
                    const dataWards = dataCity[0].Districts.filter(n => n.Id === this.options[this
                            .selectedIndex]
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
                }
            };

            wards.addEventListener("change", function() {
                var selectedXaPhuong = wards.options[wards.selectedIndex];
                xaphuong = selectedXaPhuong.textContent;
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
    <script src="{{ asset('be/assets/js/pages/form-advanced.init.js') }}"></script>
@endpush
