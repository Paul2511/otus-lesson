<?php


namespace App\Helpers;

use App\Jobs\LogJob;

class LogHelper
{
    public static function pet(string $message, array $context): void
    {
        self::queue('pet', 'info', $message, $context);
    }

    public static function slack(string $message, array $context): void
    {
        self::queue('slack', 'error', $message, $context);
    }

    public static function registration(string $message, array $context): void
    {
        self::queue('registration', 'info', $message, $context);
    }

    public static function auth(string $message, array $context, ?string $level='info')
    {
        self::queue('auth', $level, $message, $context);
    }

    protected static function queue(string $channel, string $level, string $message, array $context): void
    {
        LogJob::dispatch($channel, $level, $message, $context);
    }
}