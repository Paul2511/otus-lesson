<?php


namespace App\Listeners\User\UserRole;

use App\Models\User;
interface UserRoleCreateInterface
{
    public function handle(User $user): void;
}