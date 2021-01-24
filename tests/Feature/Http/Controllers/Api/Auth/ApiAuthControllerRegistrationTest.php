<?php


namespace Tests\Feature\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Notifications\User\UserWelcome;
use App\States\User\Role\ClientUserRole;
use Illuminate\Support\Facades\Bus;
use Tests\Generators\UserGenerator;
use Tests\TestCase;
use Tests\AuthAttach;
use Illuminate\Support\Facades\Notification;
class ApiAuthControllerRegistrationTest extends TestCase
{
    use AuthAttach;

    private static $uri = 'api/auth/registration';

    /**
     * @group auth
     * @group register
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
     * @group register
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
     * @group register
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
     * @group register
     */
    public function testWrongEmail422()
    {

        $payload = ['email' => 'wrongEmail', 'password' => env('USER_TEST_PASSWORD')];

        $this->json('POST', self::$uri, $payload)
            ->assertStatus(422)
            ->assertJson(['success' => false])
            ->assertJsonValidationErrors(['email']);
    }


    /**
     * Ошибка - пользователь с таким email уже существует
     * @group auth
     * @group register
     */
    public function testWrongEmailExists422()
    {
        UserGenerator::generateClient([
            'email' => 'testlogin@user.com'
        ]);

        $payload = ['email' => 'testlogin@user.com', 'password' => env('USER_TEST_PASSWORD')];

        $this->json('POST', self::$uri, $payload)
            ->assertStatus(422)
            ->assertJson(['success' => false])
            ->assertJsonValidationErrors(['email']);
    }

    /**
     * @group auth
     * @group register
     */
    public function testWrongLocale422()
    {

        $payload = [
            'email' => 'testlogin@user.com',
            'password' => env('USER_TEST_PASSWORD'),
            'locale' => 'fr'
        ];

        $this->json('POST', self::$uri, $payload)
            ->assertStatus(422)
            ->assertJson(['success' => false])
            ->assertJsonValidationErrors(['locale']);
    }

    /**
     * Удачная регистрация клиента
     * @group auth
     * @group register
     */
    public function testRegisterSuccessfully200()
    {
        $payload = [
            'email' => 'testlogin@user.com',
            'password' => env('USER_TEST_PASSWORD')
        ];

        $response= $this->json('POST', self::$uri, $payload);

        $response->assertJson(['success' => true])
            ->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'email' => 'testlogin@user.com',
            'role' => ClientUserRole::$name
        ]);
        /** @var User $user */
        $user = User::where(['email'=>'testlogin@user.com'])->first();

        $this->assertDatabaseHas('clients', [
            'user_id' => $user->id
        ]);
    }

    /**
     * Отправка письма при регистрации
     * @group auth
     * @group register
     * @group mail
     */
    public function testSendWelcomeEmail200()
    {
        $payload = [
            'email' => 'testlogin@user.com',
            'password' => env('USER_TEST_PASSWORD'),
            'sendWelcomeEmail' => true
        ];

        Notification::fake();

        $response= $this->json('POST', self::$uri, $payload);

        $response->assertJson(['success' => true])
            ->assertStatus(200);


        /** @var User $user */
        $user = User::where(['email'=>'testlogin@user.com'])->first();
        Notification::assertSentTo($user, UserWelcome::class);
    }
}