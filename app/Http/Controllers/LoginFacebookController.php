<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
// use Socialite;

class LoginFacebookController extends Controller
{
    
    public function getInfo($social){
        return Socialite::driver($social)->redirect();
    }
    public function checkInfo(){
        $info = Socialite::driver($social)->user();
    }
}
