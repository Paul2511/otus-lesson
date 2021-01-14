<?php


namespace Tests\Feature\Auth;

use App\Services\Routes\Providers\Auth\AuthRoutes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\Generators\UsersGenerator;
use Tests\TestCase;
use Tests\AuthAttach;
class AuthLoginTest extends TestCase
{
    use AuthAttach;

    private static $uri = AuthRoutes::AUTH_LOGIN;

    /**
     * @group auth
     */
    public function testRequiresEmailAndPassword422()
    {
        $this->json('POST', self::$uri)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email', 'password']);
    }


    /**
     * @group auth
     */
    public function testRequiresEmail422()
    {
        $data = ['password' => env('USER_TEST_PASSWORD')];

        $this->json('POST', self::$uri, $data)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    /**
     * @group auth
     */
    public function testRequiresPassword422()
    {
        $data = ['email' => env('USER_TEST_EMAIL')];

        $this->json('POST', self::$uri, $data)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['password']);
    }

    /**
     * @group auth
     */
    public function testWrongEmailOrPassword422()
    {
        UsersGenerator::generatePlain([
            'email' => 'test@test.ru','is_active'=>1
        ]);

        $data = ['email' => env('USER_TEST_EMAIL'), 'password' => env('USER_TEST_PASSWORD')];

        $this->json('POST', self::$uri, $data)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    /**
     * @group auth
     */
    public function testLoginSuccessfully200()
    {
        $user = UsersGenerator::generatePlain([
            'email' => env('USER_TEST_EMAIL'), 'password' => Hash::make(env('USER_TEST_PASSWORD')),
            'is_active' => 1
        ]);

        $data = ['email' => env('USER_TEST_EMAIL'), 'password' => env('USER_TEST_PASSWORD')];
        $this->loginAs($user);

        $this->json('POST', self::$uri, $data)->assertStatus(200);
    }

}
