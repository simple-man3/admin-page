<?php

namespace App\Http\Controllers\System\AuthCustom;

use App\Http\Requests\Auth\RegistrationRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistrationCustom extends Controller
{
    public function index()
    {
        return view('system.authCustom.registration');
    }

    public function registUser(RegistrationRequest $request)
    {
        $user=new User();
        $user->login=$request->input('login_registration');
        $user->email=$request->input('email');
        $user->password=\Hash::make($request->input('password'));
        $user->active=true;
        $user->save();

        $role=new Role();
        $role->name='admin';
        $role->super_user=true;
        $role->save();

        $max_id_user=User::max('id');
        $user=User::find($max_id_user);
        $role_id=Role::max('id');

        $user->roles()->attach($role_id);

        \Auth::loginUsingId(User::max('id'));

        return redirect('/');
    }
}
