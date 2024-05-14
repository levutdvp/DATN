<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use Yoeunes\Toastr\Facades\Toastr;



class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:setting-resource', ['only' => ['index','update']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Setting::query()->first();
        return view('admin.setting.edit', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SettingRequest $request, $id)
    {
        $data = Setting::query()->first();
        try {
            $oldLogo = $data->logo;

            $data->fill($request->except('logo','favicon'));

            if ($request->hasFile('logo')) {
                $newLogo = upload_file('settings/logo', $request->file('logo'));
                $data->logo = $newLogo;
            }

            // upload favicon
            $oldFavicon = $data->favicon;

            if ($request->hasFile('favicon')) {
                $newFavicon = upload_file('settings/favicon', $request->file('favicon'));
                $data->favicon = $newFavicon;
            }


            $data->save();

            // Kiểm tra nếu có ảnh mới và ảnh cũ tồn tại, thì xóa ảnh cũ
            if ($request->hasFile('logo') && $oldLogo) {
                delete_file($oldLogo);
            }
            if ($request->hasFile('favicon') && $oldFavicon) {
                delete_file($oldFavicon);
            }

            Toastr::success('Cập nhật cài đặt thành công', 'Thành công');

            return back();
        } catch (\Exception $exception) {
            Log::error('Exception', [$exception]);
            Toastr::success('Cập nhật cài đặt thất bại', 'Thất bại');

            return back();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
