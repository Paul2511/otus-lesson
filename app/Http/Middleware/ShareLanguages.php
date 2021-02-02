<?php

namespace App\Http\Middleware;

use App\Services\Languages\LanguageService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ShareLanguages
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,LanguageService $languageService)
    {
        $languages = $languageService->getAppLanguages();
        View::share('languages', $languages);
        return $next($request);
    }
}
