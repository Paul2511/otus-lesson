<?php


namespace App\Services\Roles\Handlers;


use App\Models\Role;

class CreateRoleHandler
{
    public function create(array $data)
    {
        Role::create($data);
    }

}
