<?php

namespace App\Http\Controllers\Auth;

use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }
    public function redirectToGoogle()
    {

        return Socialite::driver('google')->redirect();
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        // dd($googleUser);
        $user = User::where('email', $googleUser->email)->first();
        //check nếu có user thì đăng nhập
        // Check if the user already exists in your application's database
        if ($user) {
            Auth::login($user);
            toastr()->success('Đăng nhập thành công!', 'Thành công');
        }
        //k có thì thêm user vào db rồi đăng nhập
        // If not, create a new user record
        else {
            toastr()->success('Tạo tài khoản thành công!', 'Thành công');
           
          
            $user = User::create(
                [
                    'email' => $googleUser->email,
                    'name' => $googleUser->name,
                    'password' => "A123".Str::random(8),
                    'avatar' => $googleUser->avatar,
                ]
            );
            Auth::login($user);
        }
        return redirect()->intended('/');
    }

    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $finduser = User::where('email', $user->email)->first();
        
            if($finduser){
                Auth::login($finduser);
                toastr()->success('Đăng nhập thành công!', 'Thành công');
                return redirect()->intended('/');
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'facebook_id'=> $user->id,
                    'password' => encrypt('123456789'),
                    'avatar' => $user->avatar,
                ]);
        
                Auth::login($newUser);
        
                return redirect()->intended('/');
            }
        
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
