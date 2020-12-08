<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUsersStoreRequest;
use App\Http\Requests\AdminUsersUpdateRequest;
use App\Http\Requests\BaseFormRequest;
use App\Models\User;
use App\Services\Users\Repositories\EloquentUserRepository;
use App\Services\Users\UsersService;
use Illuminate\Http\Request;

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
        $user = $this->usersService->createUser($request->getFormCreateData());
        return response()->json($user);
    }


    public function show(User $user)
    {
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
        $user = $this->usersService->updateUser($userId, $request->getFormUpdateData());

        return  response()->json($user);
    }

    public function active($userId, BaseFormRequest $request)
    {
        $user = $this->usersService->activeUser($userId, $request->getFormData());

        return  response()->json($user);
    }
}
