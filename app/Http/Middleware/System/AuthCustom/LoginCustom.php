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
        //После установки cms, в юзеру нужно зарегаться, чтобы в бд cms был хотя бы один юзер
        //Идет проврека, есть ли в бд хотя бы один юзер в cms?
        if(User::count()>0)
        {
            //Если юзер авторизован, то при попытке снова
            // авторизироваться, его будет перекидывать на главную страницу
            if(\Auth::check())
            {
                return redirect('/');
            }
        }else
            return redirect()->route('displayRegistrationForm');

        return $next($request);
    }
}
