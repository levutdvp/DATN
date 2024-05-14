@extends('admin.layouts.master')
@section('title', 'Import quyền')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="my-2">Import quyền</h3>
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="{{ route('import') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('post')
                                    <div class="form-group mb-3">
                                        <label for="exampleInputEmail1" class="form-label">File Import</label>
                                        <input type="file" name="import_file" class="form-control" accept=".xlsx">
                                    </div>
                                    <button type="submit" class="btn btn-secondary">Import</button>
                                    <a href="{{ route('permissions.index') }}"
                                        class="btn btn-warning waves-effect text-light">Trở về</a>
                                </form>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row-->
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div><!-- end col -->
        </div>
        <!-- end row -->
    </div> <!-- container -->
@endsection
