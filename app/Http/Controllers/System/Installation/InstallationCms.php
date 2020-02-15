<?php

namespace App\Http\Controllers\System\Installation;

use App\Http\Requests\System\Installation\InstallationRequest;
use App\Library\InstallCms\Install;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use PharIo\Manifest\Application;

class InstallationCms extends Controller
{
    public function index()
    {
        return view('system.installation.installationCms');
    }

    public function setSettingDb(InstallationRequest $request)
    {
        try
        {
            Install::setAccessDb($request->except('_token'));

            \Artisan::call('migrate');

        }catch (\Exception $e)
        {
            dd($e->getMessage());
            return redirect()->back()
                             ->withInput($request->only('name_db'))
                             ->withErrors([
                                 'wrong_login_or_password'=>'логин или пароль непраильный!'
                             ]);
        }

        return redirect()->route('displayRegistrationForm');
    }
}
