<?php

namespace App\Http\Controllers\Client;

use App\Events\RoomPostNotificationEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\RoomPostRequest;
use App\Http\Requests\Client\UpdateRoomPostRequest;
use App\Models\CategoryRoom;
use App\Models\City;
use App\Models\District;
use App\Models\Facility;
use App\Models\FacilityRoom;
use App\Models\ImageRoom;
use App\Models\RoomPost;
use App\Models\Services;
use App\Models\Surrounding;
use App\Models\SurroundingRoom;
use App\Models\Tag;
use App\Models\User;
use App\Models\Ward;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RoomPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $category_rooms = CategoryRoom::all()->where('status', 'active');
        $wards = Ward::all();
        $districts = District::whereHas('roomPosts', function ($query) {
            $query->where('status', 'accept');
        })->distinct()->pluck('name');
        $data = RoomPost::with('cancelHistories')->where('user_id', auth()->user()->id)->latest()->get();
        return view('client.room-post.index', compact('data', 'category_rooms', 'wards', 'districts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $wards = Ward::all();
        $districts = District::whereHas('roomPosts', function ($query) {
            $query->where('status', 'accept');
        })->distinct()->pluck('name');
        $category_rooms = CategoryRoom::query()->where('status', 'active')->get();
        $services = Services::query()->get();
        $facilities = Facility::query()->get();
        $surrounding = Surrounding::query()->get();
        return view('client.room-post.create', compact('category_rooms', 'facilities', 'surrounding', 'services', 'districts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomPostRequest $request)
    {

        try {
            if ($request->hasFile('imageroom')) {
                $uploadFile = upload_file('room', $request->file('imageroom'));
            }
            $slug = Str::slug($request->name);

            $ward = new Ward();
            $ward->fill([
                'name' => $request->ward_id,
            ]);
            $ward->save();

            $district = new District();
            $district->fill([
                'name' => $request->district_id,
                'ward_id' => $ward->id,
            ]);
            $district->save();
            $city = new City();
            $city->fill([
                'name' => $request->city_id,
                'district_id' => $district->id,
            ]);
            $city->save();

            $model = new RoomPost();

            $model->fill([
                'name' => $request->name,
                'slug' => $slug,
                'price' => $request->price,
                'address' => $request->address,
                'address_full' => $request->address_full,
                'acreage' => $request->acreage,
                'empty_room' => $request->empty_room,
                'description' => $request->description,
                'image' => $uploadFile,
                'managing' => $request->managing,
                'user_id' => auth()->user()->id,
                'ward_id' => $ward->id,
                'district_id' => $district->id,
                'city_id' => $city->id,
                'category_room_id' => $request->category_room_id,
                'fullname' => $request->fullname,
                'phone' => $request->phone,
                'email' => $request->email,
                'zalo' => $request->zalo
            ]);
            $model->save();



            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $image) {
                    $uploadFiles = upload_file('room/image', $image);
                    $imageModel = new ImageRoom();
                    $imageModel->room_id = $model->id;
                    $imageModel->name = $uploadFiles;
                    $imageModel->save();
                }
            }

            foreach ($request->surrounding as $surrounding) {
                $surround = new SurroundingRoom();
                $surround->room_id = $model->id;
                $surround->surrounding_id = $surrounding;
                $surround->save();
            }
            // dd($request->facility);
            foreach ($request->facility as $facility) {
                $surround = new  FacilityRoom();
                $surround->room_id = $model->id;
                $surround->facility_id = $facility;
                $surround->save();
            }

            if ($request->filled('tags')) {
                $tagNames = explode(',', $request->input('tags'));

                foreach ($tagNames as $tagName) {
                    $slug = Str::slug(trim($tagName));

                    $tag = Tag::firstOrCreate(['name' => trim($tagName), 'slug' => $slug]);

                    $model->tags()->syncWithoutDetaching([$tag->id]);
                }
            }
            $mailTo = User::where('role', 'admin')->first();
            $content = [
                'user' => $mailTo->name,
                'title' => 'Cần xác nhận tin phòng mới',
                'description' => "Người dùng " . auth()->user()->name . " vừa đăng 1 tin phòng với tiêu đề {$model->name} , xin mời bạn truy cập website và xác nhận phòng"
            ];
            event(new RoomPostNotificationEvent($mailTo, $content));
            $message = "Mã tin " . $model->id . " vừa đăng cần được xác nhận ngay.";
            $link_detail = "admin-room-posts";
            notificationDB($link_detail, $message);
            Toastr::success('Thêm tin đăng phòng thành công', 'Thành công');
            return redirect()->route('room-posts.index');
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
        $districts = District::whereHas('roomPosts', function ($query) {
            $query->where('status', 'accept');
        })->distinct()->pluck('name');
        $postroom = RoomPost::query()->findOrFail($id);
        $category_rooms = CategoryRoom::query()->where('status', 'active')->get();
        $facilities = Facility::query()->latest()->get();
        $facilityrooms = FacilityRoom::query()->where('room_id', $id)->get();
        foreach ($facilityrooms as $facilityroom) {
            $facilityArray[] = $facilityroom->facility_id;
        }
        $surrounding = Surrounding::query()->latest()->get();
        $surroundingooms = SurroundingRoom::query()->where('room_id', $id)->get();
        foreach ($surroundingooms as $surroundingoom) {
            $surroundingArray[] = $surroundingoom->surrounding_id;
        }
        $ward = Ward::query()->find($id);
        $district = District::query()->find($id);
        $citie = City::query()->find($id);
        $multiImgs = ImageRoom::query()->where('room_id', $id)->get();
        $tags = $postroom->tags->pluck('name')->implode(',');

        return view('client.room-post.edit', compact('postroom', 'category_rooms', 'districts', 'facilities', 'surrounding', 'facilityArray', 'surroundingArray', 'ward', 'district', 'citie', 'multiImgs', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomPostRequest $request, string $id)
    {
        try {
            $slug = Str::slug($request->name);
            $model = RoomPost::query()->findOrFail($id);
            if ($model->status === "accept" || $model->status==="cancel") {
                $message = "Mã tin " . $model->id . " vừa cập nhật cần được xác nhận ngay.";
                $link_detail = "admin-room-posts";
                notificationDB($link_detail, $message);
            }
            $model->fill([
                'name' => $request->name,
                'slug' => $slug,
                'price' => $request->price,
                'address' => $request->address,
                'address_full' => $request->address_full,
                'acreage' => $request->acreage,
                'empty_room' => $request->empty_room,
                'description' => $request->description,
                'managing' => $request->managing,
                'status' => 'pendding',
                'category_room_id' => $request->category_room_id,
                'fullname' => $request->fullname,
                'phone' => $request->phone,
                'email' => $request->email,
                'zalo' => $request->zalo,
            ]);
            $oldImg = $model->imageroom;
            if ($request->hasFile('imageroom')) {
                $model->image = upload_file('room', $request->file('imageroom'));
            } else {
                $model->image = $request->old_imageroom;
            }
            $model->save();

            if (\request()->hasFile('imageroom') && $oldImg) {
                delete_file($oldImg);
            }
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $image) {
                    $uploadFiles = upload_file('room/image', $image);
                    $imageModel = new ImageRoom();
                    $imageModel->room_id = $model->id;
                    $imageModel->image = $uploadFiles;
                    $imageModel->save();
                }
            }
            $model->surrounds()->sync($request->surrounding);
            $model->facilities()->sync($request->facility);
            $ward = Ward::find($model->ward->id);;
            $ward->update([
                'name' => $request->ward_id,
            ]);
            $ward->save();
            $district = District::find($model->district->id);
            $district->update([
                'name' => $request->district_id,
                'ward_id' => $ward->id,
            ]);
            $district->save();
            $city = City::find($model->city->id);
            $city->update([
                'name' => $request->city_id,
                'district_id' => $district->id,
            ]);
            $city->save();

            if ($request->filled('tags')) {
                $tagNames = explode(',', $request->input('tags'));

                $model->tags()->sync([]); // Xóa tất cả các tags hiện tại và cập nhật lại
                foreach ($tagNames as $tagName) {
                    $slug = Str::slug(trim($tagName));
                    $tag = Tag::firstOrCreate(['name' => trim($tagName), 'slug' => $slug]);
                    $model->tags()->attach($tag->id);
                }
            } else {
                // Nếu trường 'tags' trống, xóa tất cả các tag liên kết với bài viết
                $model->tags()->detach();
            }
            $mailTo = User::where('role', 'admin')->first();
            $content = [
                'user' => $mailTo->name,
                'title' => 'Cần xác nhận tin phòng vừa cập nhật',
                'description' => "Người dùng " . auth()->user()->name . " vừa cập nhật phòng tin phòng có tiêu đề {$model->name} , xin mời bạn truy cập website và xác nhận phòng"
            ];
            event(new RoomPostNotificationEvent($mailTo, $content));


            Toastr::success('Sửa tin đăng phòng thành công', 'Thành công');
            return redirect()->route('room-posts.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();
        }
    }



    public function createImage(Request $request)
    {

        if ($request->hasFile('add_image')) {
            foreach ($request->file('add_image') as $image) {
                $uploadFile = upload_file('room/image', $image);
                $images = new ImageRoom();
                $images->name = $uploadFile;
                $images->room_id = $request->id_room;
                $images->save();
            }
        }
        Toastr::success('Thêm ảnh thành công', 'Thành công');
        return redirect()->back();
    }

    public function editMultiImage(Request $request)
    {

        if ($request->isMethod('post')) {
            $params = $request->post();
            unset($params['_token']);

            if ($request->hasFile('image')) {
                $imgs = $request->file('image');
                foreach ($imgs as $id => $img) {
                    $update = ImageRoom::findOrFail($id);

                    if ($img->isValid()) {
                        Storage::delete('room/image' . $update->image);
                        $fileName = upload_file('room/image', $img);
                        $multi = $fileName;
                    } else {
                        $multi = $update->image;
                    }
                    ImageRoom::where('id', $id)->update([
                        'name' => $multi
                    ]);
                }
            }
            Toastr::success('Sửa ảnh thành công', 'Thành công');

            return redirect()->back();
        }
    }

    public function deleteMultiImage($id)
    {
        if ($id) {
            $image = ImageRoom::find($id);

            if ($image) {
                Storage::delete('room/image' . $image->image);
                $deleted = $image->delete();
                if ($deleted) {
                    Toastr::success('Xoá ảnh thành công', 'Thành công');
                } else {
                    Toastr::error('Thao tác thất bại', 'Thất bại');
                }
            } else {
                Toastr::error('Thao tác thất bại', 'Thất bại');
            }
            return redirect()->back();
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        try {

            FacilityRoom::query()->where('room_id', $id)->delete();
            SurroundingRoom::query()->where('room_id', $id)->delete();
            RoomPost::query()->findOrFail($id)->delete();
            Toastr::success('Tin đăng được thêm vào thùng rác thành công', 'Thành công');
            return redirect()->route('room-posts.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();
        }
    }


    public function deleted()
    {
        $districts = District::whereHas('roomPosts', function ($query) {
            $query->where('status', 'accept');
        })->distinct()->pluck('name');
        $category_rooms = CategoryRoom::all()->where('status', 'active');
        $wards = Ward::all();
        $data = RoomPost::onlyTrashed()->where('user_id', auth()->user()->id)->get();
        return view('client.room-post.deleted', compact('data', 'category_rooms', 'wards', 'districts'));
    }

    public function permanentlyDelete(String $id)
    {
        try {

            $RoomPost = RoomPost::where('id', $id);
            $RoomPost->forceDelete();
            $facility = FacilityRoom::query()->where('room_id', $id);
            $facility->forceDelete();
            $surrounding = SurroundingRoom::query()->where('room_id', $id);
            $surrounding->forceDelete();
            Toastr::success('Xoá tin đăng thành công', 'Thành công');
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
            $facility = FacilityRoom::query()->onlyTrashed()->where('room_id', $id);
            $facility->restore();

            $surrounding = SurroundingRoom::query()->onlyTrashed()->where('room_id', $id);
            $surrounding->restore();

            $RoomPost = RoomPost::query()->onlyTrashed()->findOrFail($id);
            $RoomPost->restore();

            Toastr::success('Khôi phục tin đăng thành công', 'Thành công');
            return redirect()->back();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();
        }
    }
}
