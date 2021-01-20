<?php


namespace App\Services\Auth;

use App\Helpers\LogHelper;
use App\Services\BaseService;
use App\Services\Users\UserService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\UnauthorizedException;
use Log;
class AuthService extends BaseService
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
    public function login(array $credentials): array
    {
        $token = null;

        if (!$token = auth()->attempt($credentials)) {

            LogHelper::auth('Ошибка авторизации', [
                'data'=>$credentials
            ], 'error');

            throw new UnauthorizedException();
        } else {
            $userId = auth()->user()->getAuthIdentifier();

            $user = $this->userService->findUser($userId);
            $userData = $user['user'];

            LogHelper::auth('Авторизация пользователя', [
                'data'=>$credentials
            ]);

            $result = [
                'accessToken' => $token,
                'userData' => $userData,
                'success' => true
            ];
        }

        return $result;
    }
}