<?php


namespace App\Jobs;


abstract class Queue
{
    const DEFAULT = 'default';
    const MAIL = 'mail';

    public static $queues = [self::DEFAULT, self::MAIL];
}