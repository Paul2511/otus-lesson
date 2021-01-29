<?php


namespace App\States\User\Role;


class AdminUserRole extends UserRole
{
    public static $name = 'admin';

    public function canManage(): bool
    {
        return true;
    }
}