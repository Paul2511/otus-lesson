<?php

namespace App\Http\Controllers\CMS\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\Users\UsersServices;

class UserController extends Controller
{
    private UsersServices $usersServices;

    public function __construct(UsersServices $usersServices)
    {
        $this->usersServices = $usersServices;
    }

    public function index()
    {
        return $this->usersServices->getUsers();
    }

    public function store(CreateUserRequest $request)
    {
        return $this->usersServices->storeUser($request->toArray());
    }


    public function show($id)
    {
        return $this->usersServices->findUser($id);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $this->usersServices->updateUser($request->toArray(), $id);
    }

    public function destroy(int $id)
    {
        return $this->usersServices->deleteUser($id);
    }
}
