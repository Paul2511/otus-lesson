<?php


namespace App\Services\Routes\Providers\PublicRoutes;


use App;


class PublicRoutes
{

    public const HOME     = 'home';
    public const CONTACTS = 'public.contacts';

    public const SURVEY  = 'public.survey';
    public const SURVEYS  = 'public.surveys';

    public static function home(?string $locale = null): string
    {
        return route(static::HOME, $locale ?? App::getLocale());
    }

    public static function contacts(?string $locale = null): string
    {
        return route(static::CONTACTS, $locale ?? App::getLocale());
    }

    public static function surveys(?string $locale = null): string
    {
        return route(static::SURVEYS, $locale ?? App::getLocale());
    }
    public static function survey(App\Models\Survey $survey, ?string $locale = null): string
    {
        return route(static::SURVEY, [$locale ?? App::getLocale(), $survey]);
    }
}
