<?php


namespace Tests\Feature\Http\Controllers\Api\Auth;


use App\Http\Controllers\Controller;
use App\Http\RouteNames;
use App\States\User\Role\AdminUserRole;
use Illuminate\Support\Facades\Hash;
use Tests\AuthAttach;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class ApiAuthControllerChangePasswordTest extends TestCase
{
    use AuthAttach;

    /**
     * Клиент меняет свой пароль
     * @group auth
     * @group changePassword
     */
    public function testClientSuccessfully200()
    {
        $user = $this->currentUser();

        $newPassword = '54321';

        $payload = [
            'oldPassword' => env('USER_TEST_PASSWORD'),
            'newPassword' => $newPassword,
            'newPassword_confirmation' => $newPassword
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_CHANGE_PASSWORD), $payload);

        $response->assertStatus(Controller::JSON_STATUS_OK);

        $user->refresh();

        $this->assertTrue(Hash::check($newPassword, $user->password));
    }

    /**
     * Админ меняет чужой пароль
     * @group auth
     * @group changePassword
     */
    public function testAdminSuccessfully200()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $anotherUser = UserGenerator::generateClient();

        $newPassword = '54321';

        $payload = [
            'oldPassword' => env('USER_TEST_PASSWORD'),
            'newPassword' => $newPassword,
            'newPassword_confirmation' => $newPassword,
            'userId' => $anotherUser->id
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_CHANGE_PASSWORD), $payload);

        $response->assertStatus(Controller::JSON_STATUS_OK);

        $anotherUser->refresh();

        $this->assertTrue(Hash::check($newPassword, $anotherUser->password));
    }

    /**
     * Пользователь не найден
     * @group auth
     * @group changePassword
     */
    public function testUserNotFound404()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $anotherUser = UserGenerator::generateClient();

        $newPassword = '54321';

        $payload = [
            'oldPassword' => env('USER_TEST_PASSWORD'),
            'newPassword' => $newPassword,
            'newPassword_confirmation' => $newPassword,
            'userId' => 1000
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_CHANGE_PASSWORD), $payload);

        $response->assertStatus(404)
            ->assertJsonFragment(['message'=>trans('user.notFound')]);
    }

    /**
     * Клиент не может менять чужой пароль
     * @group auth
     * @group changePassword
     */
    public function testClientDenied403()
    {
        $user = $this->currentUser();

        $anotherUser = UserGenerator::generateClient();

        $newPassword = '54321';

        $payload = [
            'oldPassword' => env('USER_TEST_PASSWORD'),
            'newPassword' => $newPassword,
            'newPassword_confirmation' => $newPassword,
            'userId' => $anotherUser->id
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_CHANGE_PASSWORD), $payload);

        $response->assertStatus(403)
            ->assertJsonFragment(['message'=>trans('auth.accessDenied')]);

        $anotherUser->refresh();

        $this->assertFalse(Hash::check($newPassword, $user->password));
    }

    /**
     * Старый пароль неверный
     * @group auth
     * @group changePassword
     */
    public function testClientWrongOldPassword422()
    {
        $user = $this->currentUser();

        $newPassword = '54321';

        $payload = [
            'oldPassword' => 'test_password',
            'newPassword' => $newPassword,
            'newPassword_confirmation' => $newPassword
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_CHANGE_PASSWORD), $payload);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['oldPassword']);

        $user->refresh();

        $this->assertFalse(Hash::check($newPassword, $user->password));
    }

    /**
     * Пустые поля
     * @group auth
     * @group changePassword2
     */
    public function testClientWithoutFields422()
    {
        $user = $this->currentUser();

        $payload = [
            'oldPassword' => '',
            'newPassword' => '',
            'newPassword_confirmation' => ''
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_CHANGE_PASSWORD), $payload);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['oldPassword', 'newPassword', 'newPassword_confirmation']);
    }

    /**
     * Новый пароль неправильно повторен
     * @group auth
     * @group changePassword
     */
    public function testClientWrongNewPassword422()
    {
        $user = $this->currentUser();

        $newPassword = '54321';

        $payload = [
            'oldPassword' => env('USER_TEST_PASSWORD'),
            'newPassword' => $newPassword,
            'newPassword_confirmation' => 'test_password'
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_CHANGE_PASSWORD), $payload);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['newPassword']);

        $user->refresh();

        $this->assertFalse(Hash::check($newPassword, $user->password));
    }
}