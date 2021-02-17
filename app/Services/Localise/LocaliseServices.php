<?php


namespace App\Services\Localise;


use App\Services\Localise\Checkers\SupportedLocaleChecker;

class LocaliseServices
{

    private SupportedLocaleChecker $supportedLocaleChecker;

    public function __construct(
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
