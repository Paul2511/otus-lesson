<?php

namespace App\Http\Controllers\CMS\Permission;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleAndPermission\CreatePermissionRequest;
use App\Services\Permissions\PermissionsServices;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    private $permissionsServices;

    public function __construct(PermissionsServices $permissionsServices)
    {
        $this->permissionsServices = $permissionsServices;
    }

    public function index()
    {
        return $this->permissionsServices->eloquentPermissionRepository->search();
    }

    public function store(CreatePermissionRequest $request)
    {
        $this->permissionsServices->eloquentPermissionRepository->create($request->toArray());
    }


    public function show($id)
    {
        return $this->permissionsServices->eloquentPermissionRepository->findOrFail($id);
    }
}
