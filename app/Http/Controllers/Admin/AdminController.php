<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;



class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admin-resource', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy', 'deleted', 'restore', 'permanentlyDelete']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::query()
            ->where('role', 'admin')
            ->where('name', '!=', 'Super Admin')
            ->latest()
            ->get();
        return view('admin.admin.index', compact('data'));
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
        return view('admin.admin.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        try {
            $model = new User();
            $model->password =  Hash::make($request->password);
            $model->role = 'admin';
            $model->fill($request->all());
            if ($request->hasFile('avatar')) {
                $model->avatar = upload_file(OBJECT_USER, $request->file('avatar'));
            }
            $model->save();

            if ($request->roles) {
                $model->assignRole($request->roles);
            }
            toastr()->success('Thêm admin thành công!', 'Thành công');
            return to_route('admins.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            toastr()->error('Thao tác thất bại', 'Thất bại');
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
        $data = User::findOrFail($id);
        $roles = Role::query()
        ->where('name', '!=', 'super-admin')
        ->latest()
        ->get();
        return view('admin.admin.edit', compact('data', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        try {
            $model = User::findOrFail($id);
            $model->role = 'admin';
            $oldImg = $model->avatar; // Lưu ảnh cũ

            $model->fill($request->except('avatar'));

            if ($request->hasFile('avatar')) {
                $newImg = upload_file(OBJECT_USER, $request->file('avatar')); // Tải lên ảnh mới
                $model->avatar = $newImg;
            }

            $model->save();

            // Kiểm tra nếu có ảnh mới và ảnh cũ tồn tại, thì xóa ảnh cũ
            if ($request->hasFile('image') && $oldImg) {
                delete_file($oldImg);
            }

            $model->roles()->detach();
            if ($request->roles) {
                $model->assignRole($request->roles);
            }
            toastr()->success('Cập nhật admin thành công!', 'Thành công');
            return to_route('admins.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            toastr()->error('Thao tác thất bại!', 'Thất Bại');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = User::query()->findOrFail($id);
            $data->delete();
            Toastr::success('Admin đã được chuyển vào thùng rác', 'Thành công');

            return to_route('admins.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();
        }
    }

    public function deleted()
    {
        try {
            $data = User::onlyTrashed()->get();
            return view('admin.admin.delete', compact('data'));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back();
        }
    }

    public function permanentlyDelete($id)
    {
        try {
            $data = User::where('id', $id);
            $data->forceDelete();
            toastr()->success('Xóa tài khoản thành công!', 'Thành công');
            return redirect()->back();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            toastr()->error('Xóa tài khoản thất bại!', 'Thất bại');
            return back();
        }
    }

    public function restore($id)
    {
        try {
            $data = User::onlyTrashed()->find($id);
            $data->restore();
            toastr()->success('Khôi phục tài khoản thành công!', 'Thành công');
            return redirect()->back();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            toastr()->error('Khôi phục tài khoản thất bại!', 'Thất bại');
            return back();
        }
    }
}
