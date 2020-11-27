<?php

namespace App\Http\Controllers\CMS\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleAndPermission\CreateRoleRequest;
use App\Services\Roles\RolesServices;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private $rolesServices;

    public function __construct(RolesServices $rolesServices)
    {
        $this->rolesServices = $rolesServices;
    }

    public function index()
    {
        return $this->rolesServices->eloquentRoleRepository->search();
    }

    public function store(CreateRoleRequest $request)
    {
        $this->rolesServices->eloquentRoleRepository->create($request->toArray());
    }


    public function show($id)
    {
        return $this->rolesServices->eloquentRoleRepository->findOrFail($id);
    }
}
