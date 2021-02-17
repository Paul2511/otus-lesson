<?php


namespace App\Services\Localise;


class Locale
{
    const RU = 'ru';
    const EN = 'en';
    const ES = 'es';
    const FR = 'fr';

    public static array $availableLocales = [
        self::RU,
        self::EN,
        self::ES,
        self::FR
    ];
}
