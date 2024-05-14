@extends('admin.layouts.master')
@section('title', 'Thùng rác | Danh mục bài viết')
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h2 class="mt-0">Thùng rác</h5>
                <div class="table-responsive">
                    <div class="mb-2 d-flex gap-1 ">
                        <a class="btn btn-success" href="{{ route('category-posts.index') }}">Danh sách</a>

                    </div>
                    <table id="tech-companies-1" class="table table-centered mb-0">
                        <thead>
                        <tr>
                            <th class="col-2">STT</th>
                            <th class="col-2">Name</th>
                            <th class="col-2">Slug</th>
                            <th class="col-2">Mô tả</th>
                            <th class="col-2">Ngày</th>
                            <th class="col-2">Trạng thái</th>
                            <th class="col-2">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($model as $key => $value)
                            <tr id="row_@item.ID">
                                <td class="tabledit-view-mode">{{ $key+1 }}</td>
                                <td class="tabledit-view-mode">{{ $value->name }}</td>
                                <td class="tabledit-view-mode">{{ $value->slug }}</td>
                                <td class="tabledit-view-mode">{!! substr($value->description, 0, 20) !!}</td>
                                <td class="tabledit-view-mode">{{ $value->updated_at }}</td>
                                <td>{{ $value->status == 'inactive' ? 'Tắt' : 'Bật' }}</td>
                                <td>
                                    <a href="{{ route('category-posts-restore', $value->id) }}" class="btn btn-primary text-center my-1"
                                       style="width: 45px;"><i
                                            class="fa-solid fa-trash-arrow-up"></i></a>
                                    <form action="{{ route('category-posts-permanently-delete', $value->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button onclick="return confirm('Bạn có muốn xoá')" class="btn btn-danger my-1" style="width: 45px;">
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
