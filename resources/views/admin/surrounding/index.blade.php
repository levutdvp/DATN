@extends('admin.layouts.master')
@section('title', 'Danh sách tiện ích')
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h2 class="mt-0">Danh sách tiện ích</h5>
                <div class="table-responsive">
                    <a class="btn btn-primary mb-2" href="{{ route('surroundings-deleted') }}">Thùng rác</a>
                    <a class="btn btn-success mb-2" href="{{ route('surroundings.create') }}">Thêm mới</a>
                    <table id="tech-companies-1" class="table table-centered mb-0">
                        <thead>
                            <tr>
                                <th class="col-2">#</th>
                                <th class="col-2">Tên tiện ích</th>
                                <th class="col-2">Icon</th>
                                <th class="col-2">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)
                                <tr id="row_@item.ID">
                                    <td class="tabledit-view-mode">{{ $key+1 }}</td>
                                    <td class="tabledit-view-mode">{{ $value->name }}</td>
                                    <td class="tabledit-view-mode">{{ $value->icon }}</td>

                                    <td style="white-space: nowrap; width: 1%;">

                                        <a href="{{ route('surroundings.edit', $value->id) }}">
                                            <button type="submit" class="btn btn-primary text-center my-1"
                                                style="width: 45px;"> <!-- Đặt kích thước cố định là 100px -->
                                                <i class="fa-solid fa-pen-to-square fs-4"></i>
                                            </button>
                                        </a>

                                        <form action="{{ route('surroundings.destroy', $value->id) }}" method="POST">
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
