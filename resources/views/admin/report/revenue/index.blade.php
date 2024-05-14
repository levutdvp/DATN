@extends('admin.layouts.master')
@section('title', 'Báo cáo | Doanh Thu')
@section('content')

<div class="row">
    <div class="d-flex justify-content-between align-items-center">
        <form class="d-flex gap-2 mb-4" action="{{ route('admin-report-revenue') }}" method="post">
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
            <a class="btn btn-info" href="{{ route('admin-export-revenue') }}">Xuất báo cáo</a>
        </div>
    </div>


    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">


                <h4 class="header-title mt-0 mb-4">Tổng Doanh Thu</h4>

                <div class="widget-chart-1">
                    <div class="widget-chart-box-1 float-start" dir="ltr">
                        <h2>{{ number_format($revenue) }}</h2>
                        <!-- <input data-plugin="knob" data-width="70" data-height="70" data-fgColor="#f05050 " data-bgColor="#F9B9B9" value="{{ $revenue }}" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".15" /> -->
                    </div>


                    <div class="widget-detail-1 text-end">
                        <h3 class="fw-normal pt-2 mb-1"> {{ number_format($revenue_today) }} </h3>
                        <p class="text-muted mb-1">Hôm nay</p>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end col -->

    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">


                <h4 class="header-title mt-0 mb-3">Số hóa đơn hủy</h4>

                <div class="widget-box-2">
                    <div class="widget-detail-2 text-end">
                        <span class="badge bg-success rounded-pill float-start mt-3"> {{ number_format($bill) }}<i class="mdi mdi-trending-up"></i> </span>
                        <h2 class="fw-normal mb-1">{{ number_format($bill_false) }} </h2>
                        <p class="text-muted mb-3">Tổng hóa đơn</p>
                    </div>
                    <div class="progress progress-bar-alt-success progress-sm">
                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{ $bill_false }}" aria-valuemin="0" aria-valuemax="{$bill}}" style="width: @if ($bill != 0) {{ 100 - ($bill_false % $bill) }}@else 0 @endif%;">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end col -->

    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">


                <h4 class="header-title mt-0 mb-4">Doanh thu mua dịch vụ</h4>

                <div class="widget-chart-1">
                    <div class="widget-chart-box-1 float-start" dir="ltr">
                        <h2 class="fw-normal mb-1"> {{ number_format($revenue_service) }}</h2>
                        <!-- <input data-plugin="knob" data-width="70" data-height="70" data-fgColor="#ffbd4a" data-bgColor="#FFE6BA" value="80" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".15" /> -->
                    </div>
                    <div class="widget-detail-1 text-end">
                        <h3 class="fw-normal pt-2 mb-1"> {{ number_format($revenue_service_today) }}</h3>
                        <p class="text-muted mb-1">Hôm nay</p>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end col -->

    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">


                <h4 class="header-title mt-0 mb-3">TB doanh thu / HĐ</h4>

                <div class="widget-box-2">
                    <div class="widget-detail-2 text-end">
                        <span class="badge bg-pink rounded-pill float-start mt-3">
                            @if ($bill != 0)
                            {{ number_format($revenue / $bill) }}
                            @else
                            0
                            @endif
                        </span>
                        <h3 class="fw-normal mb-1">
                            @if ($bill_today != 0)
                            {{ number_format($revenue_today / $bill_today) }}
                            @else
                            0
                            @endif
                        </h3>
                        <p class="text-muted mb-3">Hôm nay</p>
                    </div>

                </div>
            </div>
        </div>
    </div><!-- end col -->
</div>
<div class="row">
    <div class="">
        <div class="card">
            <div class="card-body">


                <h4 class="header-title mt-0 mb-3">Doanh thu tổng quan
                    @if(count($revenueByDay)<=0) 
                    <span class="text-danger"> (Không có doanh thu)</span>   
                    @endif
                </h4>

                <div id="revenue-chart"></div>
            </div>
        </div>

    </div><!-- end col-->


</div>
<!-- end row -->
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
    var revenueByDay = {!!json_encode($revenueByDay) !!};
    const revenueData = [];
    revenueByDay.forEach(function(revenueByDay) {
        revenueData.push({
            date: revenueByDay.revenue_date,
            revenue: revenueByDay.revenue_total
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
    const dates = revenueData.map(data => data.date);

    // Định nghĩa mảng các doanh thu
    const revenues = revenueData.map(data => data.revenue);

    // Tạo biểu đồ sử dụng Morris.js
    new Morris.Line({
        element: 'revenue-chart',
        data: revenueData,
        xkey: 'date',
        ykeys: ['revenue'],
        labels: ['Doanh thu'],
        lineColors: ['#337ab7'],
        xLabelAngle: 45, // Góc xoay của nhãn ngày
        parseTime: false // Vô hiệu hóa tự động phân tích thời gian
    });
</script>
@endpush