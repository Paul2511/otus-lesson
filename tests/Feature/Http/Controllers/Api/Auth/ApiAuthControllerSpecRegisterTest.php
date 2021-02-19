<?php


namespace Tests\Feature\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\RouteNames;
use App\Models\Specialization;
use App\Models\User;
use App\Notifications\User\UserWelcome;
use App\States\User\Role\ClientUserRole;
use App\States\User\Role\SpecialistUserRole;
use Tests\Generators\SpecializationGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;
use Tests\AuthAttach;
use Illuminate\Support\Facades\Notification;
class ApiAuthControllerSpecRegisterTest extends TestCase
{
    use AuthAttach;

    /**
     * @group auth
     * @group register
     * @group specRegister
     */
    public function testRequiresEmailAndPassword422()
    {
        $this->json('POST', route(RouteNames::V1_SPEC_REGISTRATION))
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email', 'password', 'password_confirmation']);
    }

    /**
     * @group auth
     * @group register
     * @group specRegister
     */
    public function testRequiresEmail422()
    {
        $payload = [
            'password' => env('USER_TEST_PASSWORD'),
            'password_confirmation' => env('USER_TEST_PASSWORD')
        ];

        $this->json('POST', route(RouteNames::V1_SPEC_REGISTRATION), $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    /**
     * @group auth
     * @group register
     * @group specRegister
     */
    public function testRequiresPassword422()
    {
        $payload = ['email' => 'testlogin@user.com'];

        $this->json('POST', route(RouteNames::V1_SPEC_REGISTRATION), $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['password']);
    }

    /**
     * @group auth
     * @group register
     * @group specRegister
     */
    public function testRequiresPasswordConfirm422()
    {
        $payload = [
            'email' => 'testlogin@user.com',
            'password' => env('USER_TEST_PASSWORD')
        ];

        $this->json('POST', route(RouteNames::V1_SPEC_REGISTRATION), $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['password_confirmation']);
    }

    /**
     * @group auth
     * @group register
     * @group specRegister
     */
    public function testRequiresPasswordNotMatch422()
    {
        $payload = [
            'email' => 'testlogin@user.com',
            'password' => env('USER_TEST_PASSWORD'),
            'password_confirmation' => 'test',
        ];

        $this->json('POST', route(RouteNames::V1_SPEC_REGISTRATION), $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['password_confirmation']);
    }

    /**
     * @group auth
     * @group register
     * @group specRegister
     */
    public function testWrongEmail422()
    {
        $payload = [
            'email' => 'wrongEmail',
            'password' => env('USER_TEST_PASSWORD'),
            'password_confirmation' => env('USER_TEST_PASSWORD'),
        ];

        $this->json('POST', route(RouteNames::V1_SPEC_REGISTRATION), $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }


    /**
     * Ошибка - пользователь с таким email уже существует
     * @group auth
     * @group register
     * @group specRegister
     */
    public function testWrongEmailExists422()
    {
        UserGenerator::generateClient([
            'email' => 'testlogin@user.com'
        ]);

        $payload = ['email' => 'testlogin@user.com', 'password' => env('USER_TEST_PASSWORD')];

        $this->json('POST', route(RouteNames::V1_SPEC_REGISTRATION), $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    /**
     * @group auth
     * @group register
     * @group specRegister
     */
    public function testWrongLocale422()
    {

        $payload = [
            'email' => 'testlogin@user.com',
            'password' => env('USER_TEST_PASSWORD'),
            'password_confirmation' => env('USER_TEST_PASSWORD'),
            'locale' => 'fr'
        ];

        $this->json('POST', route(RouteNames::V1_SPEC_REGISTRATION), $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['locale']);
    }

    /**
     * Удачная регистрация специалиста
     * @group auth
     * @group register
     * @group specRegister
     */
    public function testRegisterSuccessfully201()
    {
        $specializations = SpecializationGenerator::generate(3);
        /** @var Specialization $specialization */
        $specialization = $specializations->random();

        $payload = [
            'email' => 'testlogin@user.com',
            'password' => env('USER_TEST_PASSWORD'),
            'password_confirmation' => env('USER_TEST_PASSWORD'),
            'specialistData' => ['specialization_id'=>$specialization->id]
        ];

        $response= $this->json('POST', route(RouteNames::V1_SPEC_REGISTRATION), $payload);

        $response->assertStatus(Controller::JSON_STATUS_CREATED);

        $this->assertDatabaseHas('users', [
            'email' => 'testlogin@user.com',
            'role' => SpecialistUserRole::$name
        ]);
        /** @var User $user */
        $user = User::where(['email'=>'testlogin@user.com'])->first();

        $this->assertDatabaseHas('specialists', [
            'user_id' => $user->id,
            'specialization_id' => $specialization->id
        ]);
    }

    /**
     * Отправка письма при регистрации
     * @group auth
     * @group register
     * @group specRegister
     * @group mail
     */
    public function testSendWelcomeEmail201()
    {
        $payload = [
            'email' => 'testlogin@user.com',
            'password' => env('USER_TEST_PASSWORD'),
            'password_confirmation' => env('USER_TEST_PASSWORD'),
            'sendWelcomeEmail' => true
        ];

        Notification::fake();

        $response= $this->json('POST', route(RouteNames::V1_SPEC_REGISTRATION), $payload);

        $response->assertStatus(Controller::JSON_STATUS_CREATED);


        /** @var User $user */
        $user = User::where(['email'=>'testlogin@user.com'])->first();
        Notification::assertSentTo($user, UserWelcome::class);
    }

    /**
     * Специализации не существует - она игнорируется
     * @group auth
     * @group register
     * @group specRegister
     */
    public function testRegisterSpecNotFoundSuccess201()
    {
        $specializations = SpecializationGenerator::generate(1);

        $payload = [
            'email' => 'testlogin@user.com',
            'password' => env('USER_TEST_PASSWORD'),
            'password_confirmation' => env('USER_TEST_PASSWORD'),
            'specialistData' => ['specialization_id'=>1000]
        ];

        $response= $this->json('POST', route(RouteNames::V1_SPEC_REGISTRATION), $payload);

        $response->assertStatus(Controller::JSON_STATUS_CREATED);

        $this->assertDatabaseHas('users', [
            'email' => 'testlogin@user.com',
            'role' => SpecialistUserRole::$name
        ]);

        /** @var User $user */
        $user = User::where(['email'=>'testlogin@user.com'])->first();

        $this->assertDatabaseHas('specialists', [
            'user_id' => $user->id,
            'specialization_id' => null
        ]);
    }
}