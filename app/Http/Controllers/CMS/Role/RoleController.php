<?php

namespace App\Http\Controllers\CMS\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleAndPermission\CreateRoleRequest;
use App\Http\Requests\RoleAndPermission\UpdateRoleRequest;
use App\Services\Roles\RolesServices;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private RolesServices $rolesServices;

    public function __construct(RolesServices $rolesServices)
    {
        $this->rolesServices = $rolesServices;
    }

    public function index(): View
    {
        $roles = $this->rolesServices->getRoles();
        return view('pages.cms.roles.index', compact('roles'));
    }

    public function store(CreateRoleRequest $request): Model
    {
        return $this->rolesServices->storeRole($request->toArray());
    }

    public function show($id): Model
    {
        return $this->rolesServices->findRole($id);
    }

    public function update(UpdateRoleRequest $request, int $id): bool
    {
        return $this->rolesServices->updateRole($request->toArray(), $id);
    }

    public function destroy(int $id): bool
    {
        return $this->rolesServices->deleteRole($id);
    }
}
