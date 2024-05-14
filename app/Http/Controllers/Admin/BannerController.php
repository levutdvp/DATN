<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;



class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:banner-resource', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy', 'deleted', 'restore', 'permanentlyDelete','changeStatus']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Banner::query()->latest()->get();
        return view('admin.banner.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerRequest $request)
    {
        try {
            $data = new Banner();
            $data->fill($request->except('image'));
            if ($request->hasFile('image')) {
                $data->image = upload_file(OBJECT_BANNER, $request->file('image'));
            }
            $data->save();
            Toastr::success('Thêm banner thành công', 'Thành công');
            return to_route('banners.index');
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
        $data = Banner::query()->findOrFail($id);
        return view('admin.banner.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Banner::query()->findOrFail($id);
        try {
            $oldImg = $data->image; // Lưu ảnh cũ

            $data->fill($request->except('image'));

            if ($request->hasFile('image')) {
                $newImg = upload_file(OBJECT_BANNER, $request->file('image')); // Tải lên ảnh mới
                $data->image = $newImg;
            }

            $data->save();

            // Kiểm tra nếu có ảnh mới và ảnh cũ tồn tại, thì xóa ảnh cũ
            if ($request->hasFile('image') && $oldImg) {
                delete_file($oldImg);
            }
            Toastr::success('Cập nhật banner thành công', 'Thành công');

            return to_route('banners.index')
                ->with('status', Response::HTTP_OK);
        } catch (\Exception $exception) {
            Log::error('Exception', [$exception]);
            Toastr::error('Thao tác thất bại', 'Thất bại');

            return back()
                ->with('status', Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = Banner::query()->findOrFail($id);
            $data->delete();
            Toastr::success('Banner đã chuyển vào thùng rác', 'Thành công');

            return to_route('banners.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();
        }
    }

    public function deleted()
    {
        $data = Banner::query()->onlyTrashed()->get();
        return view('admin.banner.delete', compact('data'));
    }

    public function restore(string $id)
    {
        try {
            $restore = Banner::query()->onlyTrashed()->findOrFail($id);
            $restore->restore();
            Toastr::success('Khôi phục banner thành công', 'Thành công');
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
            $coupon = Banner::query()->where('id', $id);
            $coupon->forceDelete();
            Toastr::success('Xoá banner thành công', 'Thành công');

            return back();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();
        }
    }
    public function changeStatus(Request $request)
    {
        try {
            $banner = Banner::find($request->banner_id);
            $banner->status = $request->status;
            $banner->save();
            return response()->json(['success' => 'Thay đổi trạng thái thành công']);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json(['error' => 'Thay đổi trạng thái thất bại']);
        }
    }
}
