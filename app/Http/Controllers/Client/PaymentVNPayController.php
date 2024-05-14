<?php

namespace App\Http\Controllers\Client;

use App\Events\SuccessEvent;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentVNPayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function payment_vnpay(Request $request)
    {
        if (isset($_POST['redirect'])) {
            $payment = new Transaction();
            $payment->user_id = auth()->user()->id;
            $payment->status = 'cancel';
            $payment->payment_method = 'vnpay';
            $payment->point_persent = (int)str_replace('.', '', $request->point_persent_vnpay);
            $payment->point = $request->old_total_amount_input;
            $payment->price_promotion = $request->total_amount_input;
            if ($request->coupon_id1) {
                $payment->coupon_id = $request->coupon_id1;
            } else {
                $payment->coupon_id = null;
            }
            $payment->verification = null;
            $payment->save();
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html"; // url chuyển đến trang thanh toán
            $vnp_Returnurl = "https://trooi.id.vn/vnpay-return"; // url redirect sau khi thanh toán xong
            $vnp_TmnCode = "M4WVGGAX"; //Mã website tại VNPAY
            $vnp_HashSecret = "GCJDLQSWQXFNASGVNESEOJRUUNQUZJYO"; //Chuỗi bí mật

            // $vnp_TxnRef = $_POST['order_id']; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_TxnRef = $payment->id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            // $vnp_OrderInfo = $_POST['order_desc']; // thông tin đơn
            $vnp_OrderInfo = 'Thanh toán đơn hàng';
            // $vnp_OrderType = $_POST['order_type'];
            $vnp_OrderType = 'billpayment';
            // $vnp_Amount = $_POST['amount'] * 100;
            $vnp_Amount = $request->total_amount_input * 100;
            // $vnp_Locale = $_POST['language'];
            $vnp_Locale = 'vn';
            // $vnp_BankCode = $_POST['bank_code'];
            $vnp_BankCode = 'NCB';
            $vnp_BankCode = '';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
            //Add Params of 2.0.1 Version
            // $vnp_ExpireDate = $_POST['txtexpire'];

            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef
                // "vnp_ExpireDate" => $vnp_ExpireDate
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            }

            //var_dump($inputData);
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            session()->start();

            // Session::put('payment_id', $paymentId);
            header('Location: ' . $vnp_Url);
            die();
        }
        // vui lòng tham khảo thêm tại code demo
    }
    /**
     * Show the form for creating a new resource.
     */
    public function return_vnpay(Request $request)
    {
        if (isset($_GET['vnp_ResponseCode'])) {
            $vnp_ResponseCode = $_GET['vnp_ResponseCode'];
            $transaction = Transaction::where('id', $_GET['vnp_TxnRef'])->first();
            if ($transaction) {
                if ($vnp_ResponseCode == '00') {
                    $transaction->status = 'accept';
                    $transaction->verification = "trooi_vnpay_" . $_GET['vnp_TxnRef'];
                    $transaction->vnpay_code = $_GET['vnp_TransactionNo'];
                    $transaction->save();
                    $user = User::findOrFail($transaction->user_id);
                    $user->point += $transaction->point_persent;
                    $user->save();
                    if ($transaction->coupon_id) {
                        $coupon = Coupon::findOrFail($transaction->coupon_id);
                        $coupon->quantity = max(0, $coupon->quantity - 1);
                        $coupon->save();
                    }
                    event(new SuccessEvent($user));
                    $transactionId = $_GET['vnp_TxnRef'];
                    $price = $transaction->price_promotion;
                    $point = $transaction->point_persent;
                    return view('client.payment-status.notification-pay')->with(['transactionId' => $transactionId, 'price' => $price, 'point' => $point]);
                } else {
                    $transaction->verification = "Tro_oi_" . $_GET['vnp_TxnRef'];
                    $transaction->save();
                    return redirect()->route('notification-fail');
                }
            } else {
                // Handle the case when the transaction is not found
                // For example, you can redirect to an error page or show an error message
                return redirect()->route('notification-fail');
            }
        }
    }
}
