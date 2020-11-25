<?php

namespace App\Http\Controllers\Admin\Users;

use App;
use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Requests\AdminUsersStoreRequest;
use App\Http\Requests\AdminUsersUpdateRequest;
use App\Services\UsersService;

final class AdminUsersController extends AdminBaseController
{
    private UsersService $UsersService;

    public function __construct(
        UsersService $UsersService
    )
    {
        $this->UsersService = $UsersService;
    }

    public function index()
    {
        $users = $this->UsersService->paginateUsers(self::DEFAULT_MODELS_PER_PAGE);
        $status = $this->getStatus();
        $roles = $this->getRoles();

        return view('admin.users.index', compact('users', 'status', 'roles'));
    }

    private function getStatus(): array
    {
        return $this->UsersService->translateStatus(App::getlocale());
    }

    private function getRoles(): array
    {
        return $this->UsersService->translateRoles(App::getLocale());
    }

    public function store(AdminUsersStoreRequest $request)
    {
        $user = $this->UsersService->createUser($request->getFormData());

        return response()->json($user);
    }

    public function show($id)
    {
        $user = $this->UsersService->showUser($id);

        return response()->json($user);
    }

    public function update(AdminUsersUpdateRequest $request, $id)
    {
        $user = $this->UsersService->updateUser($request->getFormUpdateData(), $id);

        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = $this->UsersService->deleteUser($id);

        return response()->json($user);
    }
}
