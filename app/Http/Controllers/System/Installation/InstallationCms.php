<?php

namespace App\Http\Controllers\System\Installation;

use App\Http\Requests\System\Installation\InstallationRequest;
use App\Library\Common\Env;
use App\Models\All_themes;
use App\Models\SystemSettings;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class InstallationCms extends Controller
{
    public function index()
    {
        return view('system.installation.installationCms');
    }

    public function setSettingDb(InstallationRequest $request)
    {
        try {
            $db_host = $request->input('db_host', env('DB_HOST', '127.0.0.1'));
            $db_port = $request->input('db_port', env('DB_PORT', '3306'));
            $db_database = $request->input('db_database', env('DB_DATABASE', 'press_start_cms'));
            $db_username = $request->input('db_username', env('DB_USERNAME', 'root'));
            $db_password = $request->input('db_password', env('DB_PASSWORD', ''));

            Env::set('DB_HOST', $db_host);
            Env::set('DB_PORT', $db_port);
            Env::set('DB_DATABASE', $db_database);
            Env::set('DB_USERNAME', $db_username);
            Env::set('DB_PASSWORD', $db_password);

            config(['database.connections.mysql.host' => $db_host]);
            config(['database.connections.mysql.port' => $db_port]);
            config(['database.connections.mysql.database' => $db_database]);
            config(['database.connections.mysql.username' => $db_username]);
            config(['database.connections.mysql.password' => $db_password]);

            \Artisan::call('migrate');

            $this->setDefaultTheme();

            // добавление настройки в бд с пройденными шагами установки CMS
            $install_setting = SystemSettings::firstOrNew(['name' => 'cms_installation']);
            if (!empty($install_setting->value)) {
                Log::notice('There was old installation settings', [
                    'settings' => $install_setting->value,
                ]);
            }
            $install_setting->value = [
                'db_prepared' => true,     // шаг: подготовка базы данных
                'admin_created' => false,  // шаг: регистрация администратора
            ];
            $install_setting->save();
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors([
                    'wrong_login_or_password' => ['логин или пароль непраильный!'],
                ]);
        }

        return redirect()->route('displayRegistrationForm');
    }

    /**
     * Создает в БД запись о теме по умолчанию
     */
    protected function setDefaultTheme()
    {
        All_themes::create([
            'name_dir' => 'my_temp',
            'name_theme' => 'Эта создана как полигон для custom_helper',
            'name_author' => 'Влад разраб',
            'description_theme' => 'В данной теме будет отображатся данные из админки с помощью custom_helper',
            'use_theme' => 1,
        ]);
    }
}
