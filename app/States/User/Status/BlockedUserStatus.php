<?php


namespace App\States\User\Status;


class BlockedUserStatus extends UserStatus
{
    public static $name = 'blocked';

    public function color(): string
    {
        return 'danger';
    }
}