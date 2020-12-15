<?php


namespace Tests\Feature\Http\Controllers\Admin\Users;

use App\Services\Routes\Providers\Admin\AdminRoutes;
use App\Services\Routes\Providers\User\UserRoutes;
use App\Services\Users\Repositories\EloquentUserRepository;
use Illuminate\Support\Arr;
use Tests\Feature\Generators\UsersGenerator;
use Tests\TestCase;


class AdminUsersControllerStoreTest extends TestCase
{

    public function testStoreGetRequestNotAuthenticatedUsers()
    {
        $response = $this->get(route(AdminRoutes::ADMIN_USERS_STORE, app()->getLocale()));

        $response->assertStatus(302)
            ->assertRedirect(route('login', app()->getLocale()));
    }
    /**
     * @group http
     * @group users
     * @group store
     */

    // Users
    /**
     * @group http
     * @group users
     * @group store
     */

    public function testStoreGetRequestAsActiveUser()
    {
        $user = UsersGenerator::generateActiveUser();
        $response = $this->actingAs($user)->get(route(AdminRoutes::ADMIN_USERS_STORE, app()->getLocale()));

        $response->assertStatus(302)
            ->assertRedirect(route(UserRoutes::USER_DASHBOARD, app()->getLocale()));
    }

    /**
     * @group http
     * @group users
     * @group store
     */

    public function testStoreGetRequestAsInactiveUser()
    {
        $user = UsersGenerator::generateInactiveUser();
        $response = $this->actingAs($user)->get(route(AdminRoutes::ADMIN_USERS_STORE, app()->getLocale()));

        $response->assertStatus(302)
            ->assertRedirect(route(UserRoutes::USER_DASHBOARD, app()->getLocale()));
    }

    /**
     * @group http
     * @group users
     * @group store
     */

    public function testStorePostRequestAsInactiveUser()
    {
        $user = UsersGenerator::generateInactiveUser();
        $userStoreData = UsersGenerator::generateUserData();
        $response = $this
            ->actingAs($user)
            ->post(route(AdminRoutes::ADMIN_USERS_STORE, app()->getLocale()), $userStoreData);

        $response->assertStatus(302)
            ->assertRedirect(route(UserRoutes::USER_DASHBOARD, app()->getLocale()));
    }

    /**
     * @group http
     * @group users
     * @group store
     */

    public function testStorePostRequestAsActiveUser()
    {
        $user = UsersGenerator::generateActiveUser();
        $userStoreData = UsersGenerator::generateUserData();
        $response = $this
            ->actingAs($user)
            ->post(route(AdminRoutes::ADMIN_USERS_STORE, app()->getLocale()), $userStoreData);

        $response->assertStatus(302)
            ->assertRedirect(route(UserRoutes::USER_DASHBOARD, app()->getLocale()));
    }

    /**
     * @group http
     * @group users
     * @group store
     */

    public function testStorePostRequestAsInactiveManager()
    {
        $user = UsersGenerator::generateInactiveManager();
        $userStoreData = UsersGenerator::generateUserData();
        $response = $this
            ->actingAs($user)
            ->post(route(AdminRoutes::ADMIN_USERS_STORE, app()->getLocale()), $userStoreData);

        $response->assertStatus(403);
    }
//    Managers

    /**
     * @group http
     * @group users
     * @group store
     */

    public function testStorePostRequestAsActiveManager()
    {
        $user = UsersGenerator::generateActiveManager();
        $userStoreData = UsersGenerator::generateUserData();
        $response = $this
            ->actingAs($user)
            ->post(route(AdminRoutes::ADMIN_USERS_STORE, app()->getLocale()), $userStoreData);

        $response->assertStatus(403);
    }

    /**s
     * @group http
     * @group users
     * @group store
     */

    public function testStorePostRequestAsInactiveAdmin()
    {
        $user = UsersGenerator::generateInactiveAdmin();
        $userStoreData = UsersGenerator::generateUserData();
        $response = $this
            ->actingAs($user)
            ->post(route(AdminRoutes::ADMIN_USERS_STORE, app()->getLocale()), $userStoreData);

        $response->assertStatus(403);
    }
//    Admins

    /**
     * @group http
     * @group users
     * @group store
     */

    public function testStorePostRequestEmptyAsActiveAdmin()
    {
        $user = UsersGenerator::generateActiveAdmin();
        $userStoreData = [];
        $response = $this
            ->actingAs($user)
            ->post(route(AdminRoutes::ADMIN_USERS_STORE, app()->getLocale()), $userStoreData);

        $response->assertStatus(302);
    }

    /**
     * @group http
     * @group users
     * @group store
     */

    public function testStorePostRequest422AsActiveAdmin()
    {
        $user = UsersGenerator::generateActiveAdmin();
        $userStoreData = UsersGenerator::generateUserData();
        $invalidUserStoreData = Arr::set($userStoreData, 'phone', ' ');

        $response = $this
            ->actingAs($user)
            ->postJson(route(AdminRoutes::ADMIN_USERS_STORE, app()->getLocale()),
                $invalidUserStoreData,
                ['HTTP_X-Requested-With' => 'XMLHttpRequest']);

        $response->assertStatus(422);
    }

    /**
     * @group http
     * @group users
     * @group store
     */

    public function testStorePostRequestCorrectlyAsActiveAdmin()
    {
        $user = UsersGenerator::generateActiveAdmin();
        $userStoreData = UsersGenerator::generateUserData();
        $response = $this
            ->actingAs($user)
            ->post(route(AdminRoutes::ADMIN_USERS_STORE, app()->getLocale()), $userStoreData);

        $response->assertStatus(200);
        $createdUser = $this->getEloquentUserRepository()->findUserByEmail($userStoreData['email']);

        $this->assertNotNull($createdUser);
        $this->assertEquals($userStoreData['email'], $createdUser['email']);
    }

    private function getEloquentUserRepository(): EloquentUserRepository
    {
        return app(EloquentUserRepository::class);
    }
}