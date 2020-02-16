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
        $remeber=$request->has('remember');
        $user=User::where('login',$request->input('login'))->first();

        //проверяем, активен ли он
        if($user!=null && $user->active)
        {
            //Проверяем, есть ли такой юзер
            if (Auth::attempt($request->only(['login', 'password']),$remeber))
            {
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
