<?php

namespace App\Http\Middleware;

use Closure;

class Language
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
        $language=session('language','English');
        switch($language){
            case '繁體中文':
                app()->setLocale('zh-TW');
                break;
            // case 'English':
            //     app()->setLocale('en');
            //     break;
            default:
                app()->setLocale('en');
        }
        return $next($request);
    }
}
