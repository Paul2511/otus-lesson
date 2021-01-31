<?php


namespace App\Services\Localization;


class Locales
{
    const RU = 'ru';
    const EN = 'en';
    const BY = 'by';

    public static function availableList(): array
    {
        return [
            static::RU,
            static::EN,
            static::BY,
        ];
    }
}
