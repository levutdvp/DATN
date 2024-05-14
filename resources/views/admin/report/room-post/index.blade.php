@extends('admin.layouts.master')
@section('title', 'Báo cáo | Tin Đăng')
@section('content')

<div class="row">
    <div class="d-flex justify-content-between align-items-center">
    <form class="d-flex gap-2 mb-4" action="{{route('admin-report-roompost')}}" method="post">
        @csrf
        @method('post')
        <div class="mt-1">
            <label for="example-disable" class="form-label">Bắt đầu</label>
            <input type="datetime-local" name="date_start" class="form-control" value="{{isset($date_start)?$date_start:''}}" onchange="validateDates()">
        </div>
        <div class="mt-1">
            <label for="example-disable" class="form-label">Kết thúc</label>
            <input type="datetime-local" name="date_end" class="form-control" value="{{isset($date_end)?$date_end:''}}" onchange="validateDates()">
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary waves-effect waves-light">Xem báo cáo</button>
        </div>
    </form>
    <div>
        <a class="btn btn-info" href="{{ route('admin-export-roompost') }}">Xuất báo cáo</a>
    </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title mt-0 mb-4">Tổng tin đăng</h4>

                <div class="widget-chart-1">
                    <div class="widget-chart-box-1 float-start" dir="ltr">
                        <h2>{{$room_post}}</h2>
                    </div>

                    <div class="widget-detail-1 text-end">
                        <h3 class="fw-normal pt-2 mb-1"> {{$room_post_today}} </h3>
                        <p class="text-muted mb-1">Hôm nay</p>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end col -->

    <div class="col-xl-2 col-md-6">
        <div class="card">
            <div class="card-body">
                

                <h4 class="header-title mt-0 mb-3">Tin đã xác nhận</h4>

                <div class="widget-box-2">
                    <div class="widget-detail-2 text-end">
                        <span class="badge bg-success rounded-pill float-start mt-3">{{$room_post_accept}} <i class="mdi mdi-trending-up"></i> </span>
                        <h2 class="fw-normal mb-1"> {{$room_post_accept_today}} </h2>
                        <p class="text-muted mb-3">Hôm nay</p>
                    </div>
                    <div class="progress progress-bar-alt-success progress-sm">
                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{$room_post_accept_today}}" aria-valuemin="0" aria-valuemax="{{$room_post_accept}}" style="width:  {{ ($room_post_accept != 0) ? ($room_post_accept_today / $room_post_accept) * 100 : 0 }}%;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end col -->

    <div class="col-xl-2 col-md-6">
        <div class="card">
            <div class="card-body">
               

                <h4 class="header-title mt-0 mb-4">Tin chờ xác nhận</h4>

                <div class="widget-chart-1">
                    <div class="widget-chart-box-1 float-start" dir="ltr">
                        <h2>{{$room_post_pendding}}</h2>
                    </div>
                    <div class="widget-detail-1 text-end">
                        <h3 class="fw-normal pt-2 mb-1"> {{$room_post_pendding_today}} </h3>
                        <p class="text-muted mb-1">Hôm nay</p>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end col -->
    <div class="col-xl-2 col-md-6">
        <div class="card">
            <div class="card-body">
               

                <h4 class="header-title mt-0 mb-4">Tin đã hủy</h4>

                <div class="widget-chart-1">
                    <div class="widget-chart-box-1 float-start" dir="ltr">
                        <h2>{{$room_post-($room_post_accept+$room_post_pendding)}}</h2>
                    </div>
                    <div class="widget-detail-1 text-end">
                        <h3 class="fw-normal pt-2 mb-1"> {{$room_post_today-($room_post_accept_today+$room_post_pendding_today)}} </h3>
                        <p class="text-muted mb-1">Hôm nay</p>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end col -->

    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mt-0 mb-3"> VIP / thường</h4>

                <div class="widget-box-2">
                    <div class="widget-detail-2 text-end">
                        <span class="badge bg-pink rounded-pill float-start mt-3">{{$room_post_default}} </span>
                        <h2 class="fw-normal mb-1"> {{$room_post_vip}} </h2>
                        <p class="text-muted mb-3">Vip</p>
                    </div>
                    <div class="progress progress-bar-alt-pink progress-sm">
                        <div class="progress-bar bg-pink" role="progressbar" aria-valuenow="{{$room_post_vip}}" aria-valuemin="0" aria-valuemax="{{$room_post_default}}" style="width:{{ ($room_post_default != 0) ? ($room_post_vip / $room_post_default) * 100 : 100 }}%;">

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- end col -->

</div>
<!-- end row -->
<div class="row">
    <div class="">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mt-0 mb-3">Tin đăng tổng quan 
                @if(count($total_room_post)<=0)
                    <span class="text-danger"> (Không có doanh thu)</span>
                @endif
                </h4>
                <div id="revenue-chart"></div>
            </div>
        </div>

    </div><!-- end col-->
</div>
@endsection

@push('scripts')
<script>
    function validateDates() {
        var dateStartInput = document.getElementsByName('date_start')[0];
        var dateEndInput = document.getElementsByName('date_end')[0];
        
        var dateStart = new Date(dateStartInput.value);
        var dateEnd = new Date(dateEndInput.value);
        
        if (dateStart > dateEnd) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu.');
            dateEndInput.value = '';
        }
    }
</script>
<script>
   // Dữ liệu mẫu


// Tạo biểu đồ

    var total_room_post = {!!json_encode($total_room_post) !!};
        const roompostData = [];
        total_room_post.forEach(function(total_room_post) {
            roompostData.push({
                date: total_room_post.date,
                revenue: total_room_post.total_posts
            });
        });
        //     const revenueData = [
        //     { date: '2023-10-13', revenue: 100 },
        //     { date: '2023-10-14', revenue: 200 },
        //     { date: '2023-10-15', revenue: 300 },
        //     { date: '2023-10-16', revenue: 400 },
        //     { date: '2023-10-17', revenue: 500 },
        //     { date: '2023-10-18', revenue: 600 },
        //     { date: '2023-10-19', revenue: 700 },
        //     { date: '2023-10-20', revenue: 800 },
        //     // Thêm các dòng dữ liệu khác tương ứng với các ngày khác
        // ];

        // Định nghĩa mảng các ngày
        const dates = roompostData.map(data => data.date);

        // Định nghĩa mảng các doanh thu
        const revenues = roompostData.map(data => data.total_posts);

        // Tạo biểu đồ sử dụng Morris.js
        new Morris.Line({
            element: 'revenue-chart',
            data: roompostData,
            xkey: 'date',
            ykeys: ['revenue'],
            labels: ['Tin đăng'],
            lineColors: ['#337ab7'],
            xLabelAngle: 45, // Góc xoay của nhãn ngày
            parseTime: false // Vô hiệu hóa tự động phân tích thời gian
        });
</script>


@endpush
