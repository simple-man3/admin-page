<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Validator;

class ValidationMiddleware
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
        if($request->has('category_name'))
        {
            $validate=Validator::make($request->all('category_name'),[
                'category_name'=>['required']
            ],[
                'category_name.required'=>'Введите название категории!'

            ])->validate();
        }
        elseif ($request->has('role_name'))
        {
            $validate=Validator::make($request->all('role_name'),[
                'role_name'=>['required']
            ],[
                'role_name.required'=>'Введите название роли!'

            ])->validate();
        }

        return $next($request);
    }
}
