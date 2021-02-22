<?php


namespace App\Services\Auth;

use App\Exceptions\Auth\ForgotPasswordException;
use App\Exceptions\Auth\ResetPasswordException;
use App\Services\Auth\DTO\AuthLoginData;
use App\Services\Auth\DTO\AuthResetPasswordData;
use App\Services\Auth\Handlers\ChangePasswordHandler;
use Support\Log\LogHelper;
use App\Services\Users\UserService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Password;
class AuthService
{

    /**
     * @var UserService
     */
    private $userService;
    /**
     * @var ChangePasswordHandler
     */
    private $passwordHandler;

    public function __construct(UserService $userService, ChangePasswordHandler $passwordHandler)
    {
        $this->userService = $userService;
        $this->passwordHandler = $passwordHandler;
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

    /**
     * @throws \App\Exceptions\Auth\ChangePasswordException
     */
    public function changePassword(string $password, ?int $userId)
    {
        if (!$userId) {
             $userId = auth()->user()->getAuthIdentifier();
        }

        $user = $this->userService->findUser($userId);

        $this->passwordHandler->handle($user, $password);
    }

    /**
     * @throws ForgotPasswordException
     */
    public function forgotPassword(array $credentials): void
    {
        try {
            $status = Password::sendResetLink($credentials);

            if ($status !== Password::RESET_LINK_SENT) {
                throw new ForgotPasswordException(__($status));
            }

        } catch (\Throwable $e) {
            throw new ForgotPasswordException($e->getMessage());
        }
    }

    /**
     * @throws ResetPasswordException
     */
    public function resetPassword(AuthResetPasswordData $resetData): void
    {
        $data = $resetData->toArray();

        try {
            $status = Password::reset($data, function ($user, $password) {
                $this->passwordHandler->handle($user, $password);
            });

            if ($status !== Password::PASSWORD_RESET) {
                throw new ResetPasswordException(__($status), 403);
            }
        } catch (\Throwable $e) {
            throw new ResetPasswordException($e->getMessage(), 403);
        }

    }
}