<?php


namespace App\Services\Localisation;


use App\Services\Localisation\Checkers\SupportedLocaleChecker;

class LocalizeService
{

    private SupportedLocaleChecker $supportedLocaleChecker;

    public function __construct
    (
        SupportedLocaleChecker $supportedLocaleChecker
    )
    {
    $this->supportedLocaleChecker = $supportedLocaleChecker;
    }

    public function isLocaleSupported(string $locale): bool
    {

        return $this->supportedLocaleChecker->check($locale);
    }
}