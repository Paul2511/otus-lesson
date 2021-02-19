<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthChangePasswordRequest;
use App\Http\Requests\User\UserRegisterRequest;
use App\Http\Resources\User\UserResource;
use App\Models\Pet;
use App\Models\User;
use App\Services\Auth\DTO\AuthLoginData;
use App\Services\Users\Dto\UserRegisterData;
use App\States\User\Role\ClientUserRole;
use App\States\User\Role\SpecialistUserRole;
use Illuminate\Auth\Access\AuthorizationException;
use \Illuminate\Http\JsonResponse;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Services\Auth\AuthService;
use App\Services\Users\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthController extends Controller
{

    /**
     * @var AuthService
     */
    private $authService;

    public function __construct(
        AuthService $authService
    )
    {
        $this->middleware('auth.jwt:api', ['except' => ['login', 'clientRegister', 'specRegister']]);
        $this->authService = $authService;
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function login(AuthLoginRequest $request): JsonResponse
    {
        $authLoginData = AuthLoginData::fromRequest($request);
        $token = $this->authService->login($authLoginData);

        /** @var User $user */
        $user = auth()->user();
        return response()->json([
            'accessToken' => $token,
            'userData' => $user
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function loginAs(Request $request) {
        if (!$this->authorize('loginAs', User::class)) {
            throw new AuthorizationException();
        }

        $userId = $request->get('userId');

        $token = $this->authService->loginAs($userId);

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
    public function clientRegister(UserRegisterRequest $request, UserService $userService): JsonResponse
    {
        $userData = UserRegisterData::fromRequest($request);
        $userData->role = ClientUserRole::$name;
        $userData->sendWelcomeEmail = true;

        $userService->registerUser($userData);

        $message = [
            'message'=>[
                'title'=>trans('form.message.registerTitle'),
                'text'=>trans('form.message.registerText')]
        ];

        return response()->json($message, self::JSON_STATUS_CREATED);
    }


    /**
     * @throws \App\Exceptions\User\UserRegisterException
     */
    public function specRegister(UserRegisterRequest $request, UserService $userService): JsonResponse
    {
        $userData = UserRegisterData::fromRequest($request);
        $userData->role = SpecialistUserRole::$name;
        $userData->sendWelcomeEmail = true;

        $userService->registerUser($userData);

        $message = [
            'message'=>[
                'title'=>trans('form.message.registerTitle'),
                'text'=>trans('form.message.registerText')]
        ];

        return response()->json($message, self::JSON_STATUS_CREATED);
    }


    public function profile(): JsonResource
    {
        /** @var User $user */
        $user = auth()->user();
        return new UserResource($user);
    }

    /**
     * @throws AuthorizationException
     * @throws \App\Exceptions\Auth\ChangePasswordException
     */
    public function changePassword(AuthChangePasswordRequest $request)
    {
        $userId = $request->get('userId');
        $password = $request->get('newPassword');

        if ($userId && !$this->authorize('changePassword', User::class)) {
            throw new AuthorizationException();
        }

        $this->authService->changePassword($password, $userId);

        $message = [
            'message'=>[
                'title'=>trans('form.message.successTitle'),
                'text'=>trans('form.message.successPasswordChangeText')]
        ];

        return response()->json($message);
    }
}
