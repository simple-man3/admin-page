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
        if (env('CMS_INSTALLED', false) != true) {
            return redirect()->route('displayInstallationForm');
        }
        return $next($request);
    }
}
