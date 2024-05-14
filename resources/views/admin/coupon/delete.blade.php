@extends('admin.layouts.master')
@section('title')
    Thùng rác | Mã giảm giá
@endsection
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mt-0">Thùng rác</h5>

                        <div class="responsive-table-plugin">
                            <div class="table-rep-plugin">
                                <div class="table-responsive" data-pattern="priority-columns">
                                    <div class="mb-2 d-flex gap-1 ">
                                        <a class="btn btn-success" href="{{ route('coupons.index') }}">Danh sách</a>
                                    </div>
                                    <table id="tech-companies-1" class="table table-centered mb-0">
                                        <thead>
                                            <tr>
                                                <th style="width:5%">STT</th>
                                                <th data-priority="1">Tên</th>
                                                <th data-priority="3">Kiểu</th>
                                                <th data-priority="1">Giá trị</th>
                                                <th data-priority="3">Số lượng</th>
                                                <th data-priority="3">Trạng thái</th>
                                                <th data-priority="6">Bắt đầu</th>
                                                <th data-priority="6">Kết thúc</th>
                                                <th>Thao tác</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $value)
                                                <tr>
                                                    <th>{{ $key + 1 }}</th>
                                                    <th>{{ $value->name }}</th>
                                                    <th>{{ $value->type }}</th>
                                                    <th>{{ $value->value }}</th>
                                                    <th>{{ $value->quantity }}</th>
                                                    <th>{!! $value->status == 'inactive'
                                                        ? '<button class="btn btn-danger">Chưa kích hoạt</button>'
                                                        : '<button class="btn btn-primary">Kích hoạt</button>' !!}
                                                    </th>
                                                    <th>{{ $value->start_date }}</th>
                                                    <th>{{ $value->end_date }}</th>

                                                    <th>
                                                        <a href="{{ route('coupons-restore', $value->id) }}"
                                                            class="btn btn-primary text-center my-1" style="width: 45px;"><i
                                                                class="fa-solid fa-trash-arrow-up"></i></a>
                                                        <form action="{{ route('coupons-permanently-delete', $value->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button onclick="return confirm('Bạn có muốn xoá')"
                                                                class="btn btn-danger my-1" style="width: 45px;">
                                                                <i class="fa-solid fa-delete-left text-light"></i>
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
    </script>
@endpush
