<?php

namespace App\Http\Controllers\CMS\Users;

use App\DataTables\UserDataTable;
use App\Http\Controllers\CMS\Users\Requests\CmsUserStoreRequest;
use App\Http\Controllers\CMS\Users\Requests\CmsUserUpdateRequest;
use App\Http\Controllers\CMS\Controller;
use App\Models\User;
use App\Policies\Permission;
use App\Services\Routes\CMS\CMSRoutes;
use App\Services\Users\UserService;
use Illuminate\Support\Facades\Auth;


class UsersController extends Controller
{

    private $usersService;

    public function __construct(UserService $usersService)
    {

        $this->usersService = $usersService;
    }

    public function index(UserDataTable $dataTable)
    {
        $this->authorize(Permission::VIEW_ANY,User::class);
        return $dataTable->render('cms.users.users-index');
    }

    public function create()
    {
        $this->authorize(Permission::CREATE,User::class);
        $types =$this->usersService->getTypeUsers();
        $statuses =$this->usersService->getStatusUsers();
        return view('cms.users.users-create',compact('types','statuses'));
    }

    public function store(CmsUserStoreRequest $request)
    {
        $this->authorize(Permission::CREATE,User::class);
        $this->usersService->createByArray($request->getFormData());
        return redirect()->route(CMSRoutes::CMS_USERS_INDEX);
    }


    public function edit(User $user)
    {
        $this->authorize(Permission::UPDATE,User::class);
        $types =$this->usersService->getTypeUsers();
        $statuses =$this->usersService->getStatusUsers();
        return view('cms.users.users-update',compact('user','types','statuses'));
    }

    public function update(CmsUserUpdateRequest $request,User $user)
    {
        $this->authorize(Permission::UPDATE,User::class);
        $this->usersService->updateByArray($user,$request->getFormData());
        return redirect()->route(CMSRoutes::CMS_USERS_INDEX);
    }

    public function destroy(User $user)
    {
        $this->authorize(Permission::DELETE,User::class);
        $this->usersService->delete($user);
        return redirect()->route(CMSRoutes::CMS_USERS_INDEX);
    }
}
