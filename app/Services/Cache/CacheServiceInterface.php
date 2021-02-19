<?php


namespace App\Services\Cache;


interface CacheServiceInterface
{
    /**
     * Очистить кэш
     */
    public function clear(): void;

    /**
     * Создать кэш
     */
    public function warm(): void;
}
