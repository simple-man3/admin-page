<?php

namespace App\Http\Middleware;

use Closure;
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
//            if(\Gate::allows('show_admin_panel'))
//            {
                return $next($request);
//            }else
//            {
              //  return redirect()->back();
//            }
        }else
            return redirect()->route('login');
    }
}
