<?php


namespace App\States\User\Role;


class ClientUserRole extends UserRole
{
    public static $name = 'client';

    public function canManage(): bool
    {
        return false;
    }
}