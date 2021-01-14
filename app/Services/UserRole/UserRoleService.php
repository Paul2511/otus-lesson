<?php


namespace App\Services\UserRole;


use App\Services\UserRole\Repository\Interfaces\EloquentUserRoleRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class UserRoleService
{
    private EloquentUserRoleRepositoryInterface $userRoleRepository;

    public function __construct(EloquentUserRoleRepositoryInterface $userRoleRepository)
    {
        $this->userRoleRepository = $userRoleRepository;
    }

    public function setRoleOnUser(int $user_id, int $role_id): Model
    {
        return $this->userRoleRepository->setRoleOnUser($user_id, $role_id);
    }

}
