<?php


namespace App\States\User\Role;


class ManagerUserRole extends UserRole
{
    public static $name = 'manager';

    public function canManage(): bool
    {
        return true;
    }
}