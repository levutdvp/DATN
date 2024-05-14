@extends('admin.layouts.master')
@section('title', 'Danh sách đơn hàng cần duyệt')
@section('content')

<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h2 class="mt-0">Xác nhận nạp ví</h5>
            <div class="table-responsive">
                <div class="mb-2 d-flex gap-1 ">
                </div>
                <table id="tech-companies-1" class="table table-centered mb-0 text-center">
                    <thead>
                        <tr>
                            <th class="col-0.5">#</th>
                            <th class="col-0.5">Mã giao dịch</th>
                            <th class="col-1.5">Người nạp</th>
                            <th class="col-1">Số tiền gốc</th>
                            <th class="col-1.5">Số tiền thanh toán</th>
                            <th class="col-1.5">Mã giảm giá</th>
                            <th class="col-1">Phương thức</th>
                            <th class="col-1">Mã xác thực</th>
                            <th class="col-1.5">Ngày mua</th>
                            <th class="col-1.5">Trạng thái</th>
                            <th class="col-1">Xem lí do</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $value)
                        <tr id="row_{{ $value->ID }}">
                            <td class="tabledit-view-mode">{{ $key +1 }}</td>
                            <td class="tabledit-view-mode">{{ $value->vnpay_code ? $value->vnpay_code : "--"  }}</td>
                            <td class="tabledit-view-mode">{!! substr($value->user->name, 0, 20) !!}</td>
                            <td class="tabledit-view-mode">{{ number_format((float) $value->point, 0, '.', ',') }} VND</td>
                            <td class="tabledit-view-mode">{{ number_format((float) $value->price_promotion, 0, '.', ',') }} VND</td>
                            <td class="tabledit-view-mode">{{ optional($value->coupon)->name ?? '--' }}</td>
                            <td class="tabledit-view-mode">{!! substr($value->payment_method, 0, 20) !!}</td>
                            <td class="tabledit-view-mode">{!! substr($value->verification, 0, 20) !!}</td>
                            <td class="tabledit-view-mode">{{ $value->created_at }}</td>
                            <td class="tabledit-view-mode">
                                @if ($value->status === 'accept')
                                <label for="" class="btn btn-success">Thành công</label>
                                @elseif ($value->status === 'cancel')
                                <label for="" class="btn btn-danger">Thất bại</label>
                                @else
                                <form action="{{ route('updatePoint.status', $value->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" onclick="return confirm('Chắc chắn chấp nhận?')" class="btn btn btn-success" name="status" value="accept">Chấp nhận</button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{$value->id}}">
                                        Từ chối
                                    </button>
                                    <!-- Modal lý do -->
                                    <div class="modal fade" id="exampleModal{{$value->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Lý do</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body ">
                                                    <div class="d-flex justify-content-star">
                                                <label for="floatingTextarea2 ">Nội dung<span class=""> (lớn hơn 5 kí tự)</span></label>
                                                    </div>
                                                    <div class="form-floating">
                                                        <textarea  class="form-control " name="reason"   placeholder="Nhập lí do từ chối" style="height: 100px"></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary" name="status" value="cancel" onclick="return confirm('Chắc chắn xác nhận lý do?')" data-bs-dismiss="modal" value="cancel">Xác nhận</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                @endif
                            </td>
                            <td class="tabledit-view-mode">
                                @if(empty(!$value->reason))
                                    <button class="btn btn-success" style="font-size: 13px"
                                        data-bs-toggle="modal"
                                        data-bs-target="#exampleModalToggle{{ $value->id }}">
                                            <i class="fas fa-eye fs-5"></i>
                                    </button>
                                    @else
                                    --
                                @endif
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div> <!-- end .table-responsive-->
        </div> <!-- end card-body -->
    </div> <!-- end card -->
</div>
    <!-- Modal -->
    @foreach ($data as $key => $value)
        <div class="modal fade rounded" id="exampleModalToggle{{ $value->id }}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel"><i class="text-primary fa-solid fa-wallet fa-2xl mx-2"></i>
                            Bài viết: {{ $value->title }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row my-3">
                                <div class="col-md-5 fw-bold">Lí do từ chối :</div>
                                <div class="col-md-7">{{ $value->reason }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection


@push('scripts')
<script>
    new DataTable('#tech-companies-1');

</script>
@endpush
