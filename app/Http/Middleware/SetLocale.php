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
        $requestLocale = $this->getRequestLocale($request);
        if (!$this->isLocaleSupported($requestLocale)) {
            return $this->redirectToDefaultLocale($request, $next);
        }
        app()->setLocale($requestLocale);
        return $next($request);
    }

    /**
     * Get locale code from URI
     *
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    private function getRequestLocale(Request $request) {
        return $request->segment(1);
    }

    /**
     * Check for support locale
     *
     * @param string $locale
     * @return bool
     */
    private function isLocaleSupported(string $locale) {
        $availableLocales = (array) config('app.available_locales', []);
        return in_array($locale, $availableLocales);
    }

    /**
     * Processing redirect to default locale
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    private function redirectToDefaultLocale(Request $request, Closure $next) {
        $locale = $this->getRequestLocale($request);
        $localeDefault = config('app.locale');
        if(!empty($localeDefault) && $localeDefault != $locale) {
            return redirect($this->generateLocaleUri($request, $localeDefault));
        }
        abort(404);
        return $next($request);
    }

    /**
     * Get current URI with locale code replaced
     *
     * @param \Illuminate\Http\Request $request
     * @param string $locale
     * @return string
     */
    private function generateLocaleUri(Request $request, string $locale) {
        $localeCurrent = $this->getRequestLocale($request);
        return preg_replace('/\/'.$localeCurrent.'/', '/'.$locale, $request->getRequestUri(), 1);
    }
}
