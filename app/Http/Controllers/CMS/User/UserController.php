<?php

namespace App\Http\Controllers\CMS\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\Users\Repository\EloquentUserRepository;
use App\Services\Users\UsersServices;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $usersServices;

    public function __construct(UsersServices $usersServices)
    {
        $this->usersServices = $usersServices;
    }


    public function index()
    {
        return $this->usersServices->eloquentUserRepository->search();
    }


    public function create()
    {
        //
    }


    public function store(CreateUserRequest $request)
    {
        $this->usersServices->eloquentUserRepository->create($request->toArray());
    }


    public function show($id)
    {
        return $this->usersServices->eloquentUserRepository->findOrFail($id);
    }


    public function edit($id)
    {
        //
    }


    public function update(UpdateUserRequest $request, $id)
    {
        $entity = $this->usersServices->eloquentUserRepository->findOrFail($id);
        $entity->update($request->all());
        return $entity;
    }

    public function destroy($id)
    {
        $entity = $this->usersServices->eloquentUserRepository->findOrFail($id);
        return $entity->delete();
    }
}
