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


    public function create()
    {
        //
    }


    public function store(CreateUserRequest $request)
    {
        $this->usersServices->storeUser($request->toArray());
    }


    public function show($id)
    {
        return $this->usersServices->findUser($id);
    }


    public function edit($id)
    {
        //
    }


    public function update(UpdateUserRequest $request, $id)
    {
        $this->usersServices->updateUser($request->toArray(),$id);
    }

    public function destroy($id)
    {
        return $this->usersServices->deleteUser($id);
    }
}
