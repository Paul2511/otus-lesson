<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUsersStoreRequest;
use App\Http\Requests\AdminUsersUpdateRequest;
use App\Http\Requests\BaseFormRequest;
use App\Models\User;
use App\Services\Users\UsersService;

use View;

class AdminUsersController extends Controller
{
    private UsersService $usersService;

    public function __construct(
        UsersService $usersService
    ) {
        $this->usersService = $usersService;
    }

    public function index()
    {
        $users = $this->usersService->getUsers();
        $this->sharePageData([
            'page_name' => 'index',
            'users'=>$users,
        ]);
        return view('pages.users.users');
    }


    public function create()
    {
        $this->sharePageData([
            'page_name' => 'create'
        ]);
        return view('pages.users.user_create');
    }


    public function store(AdminUsersStoreRequest $request)
    {
        $user = $this->usersService->createUser($request->getFormCreateData());
        return response()->json($user);
    }


    public function show(User $user)
    {
        $projects = $this->usersService->getUserProjects($user->id);

        $this->sharePageData([
            'page_name' => 'profile',
            'user'=>$user,
            'projects'=>json_encode($projects, true)
        ]);
        return view('pages.users.user_profile');
    }


    public function edit(User $user)
    {
        $resources = $this->usersService->getResourceIds($user->id);
        $projects = $this->usersService->getUserProjects($user->id);

        $this->sharePageData([
            'page_name' => 'edit',
            'user'=>$user,
            'resources'=>json_encode($resources, true),
            'projects'=>json_encode($projects, true)
        ]);

        return view('pages.users.user_edit');
    }


    public function update($userId, AdminUsersUpdateRequest $request)
    {
        $user = $this->usersService->updateUser($userId, $request->getFormUpdateData());

        return  response()->json($user);
    }

    public function active($userId, BaseFormRequest $request)
    {
        $user = $this->usersService->activeUser($userId, $request->getFormData());

        return  response()->json($user);
    }

    function sharePageData(array $data): void
    {
        View::share(array_merge([
            'category_name' => 'users',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
        ], $data));
    }
}
