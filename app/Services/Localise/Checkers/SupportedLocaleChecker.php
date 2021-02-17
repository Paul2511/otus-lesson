<?php


namespace App\Services\Localise\Checkers;


use App\Services\Localise\Locale;

class SupportedLocaleChecker
{
    public function check(string $locale): bool
    {
        return in_array($locale, Locale::$availableLocales);
    }
}
