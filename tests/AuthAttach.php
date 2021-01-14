<?php


namespace Tests;

use App\Models\User;
use Illuminate\Testing\TestResponse;
use Tests\Generators\UsersGenerator;

trait AuthAttach
{
    protected $loginUser;
    protected $token;

    /**
     * @return $this
     */
    protected function loginAs (User $user)
    {
        $this->loginUser = $user;
        return $this;
    }

    protected function currentUser(): User
    {
        if (!$this->loginUser) {
            $user=UsersGenerator::generateAdmin();
            $this->loginAs($user);
        }
        return $this->loginUser;
    }

    protected function getToken(): string
    {
        if (!$this->loginUser) {
            $user=UsersGenerator::generateAdmin();
            $this->loginAs($user);
        }
        return $this->token;
    }

    /**
     * @return $this
     */
    protected function setToken(string $token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return $this
     */
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

    protected function ddResponse(TestResponse $response)
    {
        $content = $response->getContent();
        dd(json_decode($content, true));
    }

}
