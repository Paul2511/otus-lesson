<?php

namespace App\Http\Controllers\Admin\Users;

use App;
use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Requests\AdminUsersStoreRequest;
use App\Http\Requests\AdminUsersUpdateRequest;
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
        $users = $this->usersService->paginateUsers(self::DEFAULT_MODELS_PER_PAGE);
        $statuses = $this->getStatuses();
        $roles = $this->getRoles();

        return view('admin.users.index', compact('users', 'statuses', 'roles'));
    }

    private function getStatuses(): array
    {
        return $this->usersService->translateStatuses(App::getlocale());
    }

    private function getRoles(): array
    {
        return $this->usersService->translateRoles(App::getLocale());
    }

    public function store(AdminUsersStoreRequest $request)
    {
        $user = $this->usersService->createUser($request->getFormData());

        return response()->json($user);
    }

    public function show($id)
    {
        $user = $this->usersService->findUser($id);

        return response()->json($user);
    }

    public function update($id, AdminUsersUpdateRequest $request)
    {
        $user = $this->usersService->updateUser($id, $request->getFormUpdateData());

        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = $this->usersService->deleteUser($id);

        return response()->json($user);
    }
}
