<?php


namespace Tests\Feature\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\RouteNames;
use App\Notifications\User\UserWelcome;
use App\States\User\Role\AdminUserRole;
use App\States\User\Role\ClientUserRole;
use Tests\Generators\CommentGenerator;
use Tests\Generators\UserGenerator;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Notification;
class ApiUserControllerStoreTest extends TestCase
{
    /**
     * Клиент не имеет право
     * @group user
     * @group userStore
     */
    public function testClientDenied403()
    {
        $user = $this->currentUser();

        $payload = [
            'role' => ClientUserRole::$name,
            'email' => 'testlogin@user.com',
            'password' => env('USER_TEST_PASSWORD'),
            'password_confirmation' => env('USER_TEST_PASSWORD')
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_CREATE_USER), $payload);

        $response->assertStatus(403)
            ->assertJsonFragment(['message'=>trans('auth.accessDenied')]);
    }

    /**
     * Только админ имеет право
     * @group user
     * @group userStore
     */
    public function testAdminStoreClientSuccess200()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $payload = [
            'role' => ClientUserRole::$name,
            'email' => 'testuser@user.com',
            'password' => env('USER_TEST_PASSWORD'),
            'password_confirmation' => env('USER_TEST_PASSWORD')
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_CREATE_USER), $payload);

        $response->assertStatus(Controller::JSON_STATUS_CREATED);

        $this->assertDatabaseHas('users', [
            'email' => 'testuser@user.com',
            'role' => ClientUserRole::$name
        ]);
        /** @var User $user */
        $user = User::where(['email'=>'testuser@user.com'])->first();

        $this->assertDatabaseHas('clients', [
            'user_id' => $user->id
        ]);
    }


    /**
     * Админ может создать любую роль
     * @group user
     * @group userStore
     */
    public function testAdminStoreAdminSuccess200()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $payload = [
            'role' => AdminUserRole::$name,
            'email' => 'testuser@user.com',
            'password' => env('USER_TEST_PASSWORD'),
            'password_confirmation' => env('USER_TEST_PASSWORD')
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_CREATE_USER), $payload);

        $response->assertStatus(Controller::JSON_STATUS_CREATED);

        $this->assertDatabaseHas('users', [
            'email' => 'testuser@user.com',
            'role' => AdminUserRole::$name
        ]);
        /** @var User $user */
        $user = User::where(['email'=>'testuser@user.com'])->first();

        $this->assertDatabaseHas('admins', [
            'user_id' => $user->id
        ]);
    }

    /**
     * Если не указана роль создается клиент
     * @group user
     * @group userStore
     */
    public function testAdminStoreWithoutRoleSuccess200()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $payload = [
            'email' => 'testuser@user.com',
            'password' => env('USER_TEST_PASSWORD'),
            'password_confirmation' => env('USER_TEST_PASSWORD')
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_CREATE_USER), $payload);

        $response->assertStatus(Controller::JSON_STATUS_CREATED);

        $this->assertDatabaseHas('users', [
            'email' => 'testuser@user.com',
            'role' => ClientUserRole::$name
        ]);
        /** @var User $user */
        $user = User::where(['email'=>'testuser@user.com'])->first();

        $this->assertDatabaseHas('clients', [
            'user_id' => $user->id
        ]);
    }

    /**
     * Отправка письма при регистрации
     * @group user
     * @group userStore
     * @group mail
     */
    public function testSendWelcomeEmail201()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $payload = [
            'role' => ClientUserRole::$name,
            'email' => 'testuser@user.com',
            'password' => env('USER_TEST_PASSWORD'),
            'password_confirmation' => env('USER_TEST_PASSWORD'),
            'sendWelcomeEmail' => true
        ];

        Notification::fake();

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_CREATE_USER), $payload);

        $response->assertStatus(Controller::JSON_STATUS_CREATED);


        /** @var User $user */
        $user = User::where(['email'=>'testuser@user.com'])->first();
        Notification::assertSentTo($user, UserWelcome::class);
    }


    /**
     * @group user
     * @group userStore
     */
    public function testRequiresEmailAndPassword422()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $payload = [];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_CREATE_USER), $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email', 'password', 'password_confirmation']);
    }

    /**
     * @group user
     * @group userStore
     */
    public function testRequiresEmail422()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $payload = [
            'password' => env('USER_TEST_PASSWORD'),
            'password_confirmation' => env('USER_TEST_PASSWORD')
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_CREATE_USER), $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    /**
     * @group user
     * @group userStore
     */
    public function testRequiresPassword422()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $payload = ['email' => 'testuser@user.com'];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_CREATE_USER), $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['password']);
    }

    /**
     * @group user
     * @group userStore
     */
    public function testRequiresPasswordConfirm422()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $payload = [
            'email' => 'testuser@user.com',
            'password' => env('USER_TEST_PASSWORD')
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_CREATE_USER), $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['password_confirmation']);
    }

    /**
     * @group user
     * @group userStore
     */
    public function testRequiresPasswordNotMatch422()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $payload = [
            'email' => 'testuser@user.com',
            'password' => env('USER_TEST_PASSWORD'),
            'password_confirmation' => 'test',
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_CREATE_USER), $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['password_confirmation']);
    }

    /**
     * @group user
     * @group userStore
     */
    public function testWrongEmail422()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $payload = [
            'email' => 'wrongEmail',
            'password' => env('USER_TEST_PASSWORD'),
            'password_confirmation' => env('USER_TEST_PASSWORD'),
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_CREATE_USER), $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }


    /**
     * Ошибка - пользователь с таким email уже существует
     * @group user
     * @group userStore
     */
    public function testWrongEmailExists422()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $payload = ['email' => 'testlogin@user.com', 'password' => env('USER_TEST_PASSWORD')];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_CREATE_USER), $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    /**
     * @group user
     * @group userStore
     */
    public function testWrongLocale422()
    {
        $admin = $this->createUser(AdminUserRole::class);

        $payload = [
            'email' => 'testuser@user.com',
            'password' => env('USER_TEST_PASSWORD'),
            'password_confirmation' => env('USER_TEST_PASSWORD'),
            'locale' => 'fr'
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_CREATE_USER), $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['locale']);
    }

}