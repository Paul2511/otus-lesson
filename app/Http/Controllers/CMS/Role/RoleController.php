<?php

namespace App\Http\Controllers\CMS\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleAndPermission\CreateRoleRequest;
use App\Http\Requests\RoleAndPermission\UpdateRoleRequest;
use App\Services\Roles\RolesServices;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private RolesServices $rolesServices;

    public function __construct(RolesServices $rolesServices)
    {
        $this->rolesServices = $rolesServices;
    }

    public function index()
    {
        return $this->rolesServices->getRoles();
    }

    public function store(CreateRoleRequest $request)
    {
        return $this->rolesServices->storeRole($request->toArray());
    }


    public function show($id)
    {
        return $this->rolesServices->findRole($id);
    }

    public function update(UpdateRoleRequest $request, int $id)
    {
        return $this->rolesServices->updateRole($request->toArray(), $id);
    }

    public function destroy(int $id)
    {
        return $this->rolesServices->deleteRole($id);
    }
}
