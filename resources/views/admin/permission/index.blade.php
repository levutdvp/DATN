@extends('admin.layouts.master')
@section('title', 'Danh sách quyền')
@section('content')

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h2 class="mt-0">Danh sách quyền</h5>
                <div class="table-responsive">
                    <a class="btn btn-success mb-2" href="{{ route('permissions.create') }}">Thêm mới</a>
                    <a class="btn btn-secondary mb-2" href="{{ route('permissions-import') }}">Import</a>
                    <a class="btn btn-danger mb-2" href="{{ route('permissions-export') }}">Export</a>
                    <table id="tech-companies-1" class="table table-centered mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên</th>
                                <th class="col-2">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)
                                <tr id="row_@item.ID">
                                    <td class="tabledit-view-mode">{{ $key+1 }}</td>
                                    <td class="tabledit-view-mode">{{ $value->name }}</td>
                                    <td class="tabledit-view-mode d-flex">
                                        <a href="{{ route('permissions.edit', $value->id) }}">
                                            <button type="submit" class="btn btn-primary text-center m-1"
                                                style="width: 45px;"> <!-- Đặt kích thước cố định là 100px -->
                                                <i class="fa-solid fa-pen-to-square fs-4"></i>
                                            </button>
                                        </a>
                                        <form action="{{ route('permissions.destroy', $value->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger my-1" style="width: 45px;"
                                                onclick="return confirm('Bạn có muốn thêm vào thùng rác')">
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
