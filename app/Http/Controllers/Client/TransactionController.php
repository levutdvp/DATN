<?php

namespace App\Http\Controllers\Client;

use App\Events\CancelEvent;
use App\Events\NotificationEvent;
use App\Events\RoomPostNotificationEvent;
use App\Events\SuccessEvent;
use App\Http\Controllers\Controller;
use App\Models\CategoryRoom;
use App\Models\District;
use App\Models\Coupon;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('permission:point-resource', ['only' => ['index']]);
    }
    public function index()
    {
        //
        $category_rooms = CategoryRoom::all()->where('status', 'active');
        $districts = District::whereHas('roomPosts', function ($query) {
            $query->where('status', 'accept');
        })->distinct()->pluck('name');
        $data = Transaction::with('user')
            ->where('action', 'import')
            ->latest()
            ->get();
        return view('admin.transaction.index', compact('data', 'category_rooms', 'districts'));
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
        $model = new Transaction();
        $model->fill($request->all());
        $model->point = (int)str_replace(',', '', $model->point);
        $model->price_promotion = (int)str_replace(',', '', $model->price_promotion);
        $model->point_persent = (int)str_replace('.', '', $model->point_persent);
        $model->action = 'import';
        $model->save();
        toastr()->success('Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.', 'Đơn hàng sẽ được xác nhận sớm');
        if ($model->action === 'import') {
            event(new NotificationEvent($request->verification));
        }
        $link_detail="points";
        $message="Mã nạp ".$model->verification." cần được xác nhận ngay !";
        notificationDB($link_detail,$message);
        return back();
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function updateStatus(Request $request, $id)
    {

        $newStatus = $request->input('status');
        $reason=$request->input('reason');
        // dd($reason);
        if ($newStatus === 'cancel') {
            if (empty($reason)) {
                toastr()->error('Lý do không được để trống khi hủy đơn nạp', 'Lỗi');
                return back()->withInput();
            }
        }
        $model = Transaction::find($id);
        $model->status = $newStatus;


        toastr()->success('Chỉnh sửa thành công', 'Thành công');
        if ($newStatus === 'accept') {
            $user = User::findOrFail($model->user_id);
            if ($model->coupon_id) {
                $coupon = Coupon::findOrFail($model->coupon_id);
                $coupon->quantity = max(0, $coupon->quantity - 1);
                $coupon->save();
            }
            $user->point += $model->point_persent;
            $user->save();
            event(new SuccessEvent($user));
            $message="Mã nạp ".$model->verification." của bạn đã được xác nhận.";
            $link_detail="points-history";
            sendNotification($link_detail,$model->user_id,$message);
        } elseif ($newStatus === 'cancel') {
            $user = User::findOrFail($model->user_id);
            $model->reason = $reason;
            $content = [
                'user' => $user->name,
                'title' => 'Đơn nạp của bạn đã bị từ chối',
                'description' => "Mã nạp ".$model->verification." nhận ".$model->point_persent." point không được chấp nhận với lý do: ".$reason
            ];
            event(new RoomPostNotificationEvent($user->email, $content));
            $message="Mã nạp ".$model->verification." của bạn bị từ chối.";
            $link_detail="points-history";
            sendNotification($link_detail,$model->user_id,$message);
        }
        $model->save();
        return back();
    }



    public function history()
    {

        $category_rooms = CategoryRoom::all()->where('status', 'active');
        $districts = District::whereHas('roomPosts', function ($query) {
            $query->where('status', 'accept');
        })->distinct()->pluck('name');
        $data = Transaction::with('user')
            ->where('user_id', auth()->user()->id)
            ->latest()
            ->paginate(10);
        return view('client.transaction.historyPoint', compact('data', 'category_rooms', 'districts'));
    }

    // Mã giảm giá
    public function applyDiscount(Request $request)
    {
        $discountCode = $request->input('discount_code');

        // Kiểm tra mã giảm giá trong cơ sở dữ liệu
        $discount = Coupon::where('name', $discountCode)->first();
        // Kiểm tra và xử lý mã giảm giá tại đây, ví dụ:
        if ($discount) {
            $discountAmount = $discount->value; // Lấy giá trị giảm giá từ cơ sở dữ liệu
            $typeDiscount = $discount->type;
            $status_coupon = $discount->status;
            $coupon_id = $discount->id;
            $coupon_quantity = $discount->quantity;
            return response()->json([
                'message' => 'Mã giảm giá đã được áp dụng!',
                'discount_amount' => $discountAmount,
                'type_discount' => $typeDiscount,
                'status_coupon' => $status_coupon,
                'coupon_id' => $coupon_id,
                'coupon_quantity' => $coupon_quantity,
            ]);
            //            return response()->json(['message' => 'Mã giảm giá đã được áp dụng!']);
        } else {
            return response()->json([
                'message' => 'Mã giảm giá không hợp lệ.',
                'discount_amount' => 0,
                'type_discount' => '',
                'status_coupon' => '',
                'coupon_id' => '',
                'coupon_quantity' => '',

            ]);
        }
    }

    // public function returnIdTrans(){
    //     $return = Transaction::query()->find();
    //     return view('payment-status.motification-pay', compact('return'));
    // }
}
