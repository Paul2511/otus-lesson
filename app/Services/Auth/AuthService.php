<?php


namespace App\Services\Auth;

use App\Services\Auth\DTO\AuthLoginData;
use Support\Log\LogHelper;
use App\Services\Users\UserService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthService
{

    /**
     * @var UserService
     */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Возвращает результат авторизации
     * @throws AuthorizationException
     */
    public function login(AuthLoginData $authLoginData): string
    {
        $token = null;

        $credentials = $authLoginData->toArray();
        if (!$token = auth()->attempt($credentials)) {
            LogHelper::auth('Ошибка авторизации', [
                'data'=>$credentials
            ], 'error');
            throw new UnauthorizedException();
        } else {
            LogHelper::auth('Авторизация пользователя', [
                'data'=>$credentials
            ]);
            return $token;
        }
    }

    public function loginAs(int $userId): string
    {
        if (auth()->onceUsingId($userId)) {
            $token = auth()->login(auth()->user());
            if ($token) {
                return $token;
            }
        }

        throw new NotFoundHttpException();
    }
}