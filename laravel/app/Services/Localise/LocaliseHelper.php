<?php


namespace App\Services\Localise;

use  \Illuminate\Routing\Route;

class LocaliseHelper
{

    public function getLocaleVersionsForRoute(Route $route): array
    {
        $parameters = $route->parameters();
        $name = $route->getName();

        $routes = [];
        foreach (Locale::$allowedLocales as $locale) {
            $parameters['locale'] = $locale;
            $routes[$locale] = route($name,$parameters);
        }

        return $routes;
    }
}
