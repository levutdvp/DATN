<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:role-resource', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy', 'deleted', 'restore', 'permanentlyDelete']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Role::query()
            ->where('name', '!=', 'super-admin') // Loại bỏ vai trò "super-admin"
            ->latest()
            ->get();
        return view('admin.role.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        try {
            $data = new Role();
            $data->fill($request->all());
            $data->save();
            Toastr::success('Thêm vai trò thành công', 'Thành công');
            return to_route('roles.index');
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
        $data = Role::query()->findOrFail($id);
        return view('admin.role.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id)
    {
        try {
            $data = Role::query()->findOrFail($id);
            $data->fill($request->all());
            $data->save();
            Toastr::success('Cập nhật vai trò thành công', 'Thành công');
            return to_route('roles.index');
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
            $data = Role::query()->findOrFail($id);
            $data->delete();
            Toastr::success('Vai trò đã được chuyển vào thùng rác', 'Thành công');

            return to_route('roles.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();
        }
    }

    public function deleted()
    {
        $data = Role::query()->onlyTrashed()->get();
        return view('admin.role.delete', compact('data'));
    }

    public function restore(string $id)
    {
        try {
            $restore = Role::query()->onlyTrashed()->findOrFail($id);
            $restore->restore();
            Toastr::success('Khôi phục vai trò thành công', 'Thành công');
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
            $data = Role::query()->withTrashed()->findOrFail($id);
            $data->forceDelete();
            Toastr::success('Xoá vai trò thành công', 'Thành công');

            return back();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();
        }
    }
}
