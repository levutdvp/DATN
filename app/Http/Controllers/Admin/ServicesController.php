<?php

namespace App\Http\Controllers\Admin;

use App\Models\Services;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ServicesRequest;
use Brian2694\Toastr\Facades\Toastr;


class ServicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:service-resource', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy', 'deleted', 'restore', 'permanentlyDelete','changeStatus']]);
    }

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        //
        $services = Services::query()->latest()->get();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServicesRequest $request)
    {
        //

        try {
            $model = new Services();
            $model->fill($request->all());
            $model->save();
            // return redirect()->route('services.index')->with($notification);
            Toastr::success('Thêm dịch vụ thành công', 'Thành công');
            return redirect()->route('services.index');
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
        //
        $services_one = Services::query()->findOrFail($id);
        return view('admin.services.edit', compact('services_one'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServicesRequest $request, string $id)
    {
        //
        try {
            $model = Services::query()->findOrFail($id);
            $model->fill($request->all());
            $model->save();

            // return redirect()->route('services.index')->with($notification);
            Toastr::success('Cập nhật dịch vụ thành công', 'Thành công');
            return redirect()->route('services.index');
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
        //
        try {
            $model = Services::query()->findOrFail($id);
            $model->delete();
            // return redirect()->back()->with('msg', ['success' => true, 'message' => 'Thao tác  thành công']);
            Toastr::success('Thêm dịch vụ thành công', 'Thành công');
            return redirect()->route('services.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('msg', ['success' => false, 'message' => 'Thao tác không thành công']);
        }
    }
    public function deleted()
    {
        $services_deleted = Services::onlyTrashed()->get();
        return view('admin.services.delete', compact('services_deleted'));
    }

    public function permanentlyDelete(String $id)
    {
        try {
            $model = Services::where('id', $id);
            $model->forceDelete();
            // return redirect()->back()->with('msg', ['success' => true, 'message' => 'Thao tác thành công']);
            // return redirect()->route('services.deleted')->with('success', 'Thao tác thành công');

            Toastr::success('Thao tác thành công', 'Thành công');
            return redirect()->back();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();
        }
    }

    public function restore(String $id)
    {
        $model = Services::query()->onlyTrashed()->findOrFail($id);
        $model->restore();
        Toastr::success('Thao tác thành công', 'Thành công');
        return redirect()->back();
    }
}
