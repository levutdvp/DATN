<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomPost;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RoomPostExport;


class ReportRoomPostControler extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:report-resource', ['only' => ['index','fillterRoompost','exportRoomPost']]);
    }

    public function index()
    {
        //
        $room_post = RoomPost::query()->count();
        $room_post_today = RoomPost::query()->whereDate('created_at', today())->count();
        $room_post_accept = RoomPost::query()->where('status', 'accept')->count();
        $room_post_accept_today = RoomPost::query()->where('status', 'accept')->whereDate('created_at', today())->count();
        $room_post_pendding = RoomPost::query()->where('status', 'pendding')->count();
        $room_post_pendding_today = RoomPost::query()->where('status', 'pendding')->whereDate('created_at', today())->count();
        $room_post_vip = RoomPost::query()->whereNotNull('service_id')->where('time_end', '>', Carbon::now())->count();
        $room_post_default = RoomPost::query()->whereNull('service_id')->orWhere('time_end', '<', Carbon::now())->count();
        // dd($room_post_vip,$room_post_default);
        $total_room_post= RoomPost::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total_posts'))->groupBy('date')->orderBy('date')->get();
            // dd($total_room_post);
        return view('admin.report.room-post.index', compact('room_post', 'room_post_today', 'room_post_accept', 'room_post_accept_today', 'room_post_pendding', 'room_post_pendding_today', 'room_post_vip', 'room_post_default','total_room_post'));
    }

    //
    public function fillterRoompost(Request $request)
    {
        $date_start = $request->input('date_start');
        if ($date_start === null) {
            $date_start = 0;
        }
        $date_end = $request->input('date_end');
        if ($date_end === null) {
            $date_end = Carbon::now();
        }
        $query = RoomPost::query();
        if ($date_end != null) {
            $query->where('created_at', '<=', $date_end);
        }
        if ($date_start == null && $date_end == null) {
            $query->where('created_at', '<=', Carbon::now());
        }
        if ($date_start != null) {
            $query->where('created_at', '>=', $date_start);
        }
        $room_post = $query->count(); //
        $room_post_today = RoomPost::query()->whereDate('created_at', today())->count();
        $room_post_accept = $query->where('status', 'accept')->count(); //
        $room_post_accept_today = RoomPost::query()->where('status', 'accept')->whereDate('created_at', today())->count();
        $room_post_pendding = $query->where('status', 'pendding')->count();
        $room_post_pendding_today = RoomPost::query()->where('status', 'pendding')->whereDate('created_at', today())->count();
        $room_post_vip = RoomPost::query()->whereNotNull('service_id')->where('time_end', '>', Carbon::now())->count();
        $room_post_default = RoomPost::query()->whereNull('service_id')->orWhere('time_end', '<', Carbon::now())->count();
        $total_room_post= RoomPost::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total_posts'))->groupBy('date')->orderBy('date')->get();
        return view('admin.report.room-post.index', compact('date_start', 'date_end', 'room_post', 'room_post_today', 'room_post_accept', 'room_post_accept_today', 'room_post_pendding', 'room_post_pendding_today', 'room_post_vip', 'room_post_default','total_room_post'));
    }

    public function exportRoomPost() {
        $roomPost = RoomPost::query()->count();
        $roomPostToday = RoomPost::query()->whereDate('created_at', today())->count();
        $roomPostToday = RoomPost::query()->where('status', 'accept')->count();
        $roomPostAcceptToday = RoomPost::query()->where('status', 'accept')->whereDate('created_at', today())->count();
        $roomPostPending = RoomPost::query()->where('status', 'pendding')->count();
        $roomPostPendingToday = RoomPost::query()->where('status', 'pendding')->whereDate('created_at', today())->count();
        $roomPostVIP = RoomPost::query()->whereNotNull('service_id')->where('time_end', '>', Carbon::now())->count();
        $roomPostDefault = RoomPost::query()->whereNull('service_id')->orWhere('time_end', '<', Carbon::now())->count();

        $totalRoomPost= RoomPost::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total_posts'))->groupBy('date')->orderBy('date')->get();

        return Excel::download(
            new RoomPostExport(
                $roomPost, $roomPostToday, $roomPostToday, $roomPostAcceptToday, $roomPostPending,
                $roomPostPendingToday, $roomPostVIP, $roomPostDefault, $totalRoomPost
            ),
            'bao_cao_tin_dang.xlsx'
        );
    }
}
