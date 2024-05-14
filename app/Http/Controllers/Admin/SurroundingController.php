<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SurroundingRequest;
use App\Models\Surrounding;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SurroundingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:surrounding-resource', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy', 'listDeleted', 'restore', 'permanentlyDelete','changeStatus']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Surrounding::query()->latest()->get();
        return view('admin.surrounding.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.surrounding.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SurroundingRequest $request)
    {
        try {
            $model = new Surrounding();
            $model->fill($request->all());
            $model->save();
            Toastr::success('Thêm mới thành công!', 'Thành công');

            return to_route('surrounding.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            toastr()->error('Thao tác không thành công');
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Surrounding $facility)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Surrounding::query()->findOrFail($id);
        return view('admin.surrounding.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(SurroundingRequest $request, string $id)
    {
        try {
            $data = Surrounding::query()->findOrFail($id);
            $data->fill($request->all());
            $data->save();
            Toastr::success('Cập nhật thành công!', 'Thành công');

            return to_route('surrounding.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            toastr()->error('Thao tác không thành công');

            return back();
        }
    }

    /**
     * SoftDeleted the specified resource from storage.
     */

    public function destroy(string $id)
    {
        try {
            $data = Surrounding::query()->findOrFail($id);
            $data->delete();
            // delete_file($data->icon);
            $notification = array(
                "message" => "Xoá thành công!",
                "alert-type" => "success",
            );
            Toastr::success('Thêm vào thùng rác thành công!', 'Thành công');

            return to_route('surrounding.index')->with($notification);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            toastr()->error('Thao tác không thành công');

            return back();
        }
    }

    /**
     * Danh sách đã xoá mềm
     */

    public function listDeleted()
    {
        $data = Surrounding::onlyTrashed()->get();
        return view('admin.surrounding.delete', compact('data'));
    }

    /**
     * Xoá vĩnh viễn
     */

    public function permanentlyDelete($id)
    {
        try {
            $facility = Surrounding::where('id', $id);
            $facility->forceDelete();
            Toastr::success('Thêm mới thành công!', 'Thành công');
            return redirect()->back();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            toastr()->error('Thao tác không thành công');

            return back();
        }
    }

    /**
     * Thêm lại item trong thùng rác vào danh sách
     */

    public function restore($id)
    {

        try {
            $softDeletedFacility = Surrounding::onlyTrashed()->find($id);
            $softDeletedFacility->restore();
            Toastr::success('Xoá thành công!', 'Thành công');

            return redirect()->back();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            toastr()->error('Thao tác không thành công');

            return back();
        }
    }
}
