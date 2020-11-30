<?php


namespace App\Services\Permissions;


use App\Services\Permissions\Handlers\CreatePermissionHandler;
use App\Services\Permissions\Repository\EloquentPermissionRepository;

class PermissionsServices
{
    public $eloquentPermissionRepository;
    public $createPermissionHandler;

    public function __construct(
        EloquentPermissionRepository $eloquentPermissionRepository,
        CreatePermissionHandler $createPermissionHandler
    )
    {
        $this->eloquentPermissionRepository = $eloquentPermissionRepository;
        $this->createPermissionHandler = $createPermissionHandler;
    }

}
