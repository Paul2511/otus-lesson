<?php


namespace Tests\Feature\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\RouteNames;
use Tests\Generators\UserGenerator;
use Tests\TestCase;
use Tests\AuthAttach;
class ApiAuthControllerLoginTest extends TestCase
{
    use AuthAttach;

    /**
     * @group auth
     * @group login
     */
    public function testRequiresEmailAndPassword422()
    {
        $this->json('POST', route(RouteNames::V1_LOGIN))
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email', 'password']);
    }


    /**
     * @group auth
     * @group login
     */
    public function testRequiresEmail422()
    {
        $payload = ['password' => env('USER_TEST_PASSWORD')];

        $this->json('POST', route(RouteNames::V1_LOGIN), $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    /**
     * @group auth
     * @group login
     */
    public function testRequiresPassword422()
    {
        $payload = ['email' => 'testlogin@user.com'];

        $this->json('POST', route(RouteNames::V1_LOGIN), $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['password']);
    }

    /**
     * @group auth
     * @group login
     */
    public function testWrongEmail403()
    {
        UserGenerator::generateClient([
            'email' => 'testlogin@user.com'
        ]);

        $payload = ['email' => 'wronglogin@user.com', 'password' => env('USER_TEST_PASSWORD')];

        $this->json('POST', route(RouteNames::V1_LOGIN), $payload)
            ->assertStatus(403)
            ->assertJsonValidationErrors(['password']);
    }

    /**
     * @group auth
     * @group login
     */
    public function testWrongPassword403()
    {
        UserGenerator::generateClient([
            'email' => 'testlogin@user.com'
        ]);

        $payload = ['email' => 'testlogin@user.com', 'password' => '54321'];

        $this->json('POST', route(RouteNames::V1_LOGIN), $payload)
            ->assertStatus(403)
            ->assertJsonValidationErrors(['password']);
    }

    /**
     * @group auth
     * @group login
     */
    public function testLoginSuccessfully200()
    {
        $user = UserGenerator::generateClient([
            'email' => 'testlogin@user.com'
        ]);

        $payload = ['email' => 'testlogin@user.com', 'password' => env('USER_TEST_PASSWORD')];

        $this->loginAs($user);

        $response= $this->json('POST', route(RouteNames::V1_LOGIN), $payload);

        $answer = json_decode($response->getContent(), true);
        $token = $answer['accessToken'] ?? null;

        if ($token && is_string($token)) {
            $this->setToken($answer['accessToken']);
        }

        $response
            ->assertJsonStructure(['accessToken'])
            ->assertStatus(Controller::JSON_STATUS_OK);
    }

}