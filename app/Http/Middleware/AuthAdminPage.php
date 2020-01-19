<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate;
//use Illuminate\Contracts\Auth\Access\Gate;
//use Illuminate\Support\Facades\Auth;

class AuthAdminPage
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
        if(\Auth::check())
        {
            if(Gate::allows('select_role_user'))
            {
                return $next($request);
            }else
            {
                return redirect()->back();
            }
        }else
            return redirect()->route('login');
    }
}
