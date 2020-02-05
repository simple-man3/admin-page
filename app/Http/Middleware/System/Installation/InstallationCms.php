<?php

namespace App\Http\Middleware\System\Installation;

use App\Models\User;
use Closure;

class InstallationCms
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try
        {
            //Если простой запрос выполнен, то все хорошо, бд есть
            User::all(['id']);

            //Юзеру нельзя заходить на этот url, после того, когда он установил cms
            if(\Route::currentRouteName()=='displayInstallationForm')
            {
                return redirect()->back();
            }


        }catch (\Exception $e)
        {
            //Если ошибка, значит бд нет (но это не точно)
            return redirect()->route('displayInstallationForm');
        }

        //Это не нужно, но если его убрать, все крашится
        return $next($request);
    }
}
