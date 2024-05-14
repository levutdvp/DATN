@extends('admin.layouts.master')
@section('title', 'Danh sách vai trò và quyền')
@section('content')

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h2 class="mt-0">Danh sách vai trò và quyền</h5>
                <div class="table-responsive">
                    <a class="btn btn-success mb-2" href="{{route('roles-permissions.create')}}">Thêm vai trò và gán quyền</a>
                    <table id="tech-companies-1" class="table table-centered mb-0">
                        <thead>
                            <tr>
                                <th class="col-1">#</th>
                                <th class="col-2">Vai trò</th>
                                <th>Quyền</th>
                                <th class="col-2">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $key => $value)
                                <tr id="row_@item.ID">
                                    <td class="tabledit-view-mode">{{ $key+1 }}</td>
                                    <td class="tabledit-view-mode">{{ $value->name }}</td>
                                    <td>
                                        @foreach ($value->permissions as $perm)
                                            <span class="badge rounded-pill bg-danger"> {{ $perm->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="tabledit-view-mode d-flex">
                                        <a href="{{ route('roles-permissions.edit', $value->id) }}">
                                            <button type="submit" class="btn btn-primary text-center m-1"
                                                style="width: 45px;"> <!-- Đặt kích thước cố định là 100px -->
                                                <i class="fa-solid fa-pen-to-square fs-4"></i>
                                            </button>
                                        </a>
                                        <form action="{{ route('roles-permissions.destroy', $value->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger my-1" style="width: 45px;"
                                                onclick="return confirm('Chuyển vai trò vào thùng rác ?')">
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
