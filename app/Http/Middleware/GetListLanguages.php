<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class GetListLanguages
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $languages = [];
        foreach (config(app . locales) ?? [] as $localy) {
            $languages[] = ['title' => __('general.languages.' . $localy), 'code' => $localy];
        }
        View::share('languages', $languages);
        return $next($request);
    }
}
