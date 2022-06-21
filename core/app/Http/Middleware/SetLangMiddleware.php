<?php

namespace App\Http\Middleware;

use App\Language;
use Closure;

class SetLangMiddleware
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
        if(session()->has('lang')){
            app()->setLocale(session()->get('lang'));
        } else {
            $default = Language::where('is_default', 1)->first();
            if(!empty($default)){
                app()->setLocale($default->code);
            }
        }


        return $next($request);
    }
}
