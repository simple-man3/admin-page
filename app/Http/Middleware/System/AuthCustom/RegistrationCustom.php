<?php

namespace App\Http\Middleware\System\AuthCustom;

use App\Models\User;
use Closure;

class RegistrationCustom
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
        if(User::count()>0)
        {
            return redirect('/');
        }
        return $next($request);
    }
}
