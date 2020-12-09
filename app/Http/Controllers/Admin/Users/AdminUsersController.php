<?php

namespace App\Http\Controllers\Admin\Users;

use App;
use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Requests\AdminUsersStoreRequest;
use App\Http\Requests\AdminUsersUpdateRequest;
use App\Models\User;
use App\Policies\Ability;
use App\Services\Users\Repositories\EloquentUserRepository;
use App\Services\UsersService;

final class AdminUsersController extends AdminBaseController
{
    private UsersService $usersService;

    public function __construct(
        UsersService $usersService
    )
    {
        $this->usersService = $usersService;
    }

    public function index()
    {
        $this->authorize(Ability::VIEW_ANY, User::class);
        $users = $this->usersService->paginateUsers(self::DEFAULT_MODELS_PER_PAGE);
        $statuses = $this->getStatuses();
        $roles = $this->getRoles();
        return view('admin.users.index', compact('users', 'statuses', 'roles'));
    }

    public function store(AdminUsersStoreRequest $request)
    {
        $this->authorize(Ability::STORE, User::class);
        $user = $this->usersService->createUser($request->getFormData());

        return response()->json($user);
    }

    public function show($id)
    {
        $this->authorize(Ability::VIEW, User::class);
        $user = $this->usersService->findUserWithRelations($id);

        return response()->json($user);
    }

    public function update($id, AdminUsersUpdateRequest $request)
    {
        $this->authorize(Ability::UPDATE, User::class);
        $user = $this->usersService->updateUser($id, $request->getFormUpdateData());

        return response()->json($user);
    }

    public function destroy($id)
    {
        $this->authorize(Ability::DELETE, User::class);
        $user = $this->usersService->deleteUser($id);

        return response()->json($user);
    }

    private function getStatuses(): array
    {
        return $this->usersService->translateStatuses(App::getlocale());
    }

    private function getRoles(): array
    {
        return $this->usersService->translateRoles(App::getLocale());
    }
}
