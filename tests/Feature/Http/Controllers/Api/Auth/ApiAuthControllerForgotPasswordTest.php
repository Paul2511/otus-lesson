<?php


namespace Tests\Feature\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\RouteNames;
use Tests\Generators\UserGenerator;
use Tests\TestCase;
use Tests\AuthAttach;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\ResetPassword;
class ApiAuthControllerForgotPasswordTest extends TestCase
{
    use AuthAttach;

    /**
     * @group auth
     * @group forgotPassword
     */
    public function testRequiresEmail422()
    {
        $this->json('POST', route(RouteNames::V1_FORGOT_PASSWORD))
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    /**
     * @group auth
     * @group forgotPassword
     */
    public function testWrongEmail422()
    {
        $payload = [
            'email' => 'wrongEmail',
        ];

        $this->json('POST', route(RouteNames::V1_FORGOT_PASSWORD), $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }


    /**
     * Ошибка - пользователя с таким email не существует
     * @group auth
     * @group forgotPassword
     */
    public function testWrongEmailNotExists422()
    {
        UserGenerator::generateClient([
            'email' => 'testlogin@user.com'
        ]);

        $payload = ['email' => 'testlogin2@user.com'];

        $this->json('POST', route(RouteNames::V1_FORGOT_PASSWORD), $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    /**
     * Удачная высылка письма с инструкциями
     * @group auth
     * @group forgotPassword
     */
    public function testSuccessfully200()
    {
        $user = UserGenerator::generateClient([
            'email' => 'testlogin@user.com'
        ]);

        $payload = [
            'email' => 'testlogin@user.com',
        ];

        Notification::fake();

        $response= $this->json('POST', route(RouteNames::V1_FORGOT_PASSWORD), $payload);

        $response->assertStatus(Controller::JSON_STATUS_OK);

        Notification::assertSentTo($user, ResetPassword::class);
    }
}