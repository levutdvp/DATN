@extends('client.layouts.master')
@section('content')

<div class="modal fade" id="notification-success" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light" style="border: none;">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hóa đơn</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex py-2 px-5 justify-content-center border border-success" style="background-color: #F0FCF5; align-items: center;">
                    <img src="{{ asset('fe/img/pay/images-removebg-preview.png') }}" style="max-width: 30px; max-height: 30px;">
                    <p class="fs-6 mt-3 mx-2" style="color: #27AE60;">Thanh toán hóa đơn thành công</p>
                </div>
                <div class="mt-3" style="background-color: #F0FCF5;">
                    <div class="fs-6 text pt-4 p-3">
                        <span class="fw-normal">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bạn đã thanh toán thành công hóa đơn mã số Tro_oi_
                            @if (isset($transactionId))
                            <span class="fs-6 fw-bolder">{{ $transactionId }}.</span>
                            @endif
                            <span class="fw-normal">Giá trị</span> 
                            @if (isset($price))
                            <span class="fw-bolder " style="color: #F21220;">{{ number_format($price) }} VND</span>
                            @endif
                            <span class="fw-normal">với số point nhận được là </span> 
                            @if (isset($point))
                            <span class="fw-bolder " style="color: #17aa6f;">{{ number_format($point) }} Point.</span>
                            @endif
                            {{-- <span class="fw-bolder " style="color: #F21220;">300.000 VND.</span> --}}
                        </span>
                    </div>
                    <div class="fs-6 text  px-3">
                        <span class="fw-normal">Sau khi xác nhận thanh toán thành công bạn có thể theo dõi hóa đơn tại 
                            <span class="fs-6 fw-bolder">Thông tin tài khoản > Theo dõi hóa đơn</span>
                            <span class="fw-normal">hoặc bấm vào</span> 
                            <span class="fw-bolder">Chi tiết đơn hàng</span>
                            <span class="fw-normal">ở phía dưới.</span> 
                        </span>
                    </div>
                    <div class="fs-6 pt-4 p-3">
                        <span class="fw-normal">Website Trọ Ơi rất hân hạnh được phục vụ các bạn !
                        </span>
                    </div>
                </div>

            </div>
            {{-- <div class="modal-footer justify-content-center mb-3" style="border: none;">
                <button type="button" class="btn btn-outline-success" ><a href="{{ route('points.history') }}">Chi tiết đơn hàng</a> </button>
            </div> --}}
            <div class="modal-footer justify-content-center mb-3" style="border: none;">
                <button type="button" class="btn btn-outline-success" ><a href="{{ route('points.history') }}">Chi tiết đơn hàng</a> </button>
                <button type="button" class="btn btn-outline-warning" ><a href="{{ route('home') }}">Về trang chủ</a></button>
            </div>
        </div>
    </div>
</div>

<script>
    // Use jQuery to trigger modal on page load
    $(document).ready(function() {
        $('#notification-success').modal('show');
    });
    </script>
@endsection