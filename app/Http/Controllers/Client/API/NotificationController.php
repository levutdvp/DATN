<?php

namespace App\Http\Controllers\Client\API;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        // $user = Auth::user();
        // // dd($user);
        // $user_id=$user->id;
        $user = User::find($request->id);
        $notifications =  $user->notifications()->latest()->take(8)->get();
        $newArray = [];
        if($request->notification_id){
            $model=Notification::findOrfail($request->notification_id);
            $model->read_at=Carbon::now();
            $model->save();
        }
        // Lặp qua mảng JSON và thêm các cặp giá trị vào mảng mới
        foreach ($notifications as $item) {
            $id = $item->id;
            $name = $item->user->name;
            $message = $item->message;
            $avata = $item->user->avatar;
            $link_detail=$item->link_detail;
            $read_at = $item->read_at;
            $created_at_about = timeposts($item->created_at);
            $newArray[] = ['id' => $id, 'name' => $name, 'message' => $message,"link_detail"=>$link_detail, 'avata' => $avata, 'read_at' => $read_at, 'created_at_about' => $created_at_about];
        }
        return response()->json(
            $newArray,
        );
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
    public function update(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
