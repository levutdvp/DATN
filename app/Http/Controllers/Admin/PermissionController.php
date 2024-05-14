<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Admin\PermissionRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PermissionExport;
use App\Imports\PermissionImport;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:permission-resource', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy', 'deleted', 'restore', 'permanentlyDelete','importPermission','Export']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Permission::query()->latest()->get();
        return view('admin.permission.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequest $request)
    {
        try {
            $data = new Permission();
            $data->fill($request->all());
            $data->save();
            Toastr::success('Thêm quyền thành công', 'Thành công');
            return to_route('permissions.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Permission::query()->findOrFail($id);
        return view('admin.permission.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionRequest $request, string $id)
    {
        try {
            $data = Permission::query()->findOrFail($id);
            $data->fill($request->all());
            $data->save();
            Toastr::success('Cập nhật quyền thành công', 'Thành công');
            return to_route('permissions.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = Permission::query()->findOrFail($id);
            $data->delete();
            Toastr::success('Quyền đã được chuyển vào thùng rác', 'Thành công');

            return to_route('permissions.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();
        }
    }

    public function deleted()
    {
        $data = Permission::query()->onlyTrashed()->get();
        return view('admin.permission.delete', compact('data'));
    }

    public function restore(string $id)
    {
        try {
            $restore = Permission::query()->onlyTrashed()->findOrFail($id);
            $restore->restore();
            Toastr::success('Khôi phục quyền thành công', 'Thành công');
            return redirect()->back();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();
        }
    }

    public function permanentlyDelete(String $id)
    {
        try {
            $data = Permission::query()->withTrashed()->findOrFail($id);
            $data->forceDelete();
            Toastr::success('Xoá quyền thành công', 'Thành công');

            return back();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();
        }
    }

    public function importPermission()
    {
        return view('admin.permission.import');
    }

    public function Export()
    {
        return Excel::download(new PermissionExport, 'permissions.xlsx');
    }

    public function Import(Request $request)
    {
        try {
            Excel::import(new PermissionImport, $request->file('import_file'));
            Toastr::success('Import quyền thành công', 'Thành công');
            return to_route('permissions.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();
        }
    }
}
