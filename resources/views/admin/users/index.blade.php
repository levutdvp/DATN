@extends('admin.layouts.master')
@section('title', 'Danh sách người dùng')
@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="mt-0">Danh sách tài khoản</h5>
                            <div class="table-responsive">
                                <div class="mb-2 d-flex gap-1 ">
                                    <a class="btn btn-success" href="{{ route('users.create') }}">Thêm mới</a>
                                    <a class="btn btn-danger" href="{{ route('users-deleted') }}">Thùng rác</a>
                                </div>
                                <table id="tech-companies-1" class="table table-centered mb-0">
                                    <thead>
                                    <tr>
                                        <th class="col-0.5">#</th>
                                        <th class="col-1.5">Tên</th>
                                        <th class="col-1.5">Email</th>
                                        <th class="col-1.5">Số điện thoại</th>
                                        <th class="col-1">Ảnh</th>
                                        <th class="col-1.5">Vai trò</th>
                                        <th class="col-1">Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($data as $key => $value)
                                        <tr id="row_@item.ID">
                                            <td class="tabledit-view-mode">{{ $key +1 }}</td>
                                            <td class="tabledit-view-mode">{!! substr($value->name, 0, 20) !!}</td>
                                            <td class="tabledit-view-mode">{!! substr($value->email, 0, 30) !!}</td>

                                            <td class="tabledit-view-mode">{!! substr($value->phone, 0, 20) !!}</td>
                                            <td class="tabledit-view-mode">
                                                @if ($value->avatar && asset($value->avatar))
                                                    <img src="{{ asset($value->avatar) }}" alt="" style="width: 80px; height: 80px">
                                                @else
                                                    <img src="{{ asset('no_image.jpg') }}" alt="" style="width: 80px; height: 80px">
                                                @endif
                                            </td>
                                            <td class="tabledit-view-mode">
                                                @if($value->role == 'vendor')
                                                    Nhà cung cấp
                                                @elseif($value->role == 'admin')
                                                    Quản trị viên
                                                @else
                                                    {{ $value->role }}
                                                @endif
                                            </td>
                                            <td class="">
                                                <a href="{{ route('users.edit', $value->id) }}">
                                                    <button type="submit" class="btn btn-primary text-center my-1"
                                                            style="width: 45px;">
                                                        <i class="fa-solid fa-pen-to-square fs-4"></i>
                                                    </button>
                                                </a>

                                                <form action="{{ route('users.destroy', $value->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger my-1" style="width: 45px;"
                                                            onclick="return confirm('Bạn có muốn thêm vào thùng rác')">
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
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->
@endsection
@push('scripts')
    <script>
        new DataTable('#tech-companies-1');
    </script>
@endpush
