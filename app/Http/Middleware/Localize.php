<?php

namespace App\Http\Middleware;

use App\Services\Localise\LocaliseService;
use Closure;
use Illuminate\Http\Request;
use App\Services\Localise\Locale;
class Localize
{
    /**
     * @var LocaliseService
     */
    private $localiseService;

    public function __construct(
        LocaliseService $localiseService
    )
    {
        $this->localiseService = $localiseService;
    }

    public function handle(Request $request, Closure $next)
    {
        $locale = $request->getPreferredLanguage(Locale::$availableLocales);

        if ($locale && $this->localiseService->isLocaleSupported($locale)) {
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
