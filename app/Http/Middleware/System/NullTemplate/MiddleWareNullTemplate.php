<?php

namespace App\Http\Middleware\System\NullTemplate;

use App\Models\All_themes;
use Closure;

class MiddleWareNullTemplate
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
        $active_theme=All_themes::where('use_theme',true)->first();
        if($active_theme!=null)
        {
            return $next($request);
        }else
            return redirect()->route('qwerty');
    }
}
