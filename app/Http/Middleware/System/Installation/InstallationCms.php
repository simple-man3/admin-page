<?php

namespace App\Http\Middleware\System\Installation;

use App\Library\InstallCms\Install;
use App\Models\User;
use Closure;

class InstallationCms
{
    public function handle($request, Closure $next)
    {
        Install::getAccessDb('DB_HOST');
        //Получаем значение ключа "DB_INSTALLED"
        $check_installed_cms=Install::getAccessDb('DB_INSTALLED');

        if(!$check_installed_cms)
        {
            return redirect()->route('displayInstallationForm');
        }else
            return $next($request);
    }
}
