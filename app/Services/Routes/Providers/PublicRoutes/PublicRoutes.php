<?php


namespace App\Services\Routes\Providers\PublicRoutes;


use App;


class PublicRoutes
{

    const HOME     = 'home';
    const CONTACTS = 'contacts';

    public static function home(?string $locale = null): string
    {
        return route(static::HOME, $locale ?? App::getLocale());
    }

    public static function contacts(?string $locale = null): string
    {
        return route(static::CONTACTS, $locale ?? App::getLocale());
    }

}
