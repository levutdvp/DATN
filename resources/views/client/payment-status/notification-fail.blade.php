@extends('client.layouts.master')
@section('content')
<div class="modal fade" id="notification-fail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light" style="border: none;">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hóa đơn</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex py-2 px-5 justify-content-center border border-warning" style="background-color: #FFF6EF; align-items: center">
                    <img src="{{ asset('fe/img/pay/warning.png') }}" style="max-width: 20px; max-height: 20px;">
                    <p class="fs-6 mt-3 mx-2" style="color: #E77C40;">Thanh toán thất bại</p>
                </div>
                <div class="mt-3" style="background-color: #ffda72;">
                    <div class="fs-6 text pt-4 p-3">
                        <span class="fw-normal">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rất tiếc, giao dịch thanh toán của bạn không thể hoàn thành lúc này! 
                            Hãy kiểm tra lại thông tin thanh toán và thử lại hoặc chọn phương thức thanh toán khác. 
                            Nếu bạn cần sự hỗ trợ, vui lòng liên hệ với chúng tôi qua trang Liên hệ để được giúp đỡ!       
                        </span>
                    </div>
                    <div class="fs-6 text pb-4 px-3">
                        <span class="fw-normal">Website Trọ Ơi rất hân hạnh được phục vụ các bạn !
                        </span>
                    </div>    
                </div>
            </div>
            <div class="modal-footer justify-content-center mb-3" style="border: none;">
                <button type="button" class="btn btn-outline-success" ><a href="{{ route('home') }}">Giao dịch khác</a> </button>
                <button type="button" class="btn btn-outline-warning" ><a href="{{ route('home') }}">Thanh toán lại</a></button>
            </div>
        </div>
    </div>
</div>
<!-- Button trigger modal -->
<script>
    // Use jQuery to trigger modal on page load
    $(document).ready(function() {
        $('#notification-fail').modal('show');
    });
    </script>
@endsection