<?php


namespace Tests\Feature\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\RouteNames;
use App\Models\Specialization;
use App\Models\User;
use App\Notifications\User\UserWelcome;
use App\States\User\Role\SpecialistUserRole;
use Tests\Generators\SpecializationGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;
use Tests\AuthAttach;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\ResetPassword;
class ApiAuthControllerResetPasswordTest extends TestCase
{
    use AuthAttach;

    /**
     * @group auth
     * @group resetPassword
     */
    public function testRequiresEmailAndPassword422()
    {
        $this->json('POST', route(RouteNames::V1_RESET_PASSWORD))
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email', 'password', 'password_confirmation', 'token']);
    }

    /**
     * @group auth
     * @group resetPassword
     */
    public function testSuccessfully200()
    {
        $email = 'testlogin@user.com';
        $user = UserGenerator::generateClient(['email' => $email]);
        $payload = ['email' => $email];

        Notification::fake();

        $this->json('POST', route(RouteNames::V1_FORGOT_PASSWORD), $payload)->assertStatus(Controller::JSON_STATUS_OK);

        $token = '';

        Notification::assertSentTo(
            $user,
            ResetPassword::class,
            function ($notification, $channels) use (&$token) {
                $token = $notification->token;
                return true;
            });

        $payload = [
            'email' => $email,
            'password' => env('USER_TEST_PASSWORD'),
            'password_confirmation' => env('USER_TEST_PASSWORD'),
            'token' => $token
        ];

        $response= $this->json('POST', route(RouteNames::V1_RESET_PASSWORD), $payload);

        $response->assertStatus(Controller::JSON_STATUS_OK);
    }


