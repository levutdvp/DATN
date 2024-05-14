@extends('admin.layouts.master')
@section('title', 'Danh sách dịch vụ')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mt-0">Danh sách Dịch Vụ</h5>
                        <div class="responsive-table-plugin">
                            <div class="table-rep-plugin">
                                <div class="table-responsive" data-pattern="priority-columns">
                                    <div class="mb-2 d-flex gap-1 ">
                                        <a class="btn btn-success" href="{{ route('services.create') }}">Thêm mới</a>
                                        <a class="btn btn-danger" href="{{ route('services-deleted') }}">Thùng rác</a>
                                    </div>
                                    <table id="tech-companies-1" class="table table-centered " style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th style="col-1">STT</th>
                                                <th style="col-1">Tên Gói</th>
                                                <th style="col-1">Giá</th>
                                                <th style="col-1">Số Ngày</th>
                                                <th style="col-1">Màu Sắc</th>
                                                <th style="col-1">Mô Tả</th>
                                                <th>Hành Động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($services as $key => $value)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $value->name }}</td>
                                                    <td>{{ $value->price }}</td>
                                                    <td>{{ $value->date_number }}</td>
                                                    <td style="color:{{$value->color}};">{{ $value->color}}</td>
                                                    <td>{!! $value->description !!}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('services.edit', $value->id) }}"
                                                            class="btn btn-primary ">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                        <form action="{{ route('services.destroy', $value->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                           @if (countPostServiceId($value->id)>0)
                                                            <button disabled class="btn btn-danger mt-2"
                                                                onclick="return confirm('Bạn có muốn thêm vào thùng rác')">
                                                                <i class="fa-solid fa-trash fs-4 text-light"></i>
                                                            </button>
                                                            @else
                                                            <button class="btn btn-danger mt-2"
                                                                onclick="return confirm('Bạn có muốn thêm vào thùng rác')">
                                                                <i class="fa-solid fa-trash fs-4 text-light"></i>
                                                            </button>
                                                            @endif
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
    <script>
        new DataTable('#tech-companies-1');
    </script>
@endpush
