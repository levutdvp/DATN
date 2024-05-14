@extends('client.layouts.partials.l-sidebar')
@section('title', 'Thông báo')
@section('main')
<div class="mb-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mt-0">Thông báo</h5>
                        <div class="responsive-table-plugin">
                            <div class="table-rep-plugin">
                                <div class="table-responsive" data-pattern="priority-columns">
                                    <table id="tech-companies-1" class="table table-centered " style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th style="col-1">STT</th>
                                                <th style="col-1">Thời gian</th>
                                                <th style="col-1">Avatar</th>
                                                <th style="col-1">Người gửi</th>
                                                <th style="col-1">Nội dung</th>
                                                <th style="col-1">Trạng thái</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (notification() as $key => $value)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $value->created_at}}</td>
                                                    <td>
                                                        <img src="{{ $value->user->avatar ? asset($value->user->avatar) : asset('fe/img/logos/no-image-user.jpeg')}}"  style="width:100px; height:100px;" >
                                                    </td>
                                                    <td>{{ $value->user->name}}</td>
                                                    <td ><a href="notifications/{{$value->id}}/edit" class="text-primary">{{$value->message}}</a></td>
                                                    <td class="text-center {{$value->read_at ? "text-success": "text-warning" }}">
                                                        {{$value->read_at?"Đã đọc":"Chưa đọc"}}
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
        <!-- end row -->
    </div> <!-- container -->
@endsection
@push('scripts')
    <script>
        new DataTable('#tech-companies-1');
        
    </script>
@endpush
