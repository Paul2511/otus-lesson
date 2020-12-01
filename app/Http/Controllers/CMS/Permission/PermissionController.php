<?php

namespace App\Http\Controllers\CMS\Permission;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleAndPermission\CreatePermissionRequest;
use App\Http\Requests\RoleAndPermission\UpdatePermissionRequest;
use App\Services\Permissions\PermissionsServices;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    private PermissionsServices $permissionsServices;

    public function __construct(PermissionsServices $permissionsServices)
    {
        $this->permissionsServices = $permissionsServices;
    }

    public function index()
    {
        return $this->permissionsServices->getPermission();
    }

    public function store(CreatePermissionRequest $request)
    {
        $this->permissionsServices->storePermission($request->toArray());
    }


    public function show(int $id)
    {
        return $this->permissionsServices->findPermission($id);
    }

    public function update(UpdatePermissionRequest $request, int $id)
    {
        return $this->permissionsServices->updatePermission($request->toArray(), $id);
    }

    public function destroy(int $id)
    {
        return $this->permissionsServices->deletePermission($id);
    }
}
