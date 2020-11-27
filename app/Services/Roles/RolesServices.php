<?php


namespace App\Services\Roles;


use App\Services\Roles\Repository\EloquentRoleRepository;

class RolesServices
{
    public $eloquentRoleRepository;

    public function __construct(EloquentRoleRepository $eloquentRoleRepository)
    {
        $this->eloquentRoleRepository = $eloquentRoleRepository;
    }

}
