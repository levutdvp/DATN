@extends('admin.layouts.master')
@section('title', 'Thùng rác | Ảnh quảng cáo')
@section('content')

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h2 class="mt-0">Thùng rác</h5>
                <div class="table-responsive">
                    <a class="btn btn-success mb-2" href="{{ route('advertisements.index') }}">Danh sách</a>
                    <table id="tech-companies-1" class="table table-centered mb-0">
                        <thead>
                            <tr>
                                <th class="col-2">#</th>
                                <th class="col-2">Vị trí hiển thị</th>
                                <th class="col-2">Đường dẫn</th>
                                <th class="col-2">Ảnh</th>
                                <th class="col-2">Trạng thái</th>
                                <th class="col-4">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)
                                <tr id="row_@item.ID">
                                    <td class="tabledit-view-mode">{{ $value->id }}</td>
                                    <td class="tabledit-view-mode">{{ $value->location }}</td>
                                    <td class="tabledit-view-mode">{{ $value->url }}</td>
                                    <td class="tabledit-view-mode">
                                        @if ($value->image && asset($value->image))
                                            <img src="{{ asset($value->image) }}" alt="" width="100px"
                                                height="100px">
                                        @else
                                            <img src="{{ asset('no_image.jpg') }}" alt="" width="100px"
                                                height="100px">
                                        @endif
                                    </td>
                                    <td>{{ $value->status == 'inactive' ? 'Tắt' : 'Bật' }}</td>
                                    <td><a href="{{ route('advertisements-restore', $value->id) }}" class="btn btn-primary me-2 mb-2"><i
                                                class="fa-solid fa-trash-arrow-up"></i></a>
                                        <form action="{{ route('advertisements-permanently-delete', $value->id) }}" method="post">
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
