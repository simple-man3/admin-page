<?php

namespace App\Http\Middleware\System\Installation;

use App\Models\SystemSettings;
use App\Models\User;
use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InstallationCms
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {
        if (env('CMS_INSTALLED', false) == true) {
            return $next($request);
        }

        // check if database exists
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            return redirect()->route('displayInstallationForm');
        }

        // check if table system_settings exists
        if (!Schema::hasTable('system_settings')) {
            return redirect()->route('displayInstallationForm');
        }

        $install_setting = SystemSettings::where(['name' => 'cms_installation'])->first();

        // if db was not prepared while cms install
        if ($install_setting == null || $install_setting->value['db_prepared'] == false) {
            return redirect()->route('displayInstallationForm');
        }

        // if admin was not created while cms install
        if ($install_setting->value['admin_created'] == false) {
            return redirect()->route('displayRegistrationForm');
        }

        // if cms hasn't been installed and all other conditions passed
        throw new \Exception('Error while checking if CMS was installed');
    }
}
