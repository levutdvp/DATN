@extends('admin.layouts.master')
@section('title', 'Thùng rác | Dịch vụ')
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="mt-0">Thùng rác Dịch Vụ</h5>
                    <div class="responsive-table-plugin">
                        <div class="table-rep-plugin">
                            <div class="table-responsive" data-pattern="priority-columns">
                                <div class="mb-2 d-flex gap-1 ">
                                    <a class="btn btn-success" href="{{ route('services.index') }}">Danh sách</a>
                                </div>

                                <table id="tech-companies-1" class="table table-centered">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên Gói</th>
                                            <th>Giá</th>
                                            <th>Số Ngày</th>
                                            <th>Màu Sắc</th>
                                            <th>Mô Tả</th>
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($services_deleted as $key => $value)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->price }}</td>
                                            <td>{{ $value->date_number }}</td>
                                            <td style="color:{{$value->color}};">{{ $value->color }}</td>

                                            <td>{!! $value->description !!}</td>

                                            <td class="text-center">
                                                <a onclick="return confirm('Bạn có muốn khôi phục ')" href="{{ route('services-restore', $value->id) }}" class="btn btn-primary"><i class="fa-solid fa-trash-arrow-up"></i></a>

                                                <form action="{{ route('services-permanently-delete', $value->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button onclick="return confirm('Bạn có muốn xoá')" class="btn btn-danger mt-2">
                                                        <i class="fa-solid fa-delete-left text-light"></i>
                                                    </button>
                                                </form>
                                            </td>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    new DataTable('#tech-companies-1');
</script>
@endpush
