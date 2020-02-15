<?php

namespace App\Http\Controllers\System\AuthCustom;

use App\Http\Requests\Auth\RegistrationRequest;
use App\Library\Common\Env;
use App\Models\Role;
use App\Models\SystemSettings;
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
        $install_setting = SystemSettings::where(['name' => 'cms_installation'])->first();
        if ($install_setting == null || $install_setting->value['db_prepared'] == false) {
            return redirect()->route('displayInstallationForm');
        }

        $user=new User();
        $user->login=$request->input('login_registration');
        $user->email=$request->input('email');
        $user->password=\Hash::make($request->input('password'));
        $user->active=true;
        $user->main_user=true;
        $user->save();

        $role=new Role();
        $role->name='admin';
        $role->super_user=true;
        $role->save();

        // Сохранение данных в бд о добавлении администратора
        $install_setting_value = $install_setting->value;
        $install_setting_value['admin_created'] = true;
        $install_setting->value = $install_setting_value;
        $install_setting->save();

        // окончание установки
        Env::set('CMS_INSTALLED', 'true');

        $user=User::find($user->id);
        $role_id=Role::max('id');

        $user->roles()->attach($role_id);

        \Auth::loginUsingId(User::max('id'));

        return redirect('/');
    }
}
