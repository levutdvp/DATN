<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\CategoryPost;
use App\Models\CategoryRoom;
use App\Models\District;
use App\Models\ImageRoom;
use Carbon\Carbon;
use App\Models\Post;
use App\Models\RoomPost;
use App\Models\Ward;
use App\Models\Bookmark;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{
    public function index()
    {
        $currentDateTime = Carbon::now();
        $category_rooms = CategoryRoom::all()->where('status', 'active');
        $wards = Ward::all();
        $districts = District::whereHas('roomPosts', function ($query) {
            $query->where('status', 'accept');
        })->distinct()->pluck('name');
        $room_post_vip = RoomPost::with(['facilities' => function ($query) {
            $query->inRandomOrder()->take(6);
        }])
            ->where('status', 'accept')
            ->whereIn('service_id', [1, 2, 3])
            ->where('time_end', '>', Carbon::now())
            ->orderBy(DB::raw('FIELD(service_id, 1, 2, 3)'))
            ->inRandomOrder()
            ->get();
        // dd($room_post_vip);
        $room_post_new = RoomPost::latest('time_start')->where('status', 'accept')->limit(30)->paginate(6);
        // dd($room_post_new);
        $posts = Post::with('user')->where('status', 'active')->latest('id')->limit(6)->get();
        $banners = Banner::query()->where('status', 'active')->latest()->limit(3)->get();
        //đếm số tin đăng ,user ,bài viết
        $count_room = RoomPost::where('status', 'accept')->count();
        $count_user = count(User::all());
        $count_post = Post::where('status', 'active')->count();
        // dd($count_room,$count_post);
        // Share media
        // $share_content=HOME_URL;
        // $shareComponent = \Share::page(
        //     $share_content,
        //     'chia se fb cua quang phuc vip pro',
        // )
        //     ->facebook()
        //     ->twitter()
        //     ->reddit();
        return view('client.layouts.home', compact('category_rooms', 'wards', 'districts', 'room_post_vip', 'room_post_new', 'posts', 'count_room', 'count_user', 'count_post', 'banners', 'currentDateTime'));
    }
    public function bookmark(Request $request)
    {
        if (Auth::check()) {
            $room_post_id = $request['room_post_id'];
            $user_id = auth()->user()->id;
            // $existingBookmark = Bookmark::where('user_id', $user_id)
            //     ->where('room_post_id', $id)
            //     ->first();

            // if (!$existingBookmark) {
            $model = new Bookmark();
            $model->user_id = $user_id;
            $model->room_post_id = $room_post_id;
            $model->save();
            $bm = Bookmark::where('user_id', $user_id)
                ->whereHas('roomPost', function ($query) {
                    $query->where('status', 'accept');
                })
                ->count();
            return response()->json([
                // 'data' => $request->all(),
                'bm' => $bm
            ]);
            // }
        } else {
             return response()->json([
                'error' => 'Vui lòng đăng nhập'
            ]);
        }
    }
    public function listBookmark()
    {
        $category_rooms = CategoryRoom::all()->where('status', 'active');
        $districts = District::distinct()->pluck('name');
        if (Auth::check()) {
            $user_id = auth()->user()->id;
            $room_posts = RoomPost::latest()->with('facilities')->paginate(10);
            $data = Bookmark::where('user_id', $user_id)
                ->whereHas('roomPost', function ($query) {
                    $query->where('status', 'accept');
                })
                ->with('roomPost')
                ->paginate(6);
            $categories = CategoryRoom::withCount('roomPosts')
                ->having('room_posts_count', '>', 0)
                ->paginate(4);
            $posts = Post::latest()->paginate(5);

            return view('client.bookmark', compact('category_rooms', 'districts', 'data', 'categories', 'posts', 'room_posts'));
        } else {
            toastr()->error('Bạn cần phải đăng nhập', 'Thất bại');
            return redirect('/client-login');
        }
    }
    public function unBookmark(Request $request, string $id)
    {
        try {
            $room_post_id = $request['room_post_id'];

            $user_id = auth()->user()->id;
            $model = Bookmark::where('user_id', $user_id)
                ->where('room_post_id', $room_post_id)
                ->firstOrFail();
            $model->delete();

            $bm = Bookmark::where('user_id', $user_id)
                ->whereHas('roomPost', function ($query) {
                    $query->where('status', 'accept');
                })
                ->count();
            return response()->json([
                // 'data' => $request->all(),
                'bm' => $bm
            ]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            toastr()->error('Có lỗi xảy ra', 'Thử lại sau');
            return back();
        }
    }
    public function unBookmarkbm(Request $request, $id)
    {
        try {
            $model = Bookmark::where('id', $request['id']); // Sử dụng $id thay vì $request['id']
            $model->delete();
            $user_id = auth()->user()->id;
            $bm = Bookmark::where('user_id', $user_id)
                ->whereHas('roomPost', function ($query) {
                    $query->where('status', 'accept');
                })
                ->count();
            return response()->json([
                // 'data' => $request->all(),
                'bm' => $bm
            ]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            toastr()->error('Có lỗi xảy ra', 'Thử lại sau');
            return back();
        }
    }

    public function filter_list(Request $request)
    {
        $category_rooms = CategoryRoom::query()->where('status', 'active')->latest()->get();
        $wards = Ward::query()->latest()->get();
        $districts = District::whereHas('roomPosts', function ($query) {
            $query->where('status', 'accept');
        })->distinct()->pluck('name');

        $selectedPrice = request()->input('price_filter');
        $selectedAcreage = request()->input('acreage_filter');
        $selectedRoomType = request()->input('room_type_filter');
        $selectedDistrict = request()->input('district_filter');
        $search = request()->input('name_filter');

        $tags = RoomPost::with(['tags' => function ($query) {
            $query->where('status', 'active');
        }])
            ->get()
            ->pluck('tags.*.name')
            ->flatten()
            ->unique()
            ->take(6);

        $query = RoomPost::query()
            ->with('categoryroom', 'district', 'tags')
            ->where('status', 'accept');

        // tìm theo từ nhập vào input và theo tags
        if ($search != null) {
            $query->where('name', 'like', '%' . $search . '%');
            $query->orWhereHas('tags', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }

        if ($selectedRoomType != null) {
            if ($selectedRoomType !== 'all') {
                $query->where('category_room_id', $selectedRoomType);
            }
        }

        if ($selectedDistrict != null) {
            if ($selectedDistrict !== 'all') {
                $query->whereHas('district', function ($q) use ($selectedDistrict) {
                    $q->where('name', $selectedDistrict);
                });
            }
        }

        // Lọc theo giá
        if ($selectedPrice != null) {
            if ($selectedPrice === 'all') {
                // Không cần thêm điều kiện nếu chọn tất cả
            } elseif ($selectedPrice === 'range_price1') {
                $query->whereBetween('price', [0, 1000000]);
            } elseif ($selectedPrice === 'range_price2') {
                $query->whereBetween('price', [1000000, 2000000]);
            } elseif ($selectedPrice === 'range_price3') {
                $query->whereBetween('price', [2000000, 3000000]);
            } elseif ($selectedPrice === 'range_price4') {
                $query->whereBetween('price', [3000000, 5000000]);
            } elseif ($selectedPrice === 'range_price5') {
                $query->whereBetween('price', [5000000, 7000000]);
            } elseif ($selectedPrice === 'range_price6') {
                $query->whereBetween('price', [7000000, 10000000]);
            } elseif ($selectedPrice === 'range_price7') {
                $query->where('price', '>=', 10000000);
            }
        }

        // Lọc theo diện tích
        if ($selectedAcreage != null) {
            if ($selectedAcreage === 'allacreage') {
                // Không cần thêm điều kiện nếu chọn tất cả
            } elseif ($selectedAcreage === 'range_acreage1') {
                $query->whereBetween('acreage', [0, 15]);
            } elseif ($selectedAcreage === 'range_acreage2') {
                $query->whereBetween('acreage', [15, 25]);
            } elseif ($selectedAcreage === 'range_acreage3') {
                $query->whereBetween('acreage', [25, 45]);
            } elseif ($selectedAcreage === 'range_acreage4') {
                $query->whereBetween('acreage', [45, 75]);
            } elseif ($selectedAcreage === 'range_acreage5') {
                $query->where('acreage', '>=', 75);
            }
        }

        // Sắp xếp bằng cách sử dụng CASE
        $currentDateTime = Carbon::now();
        $query->orderByRaw("CASE WHEN service_id = 1 AND time_end > '$currentDateTime' THEN 1 WHEN service_id = 2 AND time_end > '$currentDateTime' THEN 2 WHEN service_id = 3 AND time_end > '$currentDateTime' THEN 3 ELSE 4 END");
        // dd($query->get());
        $room = $query->latest('time_start')->paginate(5);
        // dd($room);
        $totalResults = $room->total();

        // dd($room);
        return view('client.layouts.search', compact(
            'category_rooms',
            'wards',
            'districts',
            'room',
            'totalResults',
            'selectedPrice',
            'selectedAcreage',
            'selectedDistrict',
            'selectedRoomType',
            'search',
            'tags',
            'currentDateTime'
        ));
    }

    public function countPrice()
    {
        // Thực hiện logic để đếm số lượng mục trong phạm vi giá cụ thể ($minPrice đến $maxPrice)
        // Replace this logic with your actual implementation

    }

    public function roomPostDetail(String $slug)
    {
        $category_rooms = CategoryRoom::all()->where('status', 'active');
        $districts = District::distinct()->pluck('name');
        $search = request()->input('name_filter');
        $categories = CategoryRoom::withCount('roomPosts')
            ->having('room_posts_count', '>', 0)
            ->paginate(4);
        $posts = Post::latest()->paginate(5);

        $roomposts = RoomPost::where('slug', $slug)
            ->with('facilities', 'surrounds')
            ->firstOrFail();

        if ($search != null) {
            $roomposts->where('name', 'like', '%' . $search . '%')
                ->orWhereHas('tags', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
        }
        $caterooms = RoomPost::query()->with('facilities', 'surrounds')
            ->where('id', '!=', $roomposts->id)
            ->where('category_room_id', $roomposts->category_room_id)
            ->where('status', 'accept')
            ->get();

        $images = ImageRoom::query()->where('room_id', $roomposts->id)->get();
        $share_content = DETAIL_ROOM_URL;

        $shareComponent = \Share::page(
            $share_content . $roomposts->slug,
        )
            ->facebook()
            ->twitter()
            ->reddit();
        $tags = $roomposts->tags;
        return view('client.room-post.detail', compact('search', 'tags', 'category_rooms', 'districts', 'roomposts', 'images', 'caterooms', 'categories', 'posts', 'shareComponent'));
    }
}
