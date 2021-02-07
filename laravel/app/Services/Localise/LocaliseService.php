<?php


namespace App\Services\Localise;


use App\Services\Localise\Checkers\AllowedLocaleChecker;
use  \Illuminate\Routing\Route;

class LocaliseService
{

    private AllowedLocaleChecker $allowedLocaleChecker;
    private LocaliseHelper $helper;

    public function __construct(AllowedLocaleChecker $allowedLocaleChecker, LocaliseHelper $helper)
    {
        $this->allowedLocaleChecker = $allowedLocaleChecker;
        $this->helper = $helper;
    }

    public function ifLocaleAllowed(string $locale): bool
    {
        return $this->allowedLocaleChecker->ifLocaleAllowed($locale);
    }

    public function getDefaultLocale(): string
    {
        return Locale::$defaultLocale;
    }

    public function getLocaleVersionsForRoute(Route $route): array
    {
        return $this->helper->getLocaleVersionsForRoute($route);
    }

}
