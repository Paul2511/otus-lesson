<?php

namespace App\Http\Middleware;

use App;
use App\Services\Localisation\LocalizeService;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class Localization
{

    private LocalizeService $localizeService;

    public function __construct(
        LocalizeService $localizeService
    ) {
        $this->localizeService = $localizeService;
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = $this->getRequestLocale($request);
        $path = $request->path();

        if (!$this->isLocaleSupported($locale)) {
            App::setLocale(config('app.fallback_locale'));
            return redirect()->to($path);
        }
        $this->setAppLocale($locale);

        return $next($request);
    }

    private function getRequestLocale(Request $request): ?string
    {
      if (empty($request->cookie('locale')))
      {
          return config('app.fallback_locale');
      }
        return $request->cookie('locale');

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

}
