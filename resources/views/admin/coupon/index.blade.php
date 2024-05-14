@extends('admin.layouts.master')

@section('title', 'Mã giảm giá')

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mt-0">Danh sách mã giảm giá</h5>

                        <div class="responsive-table-plugin">
                            <div class="table-rep-plugin">
                                <div class="table-responsive" data-pattern="priority-columns">
                                    <div class="mb-2 d-flex gap-1 ">
                                        <a class="btn btn-success" href="{{ route('coupons.create') }}">Thêm mới</a>
                                        <a class="btn btn-danger" href="{{ route('coupons-deleted') }}">Thùng rác</a>
                                    </div>
                                    <table id="tech-companies-1" class="table table-centered mb-0" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th style="width:5%">STT</th>
                                                <th data-priority="1">Tên</th>
                                                <th data-priority="3">Kiểu</th>
                                                <th data-priority="1">Giá trị</th>
                                                <th data-priority="3">Số lượng</th>
                                                <th data-priority="3">Mô tả</th>
                                                <th data-priority="3">Trạng thái</th>
                                                <th data-priority="6">Bắt đầu</th>
                                                <th data-priority="6">Kết thúc</th>
                                                <th data-priority="6">Thao tác</th>
                                            </tr>
                                        </thead>

                                        @foreach ($data as $key => $value)
                                            <tr>
                                                <th>{{ $key + 1 }}</th>
                                                <th>{{ $value->name }}</th>
                                                <th>{{ $value->type }}</th>
                                                <th>{{ $value->value }}</th>
                                                <th>{{ $value->quantity }}</th>
                                                <th>{!! strlen($value->description) > 20 ? mb_strimwidth(strip_tags($value->description), 0, 20) . '...' : $value->description !!}</th>
                                                

                                                <td>
                                                    <input data-id="{{ $value->id }}" class="toggle-class"
                                                        type="checkbox" data-onstyle="success" data-offstyle="danger"
                                                        data-toggle="toggle" data-onlabel="Bật" data-offlabel="Tắt"
                                                        {{ $value->status == 'active' ? 'checked' : '' }}>
                                                </td>
                                                <th>{{ $value->start_date }}</th>
                                                <th>{{ $value->end_date }}</th>

                                                <th class="">
                                                    <a href="{{ route('coupons.edit', $value->id) }}">
                                                        <button type="submit" class="btn btn-primary text-center my-1"
                                                            style="width: 45px;"> <!-- Đặt kích thước cố định là 100px -->
                                                            <i class="fa-solid fa-pen-to-square fs-4"></i>
                                                        </button>
                                                    </a>

                                                    <form action="{{ route('coupons.destroy', $value->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger my-1"
                                                            style="width: 45px;"
                                                            onclick="return confirm('Bạn có muốn thêm vào thùng rác')">
                                                            <!-- Đặt kích thước cố định là 100px -->
                                                            <i class="fa-solid fa-trash fs-4"></i>
                                                        </button>
                                                    </form>

                                                </th>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div> <!-- end .table-responsive -->

                            </div> <!-- end .table-rep-plugin-->
                        </div> <!-- end .responsive-table-plugin-->
                    </div>
                </div> <!-- end card -->
            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- container -->
@endsection
@push('scripts')
    <script>
        new DataTable('#tech-companies-1');
        $(function() {
            $('.toggle-class').change(function() {
                let status = $(this).prop('checked') == true ? 'active' : 'inactive';
                let coupon_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('coupons-status-change') }}',
                    data: {
                        'status': status,
                        'coupon_id': coupon_id
                    },
                    success: function(data) {
                        console.log(data);
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        if ($.isEmptyObject(data.error)) {

                            Toast.fire({
                                icon: 'success',
                                title: data.success,
                            })

                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: data.error,
                            })
                        }
                    }
                });
            })
        })
    </script>
@endpush
