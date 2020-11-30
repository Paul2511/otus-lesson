<?php


namespace App\Services\Permissions\Handlers;


use App\Models\Permission;

class CreatePermissionHandler
{
    public function create(array $data)
    {
        Permission::create($data);
    }

}
