<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRegisterRequest;
use App\Models\User;
use App\Services\Users\Dto\UserRegisterData;
use \Illuminate\Http\JsonResponse;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Services\Auth\AuthService;
use App\Services\Users\UserService;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth.jwt:api', ['except' => ['login', 'registration']]);
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function login(AuthLoginRequest $request, AuthService $authService): JsonResponse
    {
        $credentials = $request->only('email', 'password');
        $result = $authService->login($credentials);
        return response()->json($result);
    }

    public function refresh()
    {
        $newToken = auth()->refresh();
        return response()->json($newToken);
    }


    public function registration(UserRegisterRequest $request, UserService $userService)
    {
        $userData = UserRegisterData::fromRequest($request);
        $userData->role = User::ROLE_CLIENT; //жестко зашиваем в клиентском контроллере
        $user = $userService->registerUser($userData);

        return response()->json(
            ['success'=>$user?true:false]
        );
    }

}
