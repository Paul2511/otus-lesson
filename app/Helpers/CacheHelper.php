<?php


namespace App\Helpers;

use Watson\Rememberable\Query\Builder;
class CacheHelper
{
    public static function isCacheEnabled(): bool
    {
        return config('cache.enabled', false);
    }

    /**
     * @param string $name
     * @return \Illuminate\Config\Repository|\DateTime|int
     */
    public static function getTTL(string $name)
    {
        return config('cache.ttl.'.$name, 600);
    }

    public static function getKey(string $name, ?string $keyPostfix = null): string
    {
        if ($keyPostfix) {
            $name .= '_'.$keyPostfix;
        }
        return $name;
    }

    /**
     * @param Builder|\Illuminate\Database\Eloquent\Builder $query
     */
    public static function remember($query, string $name, ?string $keyPostfix = null)
    {
        $key = self::getKey($name, $keyPostfix);
        return self::isCacheEnabled() ?
            $query->remember(self::getTTL($name), $key)->cacheTags($key) :
            $query;
    }

}