<?php


namespace App\Services\Localise;


class Locale
{
    const LOCALE_RU = 'ru';
    const LOCALE_EN = 'en';

    /**
     * @var array
     */
    public static $availableLocales = [
        self::LOCALE_RU, self::LOCALE_EN
    ];
}