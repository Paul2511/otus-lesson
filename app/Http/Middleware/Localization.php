<?php

namespace App\Http\Middleware;

use App;
use App\Services\Localization\LocalizationService;
use Closure;
use Illuminate\Http\Request;


class Localization
{
    private LocalizationService $localizationService;

    public function __construct(LocalizationService $localizationService)
    {
        $this->localizationService = $localizationService;
    }

    public function handle(Request $request, Closure $next)
    {
        $locale = $this->getLocaleFromRequest($request);

        if (!$locale) {
            return $this->handleIncorrectLocale($request);
        }

        $isLocaleAcceptable = $this
            ->localizationService
            ->localeChecker
            ->checkIfLocaleIsAcceptable($locale);

        if ($isLocaleAcceptable) {
            $this->setApplicationLocale($locale);
            $this->removeLocaleFromRequest($request);
        } else {
            return $this->handleIncorrectLocale($request);
        }

        return $next($request);
    }

    public function getLocaleFromRequest(Request $request): ?string
    {
        return $request->route('locale');
    }

    public function setApplicationLocale(string $locale)
    {
        App::setLocale($locale);
    }

    private function removeLocaleFromRequest(Request $request)
    {
        $request->route()->forgetParameter('locale');
    }

    private function handleIncorrectLocale(Request $request)
    {
        $uri = $request->getRequestUri();
        $defaultLocale = App::getLocale();

        if (!$defaultLocale) {
            abort(404);

            return false;
        }

        $localizedUri = preg_replace('~^/~', "/{$defaultLocale}/", $uri);

        return redirect($localizedUri);
    }
}
