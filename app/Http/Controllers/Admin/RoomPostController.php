<?php

namespace App\Http\Controllers\Admin;

use App\Events\RoomPostNotificationEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\RoomPostRequest;
use App\Http\Requests\Client\UpdateRoomPostRequest;
use App\Models\CancelHistory;
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
use App\Models\User;
use App\Models\Ward;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Tag;
use Carbon\Carbon;

class RoomPostController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:room-post-resource', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy', 'deleted', 'restore', 'permanentlyDelete', 'changeStatus', 'createImage', 'editMultiImage', 'deleteMultiImage']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category_rooms = CategoryRoom::all();
        $data = RoomPost::with('cancelHistories')->latest()->get();
        return view('admin.room-post.index', compact('data', 'category_rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categoryRooms = CategoryRoom::query()->where('status', 'active')->get();
        $services = Services::query()->latest()->get();
        $facilities = Facility::query()->latest()->get();
        $surrounding = Surrounding::query()->latest()->get();
        $category_rooms = CategoryRoom::all();
        $wards = Ward::all();
        $districts = District::all();
        return view('admin.room-post.create', compact('categoryRooms', 'facilities', 'surrounding', 'services', 'category_rooms', 'wards', 'districts'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(RoomPostRequest $request)
    {
        // dd($request->file('image'));
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
            foreach ($request->facility as $facility) {
                $surround = new FacilityRoom();
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
            Toastr::success('Thêm tin đăng phòng thành công', 'Thành công');
            return redirect()->route('admin-room-posts.index');
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

        $postroom = RoomPost::query()->findOrFail($id);
        $categoryRooms = CategoryRoom::query()->latest()->get();
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
        $wards = Ward::query()->find($id);
        $districts = District::query()->find($id);
        $cities = City::query()->find($id);
        $multiImgs = ImageRoom::query()->where('room_id', $id)->get();

        $tags = $postroom->tags->pluck('name')->implode(',');

        return view('admin.room-post.edit', compact('postroom', 'categoryRooms', 'facilities', 'surrounding', 'facilityArray', 'surroundingArray', 'wards', 'districts', 'cities', 'multiImgs', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomPostRequest $request, string $id)
    {
        try {
            $slug = Str::slug($request->name);
            $model = RoomPost::query()->findOrFail($id);
            $model->fill([
                'name' => $request->name,
                'slug' => $slug,
                'price' => $request->price,
                'address' => $request->address,
                'address_full' => $request->address_full,
                'acreage' => $request->acreage,
                'status' => 'pendding',
                'empty_room' => $request->empty_room,
                'description' => $request->description,
                'managing' => $request->managing,
                'category_room_id' => $request->category_room_id,
                'fullname' => $request->fullname,
                'phone' => $request->phone,
                'email' => $request->email,
                'zalo' => $request->zalo
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

            Toastr::success('Sửa tin đăng phòng thành công', 'Thành công');
            return redirect()->route('admin-room-posts.index');
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

    public function destroy(string $id)
    {
        try {
            FacilityRoom::query()->where('room_id', $id)->delete();
            SurroundingRoom::query()->where('room_id', $id)->delete();
            RoomPost::query()->findOrFail($id)->delete();
            Toastr::success('Tin đăng được thêm vào thùng rác thành công', 'Thành công');
            return redirect()->route('admin-room-posts.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();
        }
    }


    public function deleted()
    {
        $data = RoomPost::onlyTrashed()->get();
        return view('admin.room-post.deleted', compact('data'));
    }

    public function permanentlyDelete(String $id)
    {
        try {
            $room_post = RoomPost::query()->withTrashed()->findOrFail($id);
            $room_post->tags()->detach();
            $room_post->forceDelete();
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

    public function changeStatus(Request $request)
    {
        try {
            $room_post = RoomPost::find($request->room_post_id);
            $room_post->status = $request->status;
            $room_post->time_start = Carbon::now();
            $room_post->save();
            $user = User::findOrFail($room_post->user_id);
            if ($room_post->status === 'accept') {
                $content = [
                    'user' => $user->name,
                    'title' => 'Tin phòng đã được duyệt',
                    'description' => "Chúc mừng tin phòng $room_post->name của bạn đã được duyệt."
                ];
                $mailTo = User::findOrFail($room_post->user_id);
                event(new RoomPostNotificationEvent($mailTo, $content));
                $message="Mã tin ".$room_post->id." của bạn đã được duyệt.";
                $link_detail="tin-dang/".$room_post->slug;
                sendNotification($link_detail,$room_post->user_id,$message);

            } elseif ($room_post->status === 'cancel') {
                $history = new CancelHistory();
                $history->reason = $request->reason;
                $history->room_post_id = $request->room_post_id;
                $history->save();
                $content = [
                    'user' => $user->name,
                    'title' => 'Tin phòng của bạn đã bị từ chối',
                    'description' => "Tin phòng $room_post->name không được thông qua với lý do: " . $request->reason
                ];
                $mailTo = User::findOrFail($room_post->user_id);
                event(new RoomPostNotificationEvent($mailTo, $content));
                $message = "Mã tin " . $room_post->id . " của bạn đã bị từ chối vui lòng cập nhật lại tin đăng.";
                $link_detail = "room-posts/" . $room_post->id . "/edit";
                sendNotification($link_detail, $room_post->user_id, $message);
            }
            $room_post->save();
            return response()->json(['success' => 'Thay đổi trạng thái thành công', 'room_post_id' => $request->room_post_id, 'time_start' => $room_post->time_start->format('Y-m-d H:i:s'), 'reason' => $request->reason]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json(['error' => 'Thay đổi trạng thái thất bại']);
        }
    }
}
