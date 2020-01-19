<?php

namespace App\Http\Controllers\System\AuthCustom;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginCustom extends Controller
{
    public function index()
    {
        return view('system.authCustom.login');
    }

    public function loginUser(LoginRequest $request)
    {
        $user=User::where('login',$request->input('login'))->first();

        if($user!=null)
        {
            if(\Hash::check($request->input('password'),$user->password))
            {
                Auth::loginUsingId($user->id);
                return redirect('/');
            }
        }

        return redirect()->back()
            ->withInput($request->only('login'))
            ->withErrors([
                'error'=>'логин или пароль непрвильный!'
            ]);
    }

    public function customLogout()
    {
        Auth::logout();
        return redirect('/');
    }
}
