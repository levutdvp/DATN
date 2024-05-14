<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRoomRequest;
use App\Models\CategoryRoom;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CategoryRoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:category-room-post-resource', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy', 'deleted', 'restore', 'permanentlyDelete','changeStatus']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = CategoryRoom::query()->orderByDesc('id')->get();
        return view('admin.category-rooms.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category-rooms.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRoomRequest $request)
    {
        try {
            $model = new CategoryRoom();
            $slug = Str::slug($request->name);
            $model->slug = $slug;
            $model->fill($request->all());
            $model->save();
            Toastr::success('Thao tác thành công', 'Thành công');
            return to_route('category-rooms.index');
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
        $data = CategoryRoom::query()->findOrFail($id);
        return view('admin.category-rooms.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRoomRequest $request, string $id)
    {
        //
        try {
            $data = CategoryRoom::query()->findOrFail($id);
            if($data->id===1){
                toastr()->error('Bạn không thể chỉnh sửa danh mục này!', 'Thao tác thất bại');
                return redirect()->back();
            }
            $slug = Str::slug($request->name);
            $data->slug = $slug;
            $data->fill($request->all());
            $data->save();
//            $notification = array(
//                "message" => "Cập nhật danh mục thành công",
//                "alert-type" => "success",
//            );
            Toastr::success('Cập nhật danh mục thành công', 'Thành công');

            return to_route('category-rooms.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            $notification = array(
                "message" => "Cập nhật danh mục thất bại",
                "alert-type" => "error",
            );
            return back()->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        try {
            $categoryRoom = CategoryRoom::query()->findOrFail($id);
            if($categoryRoom->id===1){
                toastr()->error('Bạn không thể xóa danh mục này!', 'Thao tác thất bại');
                return redirect()->back();
            }
            $categoryRoom->delete();
            Toastr::success('Danh mục đã chuyển vào thùng rác', 'Thành công');

            return redirect()->route('category-rooms.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    public function deleted()
    {
        $data = CategoryRoom::onlyTrashed()->get();
        return view('admin.category-rooms.deleted', compact('data'));
    }
    public function permanentlyDelete(string $id)
    {
        try {
            $model = CategoryRoom::withTrashed()->findOrFail($id);
            $model->forceDelete();
            Toastr::success('Xoá thành công', 'Thành công');
            return back();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();
        }
    }

    public function restore(string $id)
    {
        try {
            $model = CategoryRoom::withTrashed()->findOrFail($id);
            $model->restore();
            Toastr::success('Khôi phục thành công', 'Thành công');
            return back();
        } catch (\Exception $exception) {
            Toastr::error('Khôi phục thất bại', 'Thất bại');
            return back();
        }
    }

    public function changeStatus(Request $request)
    {
        try {
            $categoryroom = CategoryRoom::find($request->categoryrooms_id);
            $categoryroom->status = $request->status;
            $categoryroom->save();
            return response()->json(['success' => 'Thay đổi trạng thái thành công']);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json(['error' => 'Thay đổi trạng thái thất bại']);
        }
    }
}
