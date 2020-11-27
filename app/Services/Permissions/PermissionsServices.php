<?php


namespace App\Services\Permissions;


use App\Services\Permissions\Repository\EloquentPermissionRepository;

class PermissionsServices
{
    public $eloquentPermissionRepository;

    public function __construct(EloquentPermissionRepository $eloquentPermissionRepository)
    {
        $this->eloquentPermissionRepository = $eloquentPermissionRepository;
    }

}
