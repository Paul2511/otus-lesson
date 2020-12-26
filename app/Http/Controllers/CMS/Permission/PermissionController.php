<?php

namespace App\Http\Controllers\CMS\Permission;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleAndPermission\CreatePermissionRequest;
use App\Http\Requests\RoleAndPermission\UpdatePermissionRequest;
use App\Services\Permissions\PermissionsServices;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;


class PermissionController extends Controller
{
    private PermissionsServices $permissionsServices;

    public function __construct(PermissionsServices $permissionsServices)
    {
        $this->permissionsServices = $permissionsServices;
    }

    public function index(): View
    {
        $permissions = $this->permissionsServices->getPermissions();

        return view('pages.cms.permissions.index', compact('permissions'));
    }

    public function store(CreatePermissionRequest $request): Model
    {
        return $this->permissionsServices->storePermission($request->toArray());
    }

    public function show(int $id): Model
    {
        return $this->permissionsServices->findPermission($id);
    }

    public function update(UpdatePermissionRequest $request, int $id): bool
    {
        return $this->permissionsServices->updatePermission($request->toArray(), $id);
    }

    public function destroy(int $id): bool
    {
        return $this->permissionsServices->deletePermission($id);
    }
}
