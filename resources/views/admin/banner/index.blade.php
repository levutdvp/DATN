@extends('admin.layouts.master')
@section('title', 'Danh sách banner')
@section('content')

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h2 class="mt-0">Danh sách banner</h5>
                <div class="table-responsive">
                    <a class="btn btn-success mb-2" href="{{ route('banners.create') }}">Thêm mới</a>
                    <a class="btn btn-danger mb-2" href="{{ route('banners-deleted') }}">Thùng rác</a>
                    <table id="tech-companies-1" class="table table-centered mb-0">
                        <thead>
                            <tr>
                                <th class="col-2">#</th>
                                <th class="col-2">Tiêu đề</th>
                                <th class="col-2">Đường dẫn</th>
                                <th class="col-2">Mô tả</th>
                                <th class="col-2">Ảnh</th>
                                <th class="col-2">Trạng thái</th>
                                <th class="col-4">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)
                                <tr id="row_@item.ID">
                                    <td class="tabledit-view-mode">{{ $value->id }}</td>
                                    <td class="tabledit-view-mode">{{ $value->title }}</td>
                                    <td class="tabledit-view-mode">{{ $value->url }}</td>
                                    <td class="tabledit-view-mode">{!! substr($value->description, 0, 20) !!}</td>
                                    <td class="tabledit-view-mode">
                                        @if ($value->image && asset($value->image))
                                            <img src="{{ asset($value->image) }}" alt="" width="100px"
                                                height="100px">
                                        @else
                                            <img src="{{ asset('no_image.jpg') }}" alt="" width="100px"
                                                height="100px">
                                        @endif
                                    </td>
                                    <td>
                                        <input data-id="{{ $value->id }}" class="toggle-class" type="checkbox"
                                            data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                            data-onlabel="Bật" data-offlabel="Tắt"
                                            {{ $value->status == 'active' ? 'checked' : '' }}>
                                    </td>
                                    <td style="white-space: nowrap; width: 1%;">
                                        <a href="{{ route('banners.edit', $value->id) }}">
                                            <button type="submit" class="btn btn-primary text-center my-1"
                                                style="width: 45px;"> <!-- Đặt kích thước cố định là 100px -->
                                                <i class="fa-solid fa-pen-to-square fs-4"></i>
                                            </button>
                                        </a>

                                        <form action="{{ route('banners.destroy', $value->id) }}" method="POST">
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
        $(function() {
            $('.toggle-class').change(function() {
                let status = $(this).prop('checked') == true ? 'active' : 'inactive';
                let banner_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('banners-status-change') }}',
                    data: {
                        'status': status,
                        'banner_id': banner_id
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
