<?php


namespace App\Services\UserRole\Repository\Interfaces;


use Illuminate\Database\Eloquent\Model;

interface EloquentUserRoleRepositoryInterface
{
    public function setRoleOnUser(int $userId, int $roleId): Model;
}
