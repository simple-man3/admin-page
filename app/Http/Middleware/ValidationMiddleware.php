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
        $validate=Validator::make($request->all('category_name'),[
            'category_name'=>['required']
        ],[
            'category_name.required'=>'Введите название категории!'

        ])->validate();

        return $next($request);
    }
}
