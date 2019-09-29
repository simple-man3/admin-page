<?php

namespace App\Http\Middleware;

use Closure;

class CheckPlatformKey
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
        if ($request->input('key') != env('PLATFORM_APP_KEY')) {
            abort(500, 'Wrong CMS key');
        }
        return $next($request);
    }
}
