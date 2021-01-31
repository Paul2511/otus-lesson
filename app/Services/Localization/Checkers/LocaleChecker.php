<?php


namespace App\Services\Localization\Checkers;


use App\Services\Localization\Locales;
use Request;


class LocaleChecker
{

    public function checkIfLocaleIsAcceptable(string $locale): bool
    {
        return in_array($locale, Locales::availableList());
    }

}
