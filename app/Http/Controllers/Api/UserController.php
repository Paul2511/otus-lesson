<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserUpdateRequest;
use Illuminate\Http\Request;
use App\Services\Users\UserService;
use \Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    private $usersService;

    public function __construct(UserService $usersService)
    {

        $this->usersService = $usersService;
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
    public function show(int $id): JsonResponse
    {
        $result = $this->usersService->getUser($id);
        return response()->json($result);
    }

    /**
     * Обновление данных профиля конкретного пользователя
     */
    public function update(UserUpdateRequest $request, int $id): JsonResponse
    {
        $result = $this->usersService->setUser($id, $request->getFromData());
        return response()->json($result);
    }

}
