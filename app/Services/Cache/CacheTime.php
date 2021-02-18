<?php


namespace App\Services\Cache;


class CacheTime
{
    const MINUTE_IN_SECONDS = 60;
    const HOUR_IN_SECONDS = self::MINUTE_IN_SECONDS * 60;
    const DAY_IN_SECONDS = self::HOUR_IN_SECONDS * 24;
}
