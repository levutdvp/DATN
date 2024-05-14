@extends('admin.layouts.master')
@section('title','Thùng rác | Danh mục tin đăng')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="mt-0">Danh mục đã xóa</h5>
                    <div class="responsive-table-plugin">
                        <div class="table-rep-plugin">
                            <div class="mb-2 d-flex gap-1 ">
                                <div class="mb-2 d-flex gap-1 ">
                                    <a class="btn btn-success" href="{{ route('category-rooms.index') }}">Danh sách</a>
                                </div>
                            </div>
                            <div class="table-responsive" data-pattern="priority-columns">
                                <table id="tech-companies-1" class="table table-centered mb-0 text-center">
                                    <thead>
                                        <tr>
                                            <th class="col-1">#</th>
                                            <th class="col-1">Tên danh mục</th>
                                            <th class="col-1">Slug</th>
                                            <th class="col-1">Ngày đăng tải</th>
                                            <th class="col-1">Mô tả</th>
                                            <th class="col-1">Trạng thái</th>
                                            <th class="col-1">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $value)
                                            <tr id="row_@item.ID">
                                                <td class="tabledit-view-mode">{{ $value->id }}</td>
                                                <td class="tabledit-view-mode">{{ $value->name }}</td>
                                                <td class="tabledit-view-mode">{{ $value->slug }}</td>
                                                <td class="tabledit-view-mode">{{ $value->created_at }}</td>
                                                <td class="tabledit-view-mode">{!! substr($value->description, 0, 40) !!}</td>
                                                <td>
                                                    <input data-id="{{ $value->id }}" class="toggle-class"
                                                        type="checkbox" data-onstyle="success" data-offstyle="danger"
                                                        data-toggle="toggle" data-onlabel="Bật" data-offlabel="Tắt"
                                                        {{ $value->status == 'active' ? 'checked' : '' }}>
                                                </td>
                                                <td class="">
                                                    <a href="{{ route('category-rooms-restore', $value->id) }}"
                                                        class="btn btn-primary mb-2">
                                                        <i class="fa-solid fa-trash-arrow-up mx-2 fs-4"></i></i>
                                                    </a>
                                                    <form
                                                        action="{{ route('category-rooms-permanently-delete', $value->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger"
                                                            onclick="return confirm('Bạn chắc chắn muốn xóa?')">
                                                            <i class="fa-solid fa-trash fs-4 mx-2 text-light"></i>
                                                        </button>
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
@endsection

@push('scripts')
    <script>
        new DataTable('#tech-companies-1');
        $(function() {
            $('.toggle-class').change(function() {
                let status = $(this).prop('checked') == true ? 'active' : 'inactive';
                let categoryrooms_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('category-rooms-status-change') }}',
                    data: {
                        'status': status,
                        'categoryrooms_id': categoryrooms_id,
                    },
                    success: function(data) {
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
