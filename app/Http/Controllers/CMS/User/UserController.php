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
    private $eloquentUserRepository;

    public function __construct(EloquentUserRepository $eloquentUserRepository)
    {
        $this->eloquentUserRepository = $eloquentUserRepository;
    }


    public function index()
    {

        return $this->eloquentUserRepository->getAll();
    }


    public function create()
    {
        //
    }


    public function store(CreateUserRequest $request)
    {
        $this->eloquentUserRepository->create($request->toArray());
    }


    public function show($id)
    {
        return $this->eloquentUserRepository->show($id);
    }


    public function edit($id)
    {
        //
    }


    public function update(UpdateUserRequest $request, $id)
    {
        $entity = $this->eloquentUserRepository->show($id);
        $entity->update($request->all());
        return $entity;
    }

    public function destroy($id)
    {
        $entity = $this->eloquentUserRepository->show($id);
        return $entity->delete();
    }
}
