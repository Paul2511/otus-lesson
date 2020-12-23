<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use \Illuminate\Http\JsonResponse;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Services\Auth\AuthService;

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
        $this->middleware('auth.jwt:api', ['except' => ['login', 'registration']]);
        $this->authService = $authService;
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function login(AuthLoginRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');
        $result = $this->authService->login($credentials);
        return response()->json($result);
    }

    public function refresh()
    {
        $newToken = auth()->refresh();
        return response()->json($newToken);
    }

}
