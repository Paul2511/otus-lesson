<?php

namespace App\Http\Middleware;

use App\Services\Localise\LocaliseService;
use Closure;
use App;
use Illuminate\Http\Request;

class Localize
{
    private LocaliseService $localiseService;

    public function __construct(LocaliseService $localiseService )
    {
        $this->localiseService = $localiseService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = $this->getRequestLocale($request) ?? $this->localiseService->getDefaultLocale();
        if (!$this->isLocaleAllowed($locale)) {
            abort(400);
        }
        $this->removeLocaleParamFromRequest($request);
        $this->setAppLocale($locale);

        return $next($request);
    }

    protected function getRequestLocale(Request $request): ?string
    {
        return $request->route('locale');
    }

    protected function isLocaleAllowed(?string $locale): bool
    {
        return !$locale ? false : $this->localiseService->ifLocaleAllowed($locale);
    }

    protected function setAppLocale(string $locale): void
    {
        App::setLocale($locale);
    }

    protected function removeLocaleParamFromRequest(Request $request): void
    {
        if ($request->route()) {
            $request->route()->forgetParameter('locale');
        }
    }

}
