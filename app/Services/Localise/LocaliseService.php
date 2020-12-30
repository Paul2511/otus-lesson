<?php


namespace App\Services\Localise;


use App\Services\Localise\Checkers\SupportedLocaleChecker;
use Illuminate\Database\Eloquent\Model;
class LocaliseService
{
    /**
     * @var SupportedLocaleChecker
     */
    private $localeChecker;

    public function __construct(
        SupportedLocaleChecker $localeChecker
    )
    {
        $this->localeChecker = $localeChecker;
    }

    public function currentLocale()
    {
        return \App::currentLocale();
    }

    public function isLocaleSupported(string $locale): bool
    {
        return $this->localeChecker->check($locale);
    }

}