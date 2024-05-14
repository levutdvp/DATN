@extends('client.layouts.partials.l-sidebar')
@section('title', 'Thùng rác')
@section('main')
    <div class="row sidebar">
        <h4 class="my-3">Thùng rác</h4>
        <hr class="dashed-line">
        <div class="col-lg-12 col-md-12 col-sm-12 py-4">
            <!-- Contact form start -->
            <div class="table-responsive">
                <table class="table align-middle" id="tech-companies-1">
                    <thead class="table-light">
                        <th style="width:5%">STT</th>
                        <th style="width:10%">Ảnh chính</th>
                        <th style="width:20%">Tiêu đề</th>
                        <th style="width:10%">Trạng thái</th>
                        <th style="width:10%">Ngày bắt đầu</th>
                        <th style="width:10%">Ngày kết thúc</th>
                        <th style="width:5%">Thao tác</th>
                    </thead>
                    <tbody class="align-items-center p-4">
                        @foreach ($data as $key => $value)
                            <tr class="">
                                <td scope="row">{{ $key + 1 }}</td>

                                <td>
                                    <img src="{{ asset($value->image) }}" style="width: 100px;height: 100px;">
                                </td>
                                <td>
                                    <p>{{ $value->name }}</p>
                                </td>
                                <td>
                                    @if ($value->status == 'pendding')
                                        {!! '<div class="btn btn-warning">Chờ xử lý</div>' !!}
                                    @elseif($value->status == 'accept')
                                        {!! '<div class="btn btn-success">Kích hoạt</div>' !!}
                                    @else
                                        {!! '<div class="btn btn-danger">Đã huỷ</div>' !!}
                                    @endif
                                </td>

                                <td>{{  $value->time_start }}</td>
                                <td>{{ $value->time_end }}</td>

                                <td>
                                    <div class="d-flex m-2">
                                        <button class="btn btn-success my-1" style="font-size: 13px" data-bs-toggle="modal"
                                            data-bs-target="#exampleModalToggle{{ $value->id }}">
                                            <i class="fas fa-eye fs-5"></i>
                                        </button>
                                        <a href="{{ route('room-posts-restore', $value->id) }}"
                                            class="btn btn-primary text-center m-1"><i
                                                class="fa-solid fa-trash-arrow-up fs-5"></i></a>
                                        {{-- <form action="{{ route('room-posts-permanently-delete', $value->id) }}"
                                            method="post">
                                            @csrf
                                            @method('delete')
                                            <button onclick="return confirm('Bạn có muốn xoá')" class="btn btn-danger my-1">
                                                <i class="fa-solid fa-delete-left text-light fs-5"></i>
                                            </button>
                                        </form> --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
                <!-- Contact form end -->
            </div>
        </div>
    </div>
    <!-- Modal -->
    @foreach ($data as $key => $value)
        <div class="modal fade rounded" id="exampleModalToggle{{ $value->id }}" aria-hidden="true"
            aria-labelledby="exampleModalToggleLabel" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel"><i
                                class="text-primary fa-solid fa-wallet fa-2xl mx-2"></i>
                            Tin đăng phòng {{ $value->name }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row my-3">
                                <div class="col-md-5 fw-bold">Tên:</div>
                                <div class="col-md-7">{{ $value->name }}</div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-5 fw-bold">Địa chỉ:</div>
                                <div class="col-md-7">{{ $value->address_full }}
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-5 fw-bold">Giá tiền:</div>
                                <div class="col-md-7">{{ number_format($value->price) }} VND/tháng</div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-5 fw-bold">Diện tích:</div>
                                <div class="col-md-7">{{ $value->acreage }}m2</div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-5 fw-bold">Danh mục:</div>
                                <div class="col-md-7"> {{ $value->categoryroom->name }}</div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-5 fw-bold">Gói dịch vụ:</div>
                                <div class="col-md-7">
                                    @if ($value->service_id != null)
                                        {{ $value->service->name }}
                                    @else
                                        Tin thường
                                    @endif
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-5 fw-bold">Mô tả:</div>
                                <div class="col-md-7">{!! $value->description !!}</div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-5 fw-bold">Liên hệ:</div>
                                <div class="col-md-7">{{ $value->fullname }}</div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-5 fw-bold">Điện thoại:</div>
                                <div class="col-md-7">{{ $value->phone }}</div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-5 fw-bold">Zalo:</div>
                                <div class="col-md-7">{{ $value->zalo }}</div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-5 fw-bold">Ngày đăng:</div>
                                <div class="col-md-7">{{ $value->created_at }}</div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-5 fw-bold">Ngày hết hạn:</div>
                                <div class="col-md-7">{{ $value->time_end }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
