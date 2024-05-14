@extends('client.layouts.partials.l-sidebar')
@section('title', 'Dịch vụ')
@section('main')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 ">
            <!-- Contact form start -->
            <div class="row">
                @if(isset($services))
            @if(count($services))
            @foreach($services as $key => $value)

            <div class="col-lg-3 col-md-12">
                <input type="text" name="services_id" value="{{$value->id}}" hidden>
                <div class="pricing-1 plan" style="height: 500px;">
                    <div class="" style="height: 80%;">
                        <div class="plan-header mb-4 ">

                            <h5>{{$value->name}}</h5>
                            <p></p>
                            <hr>
                            <div class="plan-price fs-5">{{number_format($value->price)}}<span> Point</span><span>/Tin/</span><span>{{$value->date_number}}</span><span> Ngày</span></div>
                        </div>
                        <div class="plan-list p-3">
                            {!!$value->description!!}
                        </div>
                    </div>

                </div>
            </div>
            <!-- div modal confirm -->


            @endforeach
            <div class="col-lg-3 col-md-12">
                <div class="pricing-1 plan" style="height: 500px;">
                    <div class="plan-header mb-4 ">
                        <h5>Tin Thường</h5>
                        <p></p>
                        <hr>
                        <div class="plan-price fs-5">0<span> Point</span><span>/Tin/</span><span>1</span><span> Ngày</span></div>
                    </div>
                    <div class="plan-list p-3">
                        <p><strong>Hiển thị dưới tin VIP 1, VIP 2, VIP 3.</strong></p>
                        <p><strong>Tiêu đề <span>Màu Đen</span>, in thường</strong></p>
                    </div>
                </div>
            </div>
            {{ $services->links() }}
            @endif
            @endif


        </div>
        <div class="row   text-white" style="background-color: #fbfbfb;">
            <h3 class="text-center fs-8">Minh hoạ tin đăng</h3>
            <div class="row">

                <div class="row my-2">
                    <div class="col-lg-5 col-md-6 col-sm-6">
                        <h5>Tin VIP 1</h5>
                        <div>
                            <span class="text-danger fw-bold" style="font-size: 12px;">TIÊU ĐỀ IN HOA MÀU
                                ĐỎ</span><span class="text-dark" style="font-size: 12px;">, gắn biểu tượng
                                ngôi sao màu vàng và biểu tượng nổi bật
                                ở tiêu đề tin đăng. Hiển thị ở trên tất cả các tin khác, được hưởng nhiều ưu
                                tiên và hiệu quả giao dịch cao nhất.</span>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-lg-3">
                                <img src="{{asset('fe/img/room/img-1.jpg')}}" alt="" style="width: 135px; height: 135px;">
                            </div>
                            <div class="col-lg-9 bg-light">
                                <span class="text-danger fw-bold" style="font-size: 12px;">CHỈ CHO NỮ THUÊ PHÒNG STUDIO, ĐIỆN THEO GIÁ NHÀ NƯỚC</span><br>
                                <span class="text-success fw-bold" style="font-size: 10px;">3.5 triệu/tháng</span>
                                <span class="text-dark fw-bold" style="font-size: 10px;">-- 25m vuông</span><br>
                                <span class="text-dark fw-bold" style="font-size: 10px;">Nam Từ Liêm, Hà Nội</span><br>
                                <span class="text-dark" style="font-size: 10px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard</span><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-lg-5 col-md-6 col-sm-6">
                        <h5>Tin VIP 2</h5>
                        <div>
                            <span class="text-warning fw-bold" style="font-size: 12px;">TIÊU ĐỀ IN HOA MÀU
                                CAM</span><span class="text-dark" style="font-size: 12px;">, hiển thị sau tin VIP 1 và trên các tin khác.</span>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-lg-3">
                                <img src="{{asset('fe/img/room/img-1.jpg')}}" alt="" style="width: 135px; height: 135px;">
                            </div>
                            <div class="col-lg-9 bg-light">
                                <span class="text-warning fw-bold" style="font-size: 12px;">CHỈ CHO NỮ THUÊ PHÒNG STUDIO, ĐIỆN THEO GIÁ NHÀ NƯỚC</span><br>
                                <span class="text-success fw-bold" style="font-size: 10px;">3.5 triệu/tháng</span>
                                <span class="text-dark fw-bold" style="font-size: 10px;">-- 25m vuông</span><br>
                                <span class="text-dark fw-bold" style="font-size: 10px;">Nam Từ Liêm, Hà Nội</span><br>
                                <span class="text-dark" style="font-size: 10px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard</span><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-lg-5 col-md-6 col-sm-6">
                        <h5>Tin VIP 3</h5>
                        <div>
                            <span class="fw-bold" style="font-size: 12px; color: rgb(255, 0, 179);">TIÊU ĐỀ IN HOA MÀU
                                HỒNG</span><span class="text-dark" style="font-size: 12px;">, hiển thị tin VIP 1, VIP 2 và trên tin thường.</span>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-lg-3">
                                <img src="{{asset('fe/img/room/img-1.jpg')}}" alt="" style="width: 135px; height: 135px;">
                            </div>
                            <div class="col-lg-9 bg-light">
                                <span class="fw-bold" style="font-size: 12px; color: rgb(255, 0, 179);">CHỈ CHO NỮ THUÊ PHÒNG STUDIO, ĐIỆN THEO GIÁ NHÀ NƯỚC</span><br>
                                <span class="text-success fw-bold" style="font-size: 10px;">3.5 triệu/tháng</span>
                                <span class="text-dark fw-bold" style="font-size: 10px;">-- 25m vuông</span><br>
                                <span class="text-dark fw-bold" style="font-size: 10px;">Nam Từ Liêm, Hà Nội</span><br>
                                <span class="text-dark" style="font-size: 10px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard</span><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-lg-5 col-md-6 col-sm-6">
                        <h5>Tin Thường</h5>
                        <div>
                            <span class=" fw-bold" style="font-size: 12px; color:black;">TIÊU ĐỀ IN HOA MÀU
                                ĐEN MẶC ĐỊNH</span><span class="" style="font-size: 12px;">, hiển thị dưới tin VIP 1, VIP 2, VIP 3.</span>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-lg-3">
                                <img src="{{asset('fe/img/room/img-1.jpg')}}" alt="" style="width: 135px; height: 135px;">
                            </div>
                            <div class="col-lg-9 bg-light">
                                <span class=" fw-bold" style="font-size: 12px; color:black;">CHỈ CHO NỮ THUÊ PHÒNG STUDIO, ĐIỆN THEO GIÁ NHÀ NƯỚC</span><br>
                                <span class="text-success fw-bold" style="font-size: 10px;">3.5 triệu/tháng</span>
                                <span class="text-dark fw-bold" style="font-size: 10px;">-- 25m vuông</span><br>
                                <span class="text-dark fw-bold" style="font-size: 10px;">Nam Từ Liêm, Hà Nội</span><br>
                                <span class="text-dark" style="font-size: 10px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard</span><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact form end -->
    </div>

    @endsection

