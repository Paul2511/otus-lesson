<?php


namespace App\Services\Interfaces;


interface CacheServiceInterface
{
    /**
     * Очистить кэш
     */
    public function clear():void;

    /**
     * Создать кэш
     */
    public function warm():void;
}
