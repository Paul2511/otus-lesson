<?php

namespace App\Services\Localise\Checkers;

use App\Services\Localise\Locale;

class AllowedLocaleChecker
{
    public function ifLocaleAllowed(string $locale): bool
    {
        return in_array($locale, Locale::$allowedLocales);
    }
}
