@extends('admin.layouts.master')
@section('title', 'Danh sách tiện ích')
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h2 class="mt-0">Danh sách tiện ích</h5>
                <div class="table-responsive">
                    <a class="btn btn-success mb-2" href="{{ route('facilities.create') }}">Thêm mới</a>
                    <a class="btn btn-danger mb-2" href="{{ route('facilities-deleted') }}">Thùng rác</a>
                    <table id="tech-companies-1" class="table table-centered mb-0 text-center">
                        <thead>
                            <tr>
                                <th class="col-2">#</th>
                                <th class="col-2">Tên tiện ích</th>
                                <th class="col-2">Icon</th>
                                <th class="col-3">Mô tả</th>
                                <th class="col-3">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)
                                <tr id="row_@item.ID">
                                    <td class="tabledit-view-mode">{{ $value->id }}</td>
                                    <td class="tabledit-view-mode">{{ $value->name }}</td>
                                    <td class="tabledit-view-mode"><i class="{{ $value->icon }}"></i></td>
                                    <td class="tabledit-view-mode">{!! $value->description !!}</td>
                                    <td style="white-space: nowrap; width: 1%;">

                                        <a href="{{ route('facilities.edit', $value->id) }}">
                                            <button type="submit" class="btn btn-primary text-center my-1"
                                                style="width: 45px;"> <!-- Đặt kích thước cố định là 100px -->
                                                <i class="fa-solid fa-pen-to-square fs-4"></i>
                                            </button>
                                        </a>

                                        <form action="{{ route('facilities.destroy', $value->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" onclick="return confirm('Bạn có muốn xoá?')"
                                                class="btn btn-danger my-1" style="width: 45px;">
                                                <!-- Đặt kích thước cố định là 100px -->
                                                <i class="fa-solid fa-trash fs-4"></i>
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- end .table-responsive-->
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div>
@endsection


@push('scripts')
    <script>
        new DataTable('#tech-companies-1');
    </script>
@endpush
