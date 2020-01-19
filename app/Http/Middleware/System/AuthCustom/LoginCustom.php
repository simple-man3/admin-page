<?php

namespace App\Http\Middleware\System\AuthCustom;

use App\Models\User;
use Closure;

class LoginCustom
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
        //Если юзер уже авторизован, то неследует снова авторизироваться
        if(\Route::currentRouteName()=='login_form' && \Auth::check())
        {
            return redirect('/');
        }
        return $next($request);
    }
}
