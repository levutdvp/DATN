@extends('admin.layouts.master')
@section('title', 'Thùng rác | Bài viết')
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h2 class="mt-0">Thùng rác bài viết</h5>
                <div class="table-responsive">
                    <div class="mb-2 d-flex gap-1 ">
                        <a class="btn btn-success" href="{{ route('posts.index') }}">Danh sách</a>
                    </div>
                    <table id="tech-companies-1" class="table table-centered mb-0">
                        <thead>
                        <tr>
                            <th class="col-0.5">#</th>
                            <th class="col-1">Tiêu đề</th>
                            <th class="col-1">Tiêu đề ngắn</th>
                            <th class="col-1">Danh mục</th>
                            <th class="col-1">Ảnh</th>
                            <th class="col-1">Mổ tả ngắn</th>
                            <th class="col-1">Content</th>
                            <th class="col-0.5">Slug</th>
                            <th class="col-1">View</th>
                            <th class="col-1">Tên tác giả</th>
                            <th class="col-1">Ngày đăng tải</th>
                            <th class="col-1">Trạng thái</th>
                            <th class="col-1">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($model as $key => $value)
                            <tr id="row_@item.ID">
                                <td class="tabledit-view-mode">{{ $key +1 }}</td>
                                <td class="tabledit-view-mode">{!! substr($value->title, 0, 20) !!}</td>
                                <td class="tabledit-view-mode">{!! substr($value->metaTitle, 0, 20) !!}</td>
                                <td class="tabledit-view-mode">{{ $value->category_posts->name }}</td>
                                <td class="tabledit-view-mode">
                                    @if ($value->image && asset($value->image))
                                        <img src="{{ asset($value->image) }}" alt="" style="width: 80px; height: 80px">
                                    @else
                                        <img src="{{ asset('no_image.jpg') }}" alt="" style="width: 80px; height: 80px">
                                    @endif
                                </td>
                                <td class="tabledit-view-mode">{!! substr($value->metaDescription, 0, 20) !!}</td>
                                <td class="tabledit-view-mode">{!! substr($value->description, 0, 20) !!}</td>
                                <td class="tabledit-view-mode">{{ $value->slug }}</td>
                                <td class="tabledit-view-mode">{{ number_format($value->view) }}</td>
                                <td class="tabledit-view-mode">{{ $value->user->name }}</td>
                                <td class="tabledit-view-mode">{{ $value->updated_at }}</td>
                                <td>{{ $value->status == 'inactive' ? 'Tắt' : 'Bật' }}</td>
                                    <td>
                                        <a href="{{ route('posts-restore', $value->id) }}" class="btn btn-primary text-center my-1"
                                           style="width: 45px;"><i
                                                class="fa-solid fa-trash-arrow-up"></i></a>
                                        <form action="{{ route('posts-permanently-delete', $value->id) }}" method="post">
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
