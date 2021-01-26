<?php


namespace App\Services\Auth\Register;


use App\Services\Roles\RolesServices;
use App\Services\UserRole\UserRoleService;
use App\Services\Users\Repository\Interfaces\EloquentUserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class RegisterService
{
    private EloquentUserRepositoryInterface $userRepository;
    private UserRoleService $userRoleService;
    private RolesServices $rolesServices;

    public function __construct(EloquentUserRepositoryInterface $userRepository, UserRoleService $userRoleService, RolesServices $rolesServices)
    {
        $this->userRepository = $userRepository;
        $this->userRoleService = $userRoleService;
        $this->rolesServices = $rolesServices;
    }

    public function register(array $data): Model
    {
        $user = $this->userRepository->create($data);
        $role = $this->rolesServices->getDefaultRole();
        $this->userRoleService->setRoleOnUser($user->id, $role->id);
        return $user;
    }


}
