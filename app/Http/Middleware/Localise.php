<?php

namespace App\Http\Middleware;

use App\Services\Localise\LocaliseServices;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Localise
{

    private LocaliseServices $localiseServices;

    public function __construct(
        LocaliseServices $localiseServices
    )
    {
        $this->localiseServices = $localiseServices;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = $this->getRequestLocale($request);

        if (!$this->isLocaleSupported($locale)) {
            abort(404);
        }

        $this->setLocale($locale);
        $this->removeLocaleParamInRequest($request );

        return $next($request);
    }

    public function getRequestLocale(Request $request): ?string
    {
        return $request->route('locale');
    }

    public function isLocaleSupported(?string $locale): bool
    {
        if (!$locale) {
            return false;
        }

        return $this->localiseServices->isLocaleSupported($locale);
    }

    private function setLocale(string $locale): void
    {
        App::setLocale($locale);
    }

    private function removeLocaleParamInRequest(Request $request): void
    {
        $request->route()->forgetParameter('locale');
    }
}
