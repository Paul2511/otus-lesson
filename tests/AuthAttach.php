<?php


namespace Tests;

use App\Models\User;
use Illuminate\Testing\TestResponse;
use Tests\Generators\UserGenerator;

trait AuthAttach
{
    /**
     * @var User
     */
    protected $loginUser;

    /**
     * @var string
     */
    protected $token;

    /**
     * Устанавливает залогиненного пользователя
     * @param User $user
     * @return $this
     */
    protected function loginAs (User $user)
    {
        $this->loginUser = $user;

        return $this;
    }

    /**
     * Создает тестового пользователя
     * @param string|null $role
     * @return $this
     */
    protected function createUser(?string $role = User::ROLE_CLIENT)
    {
        $email = 'testlogin@user.com';

        $user = UserGenerator::generateRole($role, [
            'email' => $email
        ]);

        $payload = ['email' => $email, 'password' => env('USER_TEST_PASSWORD')];
        $this->token = auth('api')->attempt($payload);
        $this->loginAs($user);

        return $this;
    }

    /**
     * Возвращает текущего залогиненного пользователя
     * @return User
     */
    protected function currentUser(): User
    {
        if (!$this->loginUser) {
            $this->createUser();
        }
        return $this->loginUser;
    }

    /**
     * Возвращает токен текущего залогиненного пользователя
     * @return string
     */
    protected function getToken(): string
    {
        if (!$this->loginUser) {
            $this->createUser();
        }

        return $this->token;
    }

    /**
     * Устанавливает токен текущего залогиненного пользователя
     * @param string $token
     * @return $this
     */
    protected function setToken(string $token)
    {
        $this->token = $token;
        return $this;
    }

    protected function tokenHeader()
    {
        $token = $this->getToken();

        $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization'=>'Bearer ' . $token
        ]);

        return $this;
    }

}