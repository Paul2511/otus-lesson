<?php


namespace App\Services\Localisation\Checkers;


class SupportedLocaleChecker
{
    public function check(string $locale): bool
    {

        return in_array($locale, config('app.available_locales'));
    }
}