<?php


namespace Tests\Feature\Http\Controllers\Api\Auth;

use Tests\Generators\UserGenerator;
use Tests\TestCase;
use Tests\AuthAttach;
class ApiAuthControllerLoginTest extends TestCase
{
    use AuthAttach;

    private static $uri = 'api/auth/login';

    /**
     * @group auth
     */
    public function testRequiresEmailAndPassword422()
    {
        $this->json('POST', self::$uri)
            ->assertStatus(422)
            ->assertJson(['success' => false])
            ->assertJsonValidationErrors(['email', 'password']);
    }


    /**
     * @group auth
     */
    public function testRequiresEmail422()
    {
        $payload = ['password' => env('USER_TEST_PASSWORD')];

        $this->json('POST', self::$uri, $payload)
            ->assertStatus(422)
            ->assertJson(['success' => false])
            ->assertJsonValidationErrors(['email']);
    }

    /**
     * @group auth
     */
    public function testRequiresPassword422()
    {
        $payload = ['email' => 'testlogin@user.com'];

        $this->json('POST', self::$uri, $payload)
            ->assertStatus(422)
            ->assertJson(['success' => false])
            ->assertJsonValidationErrors(['password']);
    }

    /**
     * @group auth
     */
    public function testWrongEmail403()
    {
        UserGenerator::generateClient([
            'email' => 'testlogin@user.com'
        ]);

        $payload = ['email' => 'wronglogin@user.com', 'password' => env('USER_TEST_PASSWORD')];

        $this->json('POST', self::$uri, $payload)
            ->assertStatus(403)
            ->assertJson(['success' => false])
            ->assertJsonValidationErrors(['password']);
    }

    /**
     * @group auth
     */
    public function testWrongPassword403()
    {
        UserGenerator::generateClient([
            'email' => 'testlogin@user.com'
        ]);

        $payload = ['email' => 'testlogin@user.com', 'password' => '54321'];

        $this->json('POST', self::$uri, $payload)
            ->assertStatus(403)
            ->assertJson(['success' => false])
            ->assertJsonValidationErrors(['password']);
    }

    /**
     * @group auth
     */
    public function testLoginSuccessfully200()
    {
        $user = UserGenerator::generateClient([
            'email' => 'testlogin@user.com'
        ]);

        $payload = ['email' => 'testlogin@user.com', 'password' => env('USER_TEST_PASSWORD')];

        $this->loginAs($user);

        $response= $this->json('POST', self::$uri, $payload);

        $answer = json_decode($response->getContent(), true);
        $token = $answer['accessToken'] ?? null;

        if ($token && is_string($token)) {
            $this->setToken($answer['accessToken']);
        }

        $response->assertJson(['success' => true])
            ->assertJsonStructure(['accessToken'])
            ->assertStatus(200);
    }

}