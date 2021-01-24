<?php


namespace App\States\User\Status;


class ActiveUserStatus extends UserStatus
{
    public static $name = 'active';

    public function color(): string
    {
        return 'success';
    }
}