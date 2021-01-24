<?php


namespace Tests\Feature\Http\Controllers\Api\Auth;

use Tests\TestCase;
use Tests\AuthAttach;

class ApiAuthControllerRefreshTest extends TestCase
{
    use AuthAttach;

    private static $uri = 'api/auth/refresh';

    /**
     * @group auth
     * @group refreshToken
     */
    public function testWrongToken401()
    {
        $token = $this->getToken();

        $wrongToken = $token . 'wrong-salt';

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization'=>'Bearer ' . $wrongToken
        ])->json('post', self::$uri, ['accessToken'=>$wrongToken]);

        $response->assertStatus(401)
            ->assertJson(['success' => false])
            ->assertJsonFragment(['message'=>trans('auth.wrongToken')]);
    }

    /**
     * @group auth
     * @group refreshToken
     */
    public function testValidToken200()
    {
        $token = $this->getToken();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization'=>'Bearer ' . $token
        ])->json('post', self::$uri, ['accessToken'=>$token]);

        $newToken = json_decode($response->getContent(), true);
        if ($newToken && is_string($newToken)) {
            $this->setToken($newToken);
        }

        $response->assertStatus(200);
    }
}