<?php


namespace App\Services\Permissions\Handlers;


use App\Models\Permission;

class CreatePermissionHandler
{
    public function create(array $data)
    {
        return Permission::create($data);
    }

}
