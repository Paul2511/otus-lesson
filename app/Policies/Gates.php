<?php


namespace App\Policies;


abstract class Gates
{
    const CAN_ADMIN = 'admin';

    public static $gates = [
        self::CAN_ADMIN,
    ];

}
