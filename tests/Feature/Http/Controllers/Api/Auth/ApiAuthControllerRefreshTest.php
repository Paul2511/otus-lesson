<?php


namespace Tests\Feature\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\RouteNames;
use Tests\TestCase;
use Tests\AuthAttach;

class ApiAuthControllerRefreshTest extends TestCase
{
    use AuthAttach;

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
        ])->json('post', route(RouteNames::V1_TOKEN_REFRESH), ['accessToken'=>$wrongToken]);


        $response->assertStatus(401)
            ->assertJsonFragment(['message'=>trans('auth.wrongToken')]);
    }

    /**
     * @group auth
     * @group refreshToken
     */
    public function testWithoutToken401()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->json('post', route(RouteNames::V1_TOKEN_REFRESH));


        $response->assertStatus(401)
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
        ])->json('post', route(RouteNames::V1_TOKEN_REFRESH), ['accessToken'=>$token]);

        $newToken = json_decode($response->getContent(), true);
        if ($newToken && is_string($newToken)) {
            $this->setToken($newToken);
        }

        $response->assertStatus(Controller::JSON_STATUS_OK);
    }
}