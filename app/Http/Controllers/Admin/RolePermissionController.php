<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RolePermissionRequest;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:role-permission-resource', ['only' => ['index','create', 'store','edit', 'update','destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::query()
        ->where('name', '!=', 'super-admin')
        ->latest()
        ->get();
        return view('admin.role-permission.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::query()
        ->where('name', '!=', 'super-admin')
        ->latest()
        ->get();
        $permissions = Permission::query()->latest()->get();
        return view('admin.role-permission.create', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RolePermissionRequest $request)
    {
        try {
            $role = Role::create(['name' => $request->input('name')]);
            $role->syncPermissions($request->input('permission'));

            Toastr::success('Thêm vai trò và gán quyền thành công', 'Thành công');
            return redirect()->route('roles-permissions.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
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

        $role = Role::query()->findOrFail($id);
        $permissions = Permission::all();
        return view('admin.role-permission.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Lấy thông tin của vai trò cần cập nhật
            $role = Role::query()->findOrFail($id);
            $role->name = $request->input('name');
            $role->save();

            // Lấy danh sách quyền được chọn từ form
            $permissions = $request->permission;

            // Xóa tất cả quyền của vai trò hiện tại
            $role->syncPermissions($permissions);

            // Gán lại quyền cho vai trò dựa trên danh sách được chọn
            if (!empty($permissions)) {
                $role->givePermissionTo($permissions);
            }

            Toastr::success('Cập nhật quyền cho vai trò thành công', 'Thành công');
            return redirect()->route('roles-permissions.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->permissions()->detach();
            $role->delete();
            Toastr::success('Xóa vai trò thành công', 'Thành công');
            return redirect()->route('roles-permissions.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();
        }
    }
}
