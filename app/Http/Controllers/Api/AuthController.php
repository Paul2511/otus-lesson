<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRegisterRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\Auth\DTO\AuthLoginData;
use App\Services\Users\Dto\UserRegisterData;
use App\States\User\Role\ClientUserRole;
use \Illuminate\Http\JsonResponse;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Services\Auth\AuthService;
use App\Services\Users\UserService;
use Illuminate\Http\Resources\Json\JsonResource;

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
        $authLoginData = AuthLoginData::fromRequest($request);
        $token = $authService->login($authLoginData);

        /** @var User $user */
        $user = auth()->user();
        return response()->json([
            'accessToken' => $token,
            'userData' => $user
        ]);
    }

    public function refresh(): JsonResponse
    {
        $newToken = auth()->refresh();
        return response()->json($newToken);
    }

    /**
     * @throws \App\Exceptions\User\UserRegisterException
     */
    public function registration(UserRegisterRequest $request, UserService $userService): JsonResponse
    {
        $userData = UserRegisterData::fromRequest($request);
        $userData->role = ClientUserRole::$name; //жестко зашиваем в клиентском контроллере
        $userService->registerUser($userData);

        return response()->json([], self::JSON_STATUS_CREATED);
    }


    public function profile(): JsonResource
    {
        /** @var User $user */
        $user = auth()->user();
        return new UserResource($user);
    }

}
