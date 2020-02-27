<?php

namespace App\Http\Controllers\System\Installation;

use App\Http\Requests\System\Installation\InstallationRequest;
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
            //т.к. ларик не понял, что я изменил файл, я в ручную меняю доступ к бд, но только на один шаг
            //после того, как я перезагружу файл или перейду на другую страницу, он поймет, что файл был изиенен
            config(['database.connections.mysql.database'=>$request->input('name_db')]);
            config(['database.connections.mysql.username'=>$request->input('login_db')]);
            config(['database.connections.mysql.password'=>$request->input('password_db')]);

            //вызываю команду "php artisan migrate"
            \Artisan::call('migrate');

            //Получаю путь к файлу "config->database.php"
            $file_path=App::configPath('database.php');

            //получаю содержимое файла
            $content=file_get_contents($file_path);

            //Изменяю доступ к бд, а именно:
            //Название бд
            //Логин бд
            $changed=str_ireplace(
                array(
                    "'database' => ''",
                    "'username' => ''",
                    "'password' => ''"
                ),
                array(
                    "'database' => '".$request->input('name_db')."'",
                    "'username' => '".$request->input('login_db')."'",
                    "'password' => '".$request->input('password_db')."'"
                ),$content);

            //Перезаписываю файл
            file_put_contents($file_path,$changed);
        }catch (\Exception $e)
        {
            return redirect()->back()
                             ->withInput($request->only('name_db'))
                             ->withErrors([
                                 'wrong_login_or_password'=>'логин или пароль непраильный!'
                             ]);
        }

        return redirect()->route('displayRegistrationForm');
    }
}
