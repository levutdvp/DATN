<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'min:4', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'unique:users', 'regex:/^0[0-9]{7,11}$/', 'min:8', 'max:12'],
            'password' => ['required', 'string','regex:/^(?=.*[A-Z])(?=.*\d).+$/', 'min:6', 'max:35', 'confirmed'],
        ], [
            'name.required' => 'Họ tên bắt buộc nhập.',
            'name.string' => 'Họ tên phải là chữ.',
            'name.min' => 'Tên ít nhất :min kí tự.',
            'name.max' => 'Tên nhiều nhất :max kí tự.',
            'email.required' => 'Không được bỏ trống email.',
            'email.email' => 'Email không hợp lệ.',
            'email.max' => 'Địa chỉ email không được vượt quá :max ký tự.',
            'email.unique' => 'Địa chỉ email đã tồn tại trong hệ thống.',
            'phone.required' => 'Trường số điện thoại là bắt buộc.',
            'phone.unique' => 'Số điện thoại đã tồn tại trong hệ thống.',
            'phone.regex' => 'Số điện thoại phải là một số điện thoại Việt Nam hợp lệ.',
            'phone.min' => 'Số điện thoại phải có ít nhất :min chữ số.',
            'phone.max' => 'Số điện thoại không được vượt quá :max chữ số.',
            'password.required' => 'Trường mật khẩu là bắt buộc.',
            'password.regex' => 'Mật khẩu phải chứa ít nhất một chữ cái viết hoa và ít nhất một số.',
            'password.string' => 'Mật khẩu phải là một chuỗi ký tự.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
            'password.max' => 'Mật khẩu không được vượt quá :max ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ]);
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if(isset($data['avatar']) && $data['avatar']) {
            $data['avatar'] = upload_file(OBJECT_USER, $data['avatar']);
        }else{
            $data['avatar']=null;
        }
        toastr()->success('Tạo tài khoản thành công!', 'Thành công');
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'avatar' => $data['avatar'],
            'password' => Hash::make($data['password']),
        ]);
    }

}
