@extends('client.layouts.partials.l-sidebar')
@section('title', 'Thêm tin đăng')
@section('main')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 ">
            <!-- Contact form start -->
            <div class="contact-form">
                <form action="{{ route('room-posts.store') }}" method="POST" id="myForm" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="sidebar row p-3">
                        <h4>Khu vực</h4>
                        <hr class="dashed-line">
                        <div class="col-lg-4 col-md-4 mb-3">
                            <div class="form-group">
                                <label class="input-group">Tỉnh / thành phố:<span class="text-danger">*</span> </label>
                                <select class="form-select mb-3" id="city" name="city_id">
                                    <option value="">Chọn tỉnh / thành phố</option>
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
                                    <option value=""> Chọn quận huyện</option>
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
                                    <option value="">Chọn phường / xã</option>
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
                                    value="{{ old('address') }}">
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
                                    readonly value="{{ old('full_address') }}">
                            </div>
                        </div>
                    </div>
                    <div class="sidebar row p-3">
                        <h4 class="mb-3">Thông tin mô tả</h4>
                        <div class="col-lg-12 col-md-12 mb-3">
                            <label class="input-group">Tiêu đề:<span class="text-danger">*</span></label>
                            <div class="form-group ">
                                <input class="form-control" type="text" name="name"
                                    placeholder="Nhập tiêu đề của bài viết" aria-label="Nhập tiêu đề của bài viết"
                                    value="{{ old('name') }}">
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
                                            {{ old('category_room_id') ? 'selected' : false }}>
                                            {{ $categoryRoom->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category_room_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-md-4 mb-3">
                            <div class="form-group ">
                                <label class="input-group">Giá cho thuê: <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="number" name="price" 
                                        class="form-control" value="{{ old('price') }}">
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
                                    <input type="number" placeholder="Diện tích" name="acreage" class="form-control"
                                        value="{{ old('acreage') }}">
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
                                <input type="number" placeholder="Số lượng phòng trống" name="empty_room"
                                    class="form-control" value="{{ old('empty_room') }}">
                            </div>
                            @error('empty_room')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-6 col-md-6 mb-3">
                            <div class="form-group ">
                                <label class="input-group">Trọ tự quản<span class="text-danger">*</span></label>
                                <select class="form-select mb-3" name="managing">
                                    <option value="yes" {{ old('managing') == 'yes' ? 'selected' : false }}>Có
                                    </option>
                                    <option value="no" {{ old('managing') == 'no' ? 'selected' : false }}>Không
                                    </option>
                                </select>
                            </div>
                            @error('managing')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="col-lg-12 col-md-12 mb-3">
                            <label class="input-group">Mô tả chi tiết (tối thiểu 300 kí tự):<span
                                    class="text-danger">*</span></label>
                            <div class="form-group message">
                                <textarea class="form-control " style="height: 110px" name="description" id="description"
                                    placeholder="Write message" aria-label="Write message">{{ old('description') }}</textarea>
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
                                            {{ in_array($facility->id, old('facility', [])) ? 'checked' : '' }}>
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
                                        <input class="form-check-input" id="surrounding-{{ $surround->id }}"
                                            name="surrounding[]" type="checkbox" value="{{ $surround->id }}"
                                            {{ in_array($surround->id, old('surrounding', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="surrounding-{{ $surround->id }}">
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
                            <input type="file" name="imageroom" id="image" data-plugins="dropify"
                                data-height="300">
                            {{-- <input type="file" name="image"  /> --}}
                            @error('imageroom')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Nhiều ảnh -->
                        <div class="col-lg-12 col-md-12 mb-3">
                            <h4 class="header-title">Ảnh chi tiết phòng</h4>
                            <p class="sub-header">
                                ( Tối thiểu 4 ảnh, tối đa 16 ảnh )
                            </p>

                            <div class="upload__box">
                                <div class="upload__btn-box">
                                    <label class="upload__btn">
                                        <p class="btn-md btn-theme btn-4 btn-7">Thêm ảnh</p>
                                        <input type="file" name="image[]" multiple="" data-max_length="20"
                                            class="upload__inputfile">
                                    </label>
                                </div>
                                <div class="upload__img-wrap"></div>
                            </div>
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tags</label>
                            <input type="text" class="selectize-close-btn form-control" name="tags"
                                value="{{ old('tags') }}">
                            @error('tags')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div><!-- end row -->
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
                                            value="{{ auth()->user()->name }}" class="form-control">
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
                                        <input type="text"
                                            value="{{ auth()->user()->phone ? auth()->user()->phone : old('phone') }}"
                                            placeholder="Nhập số điện thoại của bạn" name="phone" class="form-control">
                                    </div>
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-4 mb-3">
                                <div class="form-group ">
                                    <label class="input-group">Email: <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input type="text" value="{{ auth()->user()->email }}" name="email"
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
                                        <input type="text" value="{{ old('zalo') }}"
                                            placeholder="Nhập số Zalo của bạn" name="zalo" class="form-control">
                                    </div>
                                </div>
                                @error('zalo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
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
                                <button type="reset" class="btn-md btn-danger btn-7">Hủy
                                </button>
                                <button type="submit" id="Button" class="btn-md btn-theme btn-4 btn-7">Tạo
                                    tin đăng mới
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
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
        var formSubmitted = false;
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
        var cityFromLocalStorage = localStorage.getItem('city');
        var districtFromLocalStorage = localStorage.getItem('district');
        var wardFromLocalStorage = localStorage.getItem('ward');

        // var addressFromLocalStorage = localStorage.getItem('full_address');
        var promise = axios(Parameter);
        promise.then(function(result) {
            renderCity(result.data);
            var cityChangeEvent = new Event('change');
            citis.dispatchEvent(cityChangeEvent);

            var districtChangeEvent = new Event('change');
            districts.dispatchEvent(districtChangeEvent);
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

            if (cityFromLocalStorage) {
                for (var i = 0; i < citis.options.length; i++) {
                    var option = citis.options[i];
                    if (option.value === cityFromLocalStorage) {
                        citis.selectedIndex = i;
                        break;
                    }
                }
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
                    full_address.value = thanhpho;
                    localStorage.setItem('city', thanhpho);
                    // localStorage.removeItem('district');
                    // localStorage.removeItem('ward');

                    if (districtFromLocalStorage) {
                        for (var i = 0; i < districts.options.length; i++) {
                            var option = districts.options[i];
                            if (option.value === districtFromLocalStorage) {
                                districts.selectedIndex = i;
                                break;
                            }
                        }
                        var districtChangeEvent = new Event('change');
                        districts.dispatchEvent(districtChangeEvent);
                    }
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
                    var selectedQuanHuyen = district.options[district.selectedIndex];
                    quanhuyen = selectedQuanHuyen.textContent
                    console.log(quanhuyen);
                    localStorage.setItem('district', quanhuyen);
                    full_address.value = quanhuyen + " - " + thanhpho;
                    if (wardFromLocalStorage) {
                        for (var i = 0; i < wards.options.length; i++) {
                            var option = wards.options[i];
                            if (option.value === wardFromLocalStorage) {
                                wards.selectedIndex = i;
                                break;
                            }
                        }
                        var wardChangeEvent = new Event('change');
                        wards.dispatchEvent(wardChangeEvent);
                    }
                }
            };

            wards.addEventListener("change", function() {
                var selectedXaPhuong = wards.options[wards.selectedIndex];
                xaphuong = selectedXaPhuong.textContent;
                console.log(xaphuong);
                localStorage.setItem('ward', xaphuong);
                if (localStorage.getItem('full_address') == null) {
                    full_address.value = xaphuong + " - " + quanhuyen + " - " + thanhpho;
                } else {
                    full_address.value = localStorage.getItem('full_address');
                }
            });

            address.addEventListener("input", function() {
                var addressValue = address.value;
                full_address.value = addressValue + " - " + xaphuong + " - " + quanhuyen + " - " + thanhpho;
            });
        }
        document.getElementById("myForm").addEventListener("submit", function() {
            formSubmitted = true;
            localStorage.setItem('full_address', full_address.value);
        });
        // console.log(localStorage.getItem('full_address'));

        window.addEventListener('beforeunload', function(e) {
            if (!formSubmitted) {
                localStorage.clear();
            }
        });

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
