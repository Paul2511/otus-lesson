<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserUpdateRequest;
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
     * Ручное добавление нового пользователя
     */
    public function store(Request $request): JsonResponse
    {
        //
    }

    /**
     * Отображение одного пользователя
     */
    public function show(User $user): JsonResponse
    {
        $result = $this->usersService->findUser($user->id);
        return response()->json($result);
    }

    /**
     * Обновление данных профиля конкретного пользователя
     */
    public function update(UserUpdateRequest $request, User $user): JsonResponse
    {
        $result = $this->usersService->setUser($user->id, $request->getFromData());
        return response()->json($result);
    }

}
