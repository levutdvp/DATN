<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\AdvertisementRequest;


class AdvertisementController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:advertisement-resource', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy', 'deleted', 'restore', 'permanentlyDelete','changeStatus']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Advertisement::query()->latest()->get();
        return view('admin.advertisement.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.advertisement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdvertisementRequest $request)
    {
        try {
            $data = new Advertisement();
            $data->fill($request->except('image'));
            if ($request->hasFile('image')) {
                $data->image = upload_file(OBJECT_ADVERTISEMENT, $request->file('image'));
            }
            $data->save();
            Toastr::success('Thêm ảnh quảng cáo thành công', 'Thành công');
            return to_route('advertisements.index');
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
        $data = Advertisement::query()->findOrFail($id);
        return view('admin.advertisement.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdvertisementRequest $request, string $id)
    {
        $data = Advertisement::query()->findOrFail($id);
        try {
            $oldImg = $data->image; // Lưu ảnh cũ

            $data->fill($request->except('image'));

            if ($request->hasFile('image')) {
                $newImg = upload_file(OBJECT_ADVERTISEMENT, $request->file('image')); // Tải lên ảnh mới
                $data->image = $newImg;
            }

            $data->save();

            // Kiểm tra nếu có ảnh mới và ảnh cũ tồn tại, thì xóa ảnh cũ
            if ($request->hasFile('image') && $oldImg) {
                delete_file($oldImg);
            }
            Toastr::success('Cập nhật ảnh quảng cáo thành công', 'Thành công');

            return to_route('advertisements.index')
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
            $data = Advertisement::query()->findOrFail($id);
            $data->delete();
            Toastr::success('Ảnh quảng cáo đã chuyển vào thùng rác', 'Thành công');

            return to_route('advertisements.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();
        }
    }

    public function deleted()
    {
        $data = Advertisement::query()->onlyTrashed()->get();
        return view('admin.advertisement.delete', compact('data'));
    }

    public function restore(string $id)
    {
        try {
            $restore = Advertisement::query()->onlyTrashed()->findOrFail($id);
            $restore->restore();
            Toastr::success('Khôi phục ảnh quảng cáo thành công', 'Thành công');
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
            $coupon = Advertisement::query()->where('id', $id);
            $coupon->forceDelete();
            Toastr::success('Xoá ảnh quảng cáo thành công', 'Thành công');

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
            $advertisement = Advertisement::find($request->advertisement_id);
            $advertisement->status = $request->status;
            $advertisement->save();
            return response()->json(['success' => 'Thay đổi trạng thái thành công']);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json(['error' => 'Thay đổi trạng thái thất bại']);
        }
    }
}
