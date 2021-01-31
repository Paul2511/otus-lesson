<?php


namespace App\Services\Localization;


use App\Services\Localization\Checkers\LocaleChecker;


class LocalizationService
{

    public LocaleChecker $localeChecker;

    public function __construct(LocaleChecker $localeChecker)
    {
        $this->localeChecker = $localeChecker;
    }

}
