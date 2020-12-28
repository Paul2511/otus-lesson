<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Requests\AdminUsersStoreRequest;
use App\Http\Requests\AdminUsersUpdateRequest;
use App\Http\Requests\BaseFormRequest;
use App\Models\User;
use App\Policies\Permissions;
use App\Services\Users\UsersService;

use View;

class AdminUsersController extends AdminBaseController
{

    private UsersService $usersService;

    public function __construct(
        UsersService $usersService
    ) {
        $this->usersService = $usersService;
    }

    public function index()
    {
        $this->authorize(Permissions::VIEW_ANY,User::class);
        $users = $this->usersService->getUsers();
        View::share([
            'users'=>$users,
            'category_name' => 'users',
            'page_name' => 'index',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ]);
        return view('pages.users.users');
    }


    public function create()
    {
        $this->authorize(Permissions::CREATE,User::class);
        View::share([
            'category_name' => 'users',
            'page_name' => 'create',
            'has_scrollspy' => 0,
            'scrollspy_offset' => ''
        ]);
        return view('pages.users.user_create');
    }


    public function store(AdminUsersStoreRequest $request)
    {

        $this->authorize(Permissions::CREATE,User::class);
        $user = $this->usersService->createUser($request->getFormCreateData());
        return response()->json($user);
    }


    public function show(User $user)
    {
        $this->authorize(Permissions::VIEW,$user);
        $projects = $this->usersService->getUserProjects($user->id);
        View::share([
            'user'=>$user,
            'projects'=>json_encode($projects, true),
            'category_name' => 'users',
            'page_name' => 'profile',
            'has_scrollspy' => 0,
            'scrollspy_offset' => ''
        ]);
        return view('pages.users.user_profile');
    }


    public function edit(User $user)
    {
        $this->authorize(Permissions::UPDATE,$user);
        $resources = $this->usersService->getResourceIds($user->id);
        $projects = $this->usersService->getUserProjects($user->id);

        View::share([
            'user'=>$user,
            'resources'=>json_encode($resources, true),
            'projects'=>json_encode($projects, true),
            'category_name' => 'users',
            'page_name' => 'edit',
            'has_scrollspy' => 0,
            'scrollspy_offset' => ''
        ]);
        return view('pages.users.user_edit');
    }


    public function update($userId, AdminUsersUpdateRequest $request)
    {
        $this->authorize(Permissions::UPDATE,$userId);
        $user = $this->usersService->updateUser($userId, $request->getFormUpdateData());

        return  response()->json($user);
    }

    public function activate($userId, BaseFormRequest $request)
    {
        $this->authorize(Permissions::ACTIVATE,$userId);
        $user = $this->usersService->activateUser($userId, $request->getFormData());

        return  response()->json($user);
    }
}
