@extends('admin.layouts.master')
@section('title', 'Danh sách bài viết')
@section('content')

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h2 class="mt-0">Danh sách bài viết</h2>
                <div class="table-responsive">
                    <div class="mb-2 d-flex gap-1 ">
                        <a class="btn btn-success" href="{{ route('posts.create') }}">Thêm mới</a>
                        <a class="btn btn-danger" href="{{ route('posts-deleted') }}">Thùng rác</a>
                    </div>
                    <table id="tech-companies-1" class="table table-centered mb-0 text-center">
                        <thead>
                        <tr>
                            <th class="col-1">#</th>
                            <th class="col-1">Tiêu đề</th>
                            <th class="col-2">Danh mục</th>
                            <th class="col-2">Ảnh</th>
                            <th class="col-1">Lượt xem</th>
                            <th class="col-2">Tên tác giả</th>
                            <th class="col-1">Trạng thái</th>
                            <th class="col-2">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($model as $key => $value)
                            <tr id="row_@item.ID">
                                <td class="tabledit-view-mode">{{ $key +1 }}</td>
                                <td class="tabledit-view-mode">{!! mb_strimwidth($value->title, 0, 20) !!}</td>
                                <td class="tabledit-view-mode">{{ $value->category_posts->name }}</td>
                                <td class="tabledit-view-mode">
                                    @if ($value->image && asset($value->image))
                                        <img src="{{ asset($value->image) }}" alt="" style="width: 80px; height: 80px">
                                    @else
                                        <img src="{{ asset('no_image.jpg') }}" alt="" style="width: 80px; height: 80px">
                                    @endif
                                </td>
                                <td class="tabledit-view-mode">{{ number_format($value->view) }}</td>
                                <td class="tabledit-view-mode">{{ $value->user->name }}</td>
                                <td>
                                    <input data-id="{{ $value->id }}" class="toggle-class" type="checkbox"
                                           data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                           data-onlabel="Bật" data-offlabel="Tắt"
                                        {{ $value->status == 'active' ? 'checked' : '' }}>
                                </td>
                                <td class="">
                                    <div class="d-flex justify-content-end">
                                        <!-- Button trigger modal -->
                                        <button class="btn btn-success" style="font-size: 13px"
                                                data-bs-toggle="modal"
                                                data-bs-target="#exampleModalToggle{{ $value->id }}">
                                            <i class="fas fa-eye fs-5"></i>
                                        </button>
                                        <a class="mx-2" href="{{ route('posts.edit', $value->id) }}">
                                            <button type="submit" class="btn btn-primary text-center"
                                                    style="width: 45px;"> <!-- Đặt kích thước cố định là 100px -->
                                                <i class="fa-solid fa-pen-to-square fs-4"></i>
                                            </button>
                                        </a>

                                        <form action="{{ route('posts.destroy', $value->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger" style="width: 45px;"
                                                    onclick="return confirm('Bạn có muốn thêm vào thùng rác')">
                                                <!-- Đặt kích thước cố định là 100px -->
                                                <i class="fa-solid fa-trash fs-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div> <!-- end .table-responsive-->
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div>

    <!-- Modal -->
    @foreach ($model as $key => $value)
        <div class="modal fade rounded" id="exampleModalToggle{{ $value->id }}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel"><i class="text-primary fa-solid fa-wallet fa-2xl mx-2"></i>
                            Bài viết: {{ $value->title }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row my-3">
                                <div class="col-md-5 fw-bold">Tiêu đề:</div>
                                <div class="col-md-7">{{ $value->title }}</div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-5 fw-bold">Tiêu đề ngắn:</div>
                                <div class="col-md-7">{{ $value->metaTitle }}</div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-5 fw-bold">Danh mục:</div>
                                <div class="col-md-7">{{ $value->category_posts->name }}</div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-5 fw-bold">Mô tả ngắn:</div>
                                <div class="col-md-7">{!!$value->metaDescription !!}</div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-5 fw-bold">Nội dung:</div>
                                <div class="col-md-7" style="overflow-wrap: break-word;">{!!$value->description !!}</div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-5 fw-bold">Slug:</div>
                                <div class="col-md-7">{!!$value->slug !!}</div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-5 fw-bold">Lượt xem:</div>
                                <div class="col-md-7">{{ number_format($value->view) }}</div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-5 fw-bold">Tên tác giả:</div>
                                <div class="col-md-7">{{ $value->user->name }}</div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-5 fw-bold">Ngày tạo:</div>
                                <div class="col-md-7">{{ $value->created_at }}</div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-5 fw-bold">Ngày chỉnh sửa:</div>
                                <div class="col-md-7">{{ $value->updated_at }}</div>
                            </div>
{{--                            <td class="tabledit-view-mode">{!! mb_strimwidth($value->title, 0, 20) !!}</td>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection


@push('scripts')
    <script>
        new DataTable('#tech-companies-1');
        $(function () {
            $('.toggle-class').change(function () {
                let status = $(this).prop('checked') == true ? 'active' : 'inactive';
                let post_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('posts-status-change') }}',
                    data: {
                        'status': status,
                        'post_id': post_id
                    },
                    success: function (data) {
                        console.log(data);
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        if ($.isEmptyObject(data.error)) {

                            Toast.fire({
                                icon: 'success',
                                title: data.success,
                            })

                        } else {

                            Toast.fire({
                                icon: 'error',
                                title: data.error,
                            })
                        }
                    }
                });
            })
        })
    </script>
@endpush
