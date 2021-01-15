<?php


namespace App\Policies;


abstract class Gates
{
    const CAN_VIEW = 'view';

    public static $gates = [
        self::CAN_VIEW,
    ];

}