    /**
     * @group auth
     * @group resetPassword
     */
    public function testRequiresEmail422()
    {
        $email = 'testlogin@user.com';
        $user = UserGenerator::generateClient(['email' => $email]);
        $payload = ['email' => $email];

        Notification::fake();

        $this->json('POST', route(RouteNames::V1_FORGOT_PASSWORD), $payload)->assertStatus(Controller::JSON_STATUS_OK);

        $token = '';

        Notification::assertSentTo(
            $user,
            ResetPassword::class,
            function ($notification, $channels) use (&$token) {
                $token = $notification->token;
                return true;
            });


        $payload = [
            'password' => env('USER_TEST_PASSWORD'),
            'password_confirmation' => env('USER_TEST_PASSWORD'),
            'token' => $token
        ];

        $this->json('POST', route(RouteNames::V1_RESET_PASSWORD), $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }


    /**
     * @group auth
     * @group resetPassword
     */
    public function testRequiresPassword422()
    {
        $email = 'testlogin@user.com';
        $user = UserGenerator::generateClient(['email' => $email]);
        $payload = ['email' => $email];

        Notification::fake();

        $this->json('POST', route(RouteNames::V1_FORGOT_PASSWORD), $payload)->assertStatus(Controller::JSON_STATUS_OK);

        $token = '';

        Notification::assertSentTo(
            $user,
            ResetPassword::class,
            function ($notification, $channels) use (&$token) {
                $token = $notification->token;
                return true;
            });


        $payload = [
            'email' => $email,
            'token' => $token
        ];

        $this->json('POST', route(RouteNames::V1_RESET_PASSWORD), $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['password']);
    }

    /**
     * @group auth
     * @group resetPassword
     */
    public function testRequiresPasswordConfirm422()
    {
        $email = 'testlogin@user.com';
        $user = UserGenerator::generateClient(['email' => $email]);
        $payload = ['email' => $email];

        Notification::fake();

        $this->json('POST', route(RouteNames::V1_FORGOT_PASSWORD), $payload)->assertStatus(Controller::JSON_STATUS_OK);

        $token = '';

        Notification::assertSentTo(
            $user,
            ResetPassword::class,
            function ($notification, $channels) use (&$token) {
                $token = $notification->token;
                return true;
            });

        $payload = [
            'email' => $email,
            'password' => env('USER_TEST_PASSWORD'),
            'token' => $token
        ];

        $this->json('POST', route(RouteNames::V1_RESET_PASSWORD), $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['password_confirmation']);
    }

    /**
     * @group auth
     * @group resetPassword
     */
    public function testRequiresPasswordNotMatch422()
    {
        $email = 'testlogin@user.com';
        $user = UserGenerator::generateClient(['email' => $email]);
        $payload = ['email' => $email];

        Notification::fake();

        $this->json('POST', route(RouteNames::V1_FORGOT_PASSWORD), $payload)->assertStatus(Controller::JSON_STATUS_OK);

        $token = '';

        Notification::assertSentTo(
            $user,
            ResetPassword::class,
            function ($notification, $channels) use (&$token) {
                $token = $notification->token;
                return true;
            });

        $payload = [
            'email' => $email,
            'password' => env('USER_TEST_PASSWORD'),
            'password_confirmation' => 'test',
            'token' => $token
        ];

        $this->json('POST', route(RouteNames::V1_RESET_PASSWORD), $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['password_confirmation']);
    }

    /**
     * @group auth
     * @group resetPassword
     */
    public function testWrongEmail422()
    {
        $email = 'testlogin@user.com';
        $user = UserGenerator::generateClient(['email' => $email]);
        $payload = ['email' => $email];

        Notification::fake();

        $this->json('POST', route(RouteNames::V1_FORGOT_PASSWORD), $payload)->assertStatus(Controller::JSON_STATUS_OK);

        $token = '';

        Notification::assertSentTo(
            $user,
            ResetPassword::class,
            function ($notification, $channels) use (&$token) {
                $token = $notification->token;
                return true;
            });

        $payload = [
            'email' => 'wrongEmail',
            'password' => env('USER_TEST_PASSWORD'),
            'password_confirmation' => env('USER_TEST_PASSWORD'),
            'token' => $token
        ];

        $this->json('POST', route(RouteNames::V1_RESET_PASSWORD), $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }


    /**
     * Ошибка - пользователя с таким email не существует
     * @group auth
     * @group resetPassword
     */
    public function testWrongEmailExists422()
    {
        $email = 'testlogin@user.com';
        $user = UserGenerator::generateClient(['email' => $email]);
        $payload = ['email' => $email];

        Notification::fake();

        $this->json('POST', route(RouteNames::V1_FORGOT_PASSWORD), $payload)->assertStatus(Controller::JSON_STATUS_OK);

        $token = '';

        Notification::assertSentTo(
            $user,
            ResetPassword::class,
            function ($notification, $channels) use (&$token) {
                $token = $notification->token;
                return true;
            });

        $payload = [
            $email = 'testlogin2@user.com',
            'password' => env('USER_TEST_PASSWORD'),
            'password_confirmation' => env('USER_TEST_PASSWORD'),
            'token' => $token
        ];

        $this->json('POST', route(RouteNames::V1_RESET_PASSWORD), $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    /**
     * @group auth
     * @group resetPassword
     */
    public function testRequiresToken422()
    {
        $email = 'testlogin@user.com';
        $user = UserGenerator::generateClient(['email' => $email]);
        $payload = ['email' => $email];

        Notification::fake();

        $this->json('POST', route(RouteNames::V1_FORGOT_PASSWORD), $payload)->assertStatus(Controller::JSON_STATUS_OK);

        $token = '';

        Notification::assertSentTo(
            $user,
            ResetPassword::class,
            function ($notification, $channels) use (&$token) {
                $token = $notification->token;
                return true;
            });


        $payload = [
            'password' => env('USER_TEST_PASSWORD'),
            'password_confirmation' => env('USER_TEST_PASSWORD'),
            'email' => $email
        ];

        $this->json('POST', route(RouteNames::V1_RESET_PASSWORD), $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['token']);
    }

    /**
     * @group auth
     * @group resetPassword
     */
    public function testWrongToken422()
    {
        $email = 'testlogin@user.com';
        $user = UserGenerator::generateClient(['email' => $email]);
        $payload = ['email' => $email];

        Notification::fake();

        $this->json('POST', route(RouteNames::V1_FORGOT_PASSWORD), $payload)->assertStatus(Controller::JSON_STATUS_OK);

        $token = '';

        Notification::assertSentTo(
            $user,
            ResetPassword::class,
            function ($notification, $channels) use (&$token) {
                $token = $notification->token;
                return true;
            });


        $payload = [
            'password' => env('USER_TEST_PASSWORD'),
            'password_confirmation' => env('USER_TEST_PASSWORD'),
            'email' => $email,
            'token' => 'test_token'
        ];

        $response = $this->json('POST', route(RouteNames::V1_RESET_PASSWORD), $payload);

        $response->assertStatus(403)
            ->assertJsonFragment(['message'=>trans('passwords.token')]);
    }
}