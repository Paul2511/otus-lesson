<?php

namespace App\Http\Middleware;

use App;
use App\Providers\RouteServiceProvider;
use App\Services\Localisation\LocalizeService;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Localization
{
    /**
     * @var LocalizeService
     */
    private LocalizeService $localizeService;

    /**
     * Handle an incoming request.
     *
     * @param LocalizeService $localizeService
     */

    public function __construct(
        LocalizeService $localizeService
    )
    {
        $this->localizeService = $localizeService;
    }

    public function handle(Request $request, Closure $next)
    {
        $locale = $this->getRequestLocale($request);
        $path = $this->getCurrentPathWithoutLocale($request, $locale);

        if (!$this->isLocaleSupported($locale)) {
            App::setLocale(config('app.fallback_locale'));
            return redirect()->to(config('app.fallback_locale') . $path);
        }
        $this->setAppLocale($locale);
        $this->removeParamLocaleFromRequest($request);

        return $next($request);
    }

    private function getCurrentPathWithoutLocale(Request $request, ?string $locale): ?string
    {
        $path = $request->path();

        if (!$locale) {
            return $path;
        }

        return substr($path, strlen($locale));
    }

    private function getRequestLocale(Request $request): ?string
    {
        return $request->route('locale');
    }

    private function isLocaleSupported(?string $locale): bool
    {
        if (!$locale) {
            return false;
        }
        return $this->localizeService->isLocaleSupported($locale);
    }

    private function setAppLocale(?string $locale): void
    {
        App::setlocale($locale);
        Carbon::setLocale($locale);
    }

    private function removeParamLocaleFromRequest(Request $request): void
    {

        $request->route()->forgetParameter('locale');

    }
}
