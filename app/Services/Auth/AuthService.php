<?php


namespace App\Services\Auth;

use App\Services\BaseService;
use App\Services\Users\UserService;
use Illuminate\Auth\Access\AuthorizationException;
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
            throw new AuthorizationException();
        } else {
            $userId = auth()->user()->getAuthIdentifier();

            $user = $this->userService->findUser($userId);
            $userData = $user['user'];

            $result = $this->setData([
                'accessToken' => $token,
                'userData' => $userData
            ])->success()->getData();
        }

        return $result;
    }
}