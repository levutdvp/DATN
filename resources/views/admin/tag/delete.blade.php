@extends('admin.layouts.master')
@section('title', 'Thùng rác | Thẻ')
@section('content')

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h2 class="mt-0">Thùng rác</h5>
                <div class="table-responsive">
                    <a class="btn btn-success mb-2" href="{{ route('tags.index') }}">Danh sách</a>
                    <table id="tech-companies-1" class="table table-centered mb-0">
                        <thead>
                            <tr>
                                <th class="col-2">#</th>
                                <th class="col-2">Tên</th>
                                <th class="col-2">Đường dẫn</th>
                                <th class="col-2">Trạng thái</th>
                                <th class="col-2">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)
                                <tr id="row_@item.ID">
                                    <td class="tabledit-view-mode">{{ $value->id }}</td>
                                    <td class="tabledit-view-mode">{{ $value->name }}</td>
                                    <td class="tabledit-view-mode">{{ $value->slug }}</td>
                                    <td>{{ $value->status == 'inactive' ? 'Tắt' : 'Bật' }}</td>
                                    <td><a href="{{ route('tags-restore', $value->id) }}"
                                            class="btn btn-primary me-2 mb-2"><i class="fa-solid fa-trash-arrow-up"></i></a>
                                        <form action="{{ route('tags-permanently-delete', $value->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button onclick="return confirm('Bạn có muốn xoá')" class="btn btn-danger">
                                                <i class="fa-solid fa-delete-left text-light"></i>
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
