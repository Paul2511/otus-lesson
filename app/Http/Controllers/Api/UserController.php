<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\ViewModels\User\UserShowViewModel;
use App\Http\ViewModels\User\UserUpdateViewModel;
use App\Services\Users\DTO\UserUpdateData;
use Illuminate\Http\Request;
use App\Services\Users\UserService;
use \Illuminate\Http\JsonResponse;
use App\Models\User;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    private $usersService;

    public function __construct(UserService $usersService)
    {
        $this->usersService = $usersService;
        $this->middleware('auth.jwt:api');

        //Один метод вместо $this->authorize
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Отображает список всех пользователей
     */
    public function index(): JsonResponse
    {
        //
    }


    /**
     * Отображение одного пользователя
     */
    public function show(User $user): JsonResponse
    {
        $user = $this->usersService->findUser($user->id);
        $viewModel = new UserShowViewModel($user);

        return $viewModel->json();
    }

    /**
     * @throws \App\Exceptions\User\UserUpdateException
     */
    public function update(UserUpdateRequest $request, User $user): JsonResponse
    {
        $data = UserUpdateData::fromRequest($request);

        $user = $this->usersService->updateUser($user, $data);

        $viewModel = new UserUpdateViewModel($user);
        return $viewModel->json();
    }

}
