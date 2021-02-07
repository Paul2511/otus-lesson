<?php

namespace App\Services\Localise;

class Locale
{
    const RU = 'ru';
    const EN = 'en';

    public static array $allowedLocales = [
        self::RU,
        self::EN,
    ];

    public static string $defaultLocale = self::RU;

}
