<?php


namespace App\Helpers;

use Log;

class LogHelper extends Log
{
    public static function pet(string $message, array $context): void
    {
        self::channel('pet')->info($message, $context);
    }

    public static function slack(string $message, array $context): void
    {
        self::channel('slack')->error($message, $context);
    }

}