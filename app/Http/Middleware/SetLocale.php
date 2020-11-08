<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->segment(1);
        $arAllow = config('app.available_locales');
        if(!in_array($locale, $arAllow)) {
            $localeDefault = config('app.locale');
            if(!empty($localeDefault) && $localeDefault != $locale) {
                $redirectURI = str_replace('/'.$locale,'/'.$localeDefault, $request->getRequestUri());
                return redirect($redirectURI);
            }
        }
        app()->setLocale($locale);
        return $next($request);
    }
}
