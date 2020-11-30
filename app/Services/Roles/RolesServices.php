<?php


namespace App\Services\Roles;


use App\Services\Roles\Handlers\CreateRoleHandler;
use App\Services\Roles\Repository\EloquentRoleRepository;

class RolesServices
{
    public $eloquentRoleRepository;
    public $createRoleHandler;

    public function __construct(
        EloquentRoleRepository $eloquentRoleRepository,
        CreateRoleHandler $createRoleHandler
    )
    {
        $this->eloquentRoleRepository = $eloquentRoleRepository;
        $this->createRoleHandler = $createRoleHandler;
    }

}
