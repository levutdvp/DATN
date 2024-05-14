<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CouponRequest;
use App\Models\Coupon;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:coupon-resource', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy', 'deleted', 'restore', 'permanentlyDelete','changeStatus']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Coupon::query()->latest()->get();
        return view('admin.coupon.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CouponRequest $request)
    {
        try {
            $model = new Coupon();
            $model->fill($request->all());
            $model->save();
            Toastr::success('Thêm mã giảm giá thành công', 'Thành công');
            return to_route('coupons.index');
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
        $data = Coupon::query()->findOrFail($id);
        return view('admin.coupon.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CouponRequest $request, string $id)
    {
        try {
            $model = Coupon::query()->findOrFail($id);
            $model->fill($request->all());
            $model->save();
            Toastr::success('Sửa mã giảm giá thành công', 'Thành công');
            return to_route('coupons.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        try {
            $coupon->delete();
            Toastr::success('Mã giảm giá được thêm vào thùng rác thành công', 'Thành công');

            return redirect()->back();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();
        }
    }

    public function deleted()
    {
        $data = Coupon::onlyTrashed()->get();
        return view('admin.coupon.delete', compact('data'));
    }

    public function permanentlyDelete(String $id)
    {
        try {
            $coupon = Coupon::where('id', $id);
            $coupon->forceDelete();
            Toastr::success('Xoá mã giảm giá thành công', 'Thành công');
            return redirect()->back();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();
        }
    }

    public function restore(String $id)
    {
        try {
            $restore = Coupon::query()->onlyTrashed()->findOrFail($id);
            $restore->restore();
            Toastr::success('Khôi phục mã giảm giá thành công', 'Thành công');
            return redirect()->back();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();
        }
    }
    public function changeStatus(Request $request)
    {
        try {
            $coupon = Coupon::find($request->coupon_id);
            $coupon->status = $request->status;
            $coupon->save();
            return response()->json(['success' => 'Thay đổi trạng thái thành công']);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json(['error' => 'Thay đổi trạng thái thất bại']);
        }
    }
}
