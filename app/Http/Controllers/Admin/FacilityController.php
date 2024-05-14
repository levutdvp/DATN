<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FacilityRequest;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Brian2694\Toastr\Facades\Toastr;

class FacilityController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:facility-resource', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy', 'deleted', 'restore', 'permanentlyDelete']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Facility::query()->latest()->get();
        return view('admin.facility.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.facility.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FacilityRequest $request)
    {
        try {
            $model = new Facility();
            $model->fill($request->all());
            $selectIcon = $request->input('icon');
            $model->icon = $selectIcon;
            $model->save();
            // dd($selectIcon);

            Toastr::success('Thao tác thành công', 'Thành công');
            return to_route('facilities.index');

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Facility $facility)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Facility::query()->findOrFail($id);
        return view('admin.facility.edit', compact('data'));
        // return view('client.payment-status.notification-pay', compact('data'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(FacilityRequest $request, string $id)
    {
        try {
            $data = Facility::query()->findOrFail($id);
            $iconValue = $data->select_facility;
            $data->fill(\request()->all());
            if (empty($data->icon)) {
                $data->icon = $iconValue;
            }
            $data->save();
            Toastr::success('Thao tác thành công', 'Thành công');

            return to_route('facilities.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();
        }
    }

    /**
     * SoftDeleted the specified resource from storage.
     */

    public function destroy(string $id)
    {
        try {
            $data = Facility::query()->findOrFail($id);
            $data->delete();
            Toastr::success('Thao tác thành công', 'Thành công');
            return to_route('facilities.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();
        }
    }

    /**
     * Danh sách đã xoá mềm
     */

    public function listDeleted(){
            $data = Facility::onlyTrashed()->get();
            return view('admin.facility.delete', compact('data'));
    }

    /**
     * Xoá vĩnh viễn
     */

    public function permanentlyDelete($id)
    {
        try {
            $facility = Facility::where('id', $id);
            $facility->forceDelete();
            Toastr::success('Thao tác thành công', 'Thành công');
            return redirect()->back();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();
        }
    }

    /**
     * Thêm lại item trong thùng rác vào danh sách
     */

    public function restore($id){
        try {
            $softDeletedFacility = Facility::onlyTrashed()->find($id);
            $softDeletedFacility->restore();
            Toastr::success('Thao tác thành công', 'Thành công');
            return redirect()->back();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();
        }
    }
}
