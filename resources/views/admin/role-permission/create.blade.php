@extends('admin.layouts.master')
@section('title', 'Thêm vai trò và gán quyền')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="my-2">Gán quyền</h3>
                        <form action="{{ route('roles-permissions.store') }}" method="POST">
                            @csrf
                            @method('post')

                            <div class="mb-3">
                                <label for="example-palaceholder" class="form-label">Tên vai trò</label>
                                <input class="form-control" type="text" name="name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultAll">
                                <label class="form-check-label" for="flexCheckDefaultAll">Tất cả quyền</label>
                            </div>

                            <div class="col-12 my-4">
                                <div class="row">
                                    @foreach ($permissions as $permission)
                                        <div class="form-check col-4">
                                            <input class="form-check-input" name="permission[]" type="checkbox"
                                                value="{{ $permission->id }}" id="flexCheckDefault{{ $permission->id }}"
                                                @if (in_array($permission->id, old('permission', []))) checked @endif>
                                            <label class="form-check-label"
                                                for="flexCheckDefault{{ $permission->id }}">{{ $permission->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                @error('permission')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button class="btn btn-primary waves-effect waves-light">Lưu</button>
                            <a href="{{ route('roles-permissions.index') }}"
                                class="btn btn-warning waves-effect text-light">Trở
                                về</a>
                        </form>
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div><!-- end col -->
        </div>
        <!-- end row -->
    </div> <!-- container -->
@endsection

@push('scripts')
    <script type="text/javascript">
        $('#flexCheckDefaultAll').click(function() {
            if ($(this).is(':checked')) {
                $('input[type = checkbox]').prop('checked', true);
            } else {
                $('input[type = checkbox]').prop('checked', false);
            }
        });
    </script>
@endpush
