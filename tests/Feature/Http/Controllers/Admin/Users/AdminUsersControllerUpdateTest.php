<?php


namespace Tests\Feature\Http\Controllers\Admin\Users;


use App\Services\Routes\Providers\Admin\AdminRoutes;
use App\Services\Routes\Providers\User\UserRoutes;
use App\Services\Users\Repositories\EloquentUserRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Tests\Feature\Generators\UsersGenerator;
use Tests\TestCase;

class AdminUsersControllerUpdateTest extends TestCase
{

    public function testUpdateGetRequestNotAuthenticatedUsers()
    {
        $response = $this->get(route(AdminRoutes::ADMIN_USERS_UPDATE, [app()->getLocale(), 1]));
        $response->assertStatus(302)
            ->assertRedirect(route('login', app()->getLocale()));
    }
    /**
     * @group http
     * @group users
     * @group update
     */

    // Users
    /**
     * @group http
     * @group users
     * @group update
     */

    public function testUpdatePostRequestAsInactiveUser()
    {
        $user = UsersGenerator::generateInactiveUser();
        $userUpdateData = UsersGenerator::generateUpdateUserData();

        $response = $this->actingAs($user)->patch(route(
            AdminRoutes::ADMIN_USERS_UPDATE, [app()->getLocale(), $userUpdateData['id']]), Arr::except($userUpdateData, 'id'));

        $response->assertStatus(302)
            ->assertRedirect(route(UserRoutes::USER_DASHBOARD, app()->getLocale()));
    }

    /**
     * @group http
     * @group users
     * @group update
     */

    public function testUpdatePostRequestAsActiveUser()
    {
        $user = UsersGenerator::generateActiveUser();
        $userUpdateData = UsersGenerator::generateUpdateUserData();

        $response = $this->actingAs($user)->patch(route(
            AdminRoutes::ADMIN_USERS_UPDATE, [app()->getLocale(), $userUpdateData['id']]), Arr::except($userUpdateData, 'id'));

        $response->assertStatus(302)
            ->assertRedirect(route(UserRoutes::USER_DASHBOARD, app()->getLocale()));
    }

    /**
     * @group http
     * @group users
     * @group update
     */

    public function testUpdatePostRequestAsInactiveManager()
    {
        $user = UsersGenerator::generateInactiveManager();
        $userUpdateData = UsersGenerator::generateUpdateUserData();

        $response = $this->actingAs($user)->patch(route(
            AdminRoutes::ADMIN_USERS_UPDATE, [app()->getLocale(), $userUpdateData['id']]), Arr::except($userUpdateData, 'id'));

        $response->assertStatus(403);
    }
//    Managers

    /**
     * @group http
     * @group users
     * @group update
     */

    public function testUpdatePostRequestAsActiveManager()
    {
        $user = UsersGenerator::generateInactiveManager();
        $userUpdateData = UsersGenerator::generateUpdateUserData();

        $response = $this->actingAs($user)->patch(route(
            AdminRoutes::ADMIN_USERS_UPDATE, [app()->getLocale(), $userUpdateData['id']]), Arr::except($userUpdateData, 'id'));

        $response->assertStatus(403);
    }

    /**s
     * @group http
     * @group users
     * @group update
     */

    public function testUpdatePostRequestAsInactiveAdmin()
    {
        $user = UsersGenerator::generateInactiveAdmin();
        $userUpdateData = UsersGenerator::generateUpdateUserData();

        $response = $this->actingAs($user)->patch(route(
            AdminRoutes::ADMIN_USERS_UPDATE, [app()->getLocale(), $userUpdateData['id']]), Arr::except($userUpdateData, 'id'));

        $response->assertStatus(403);
    }
//    Admins

    /**
     * @group http
     * @group users
     * @group update
     */

    public function testUpdatePostRequestEmptyAsActiveAdmin()
    {
        $user = UsersGenerator::generateActiveAdmin();
        $userUpdateData = UsersGenerator::generateUpdateUserData();
        $emptyUserUpdateData = [];

        $response = $this->actingAs($user)->patch(route(
            AdminRoutes::ADMIN_USERS_UPDATE, [app()->getLocale(), $userUpdateData['id']]), $emptyUserUpdateData);

        $response->assertStatus(302);
    }

    /**
     * @group http
     * @group users
     * @group update
     */

    public function testUpdatePostRequest422AsActiveAdmin()
    {
        $user = UsersGenerator::generateActiveAdmin();
        $userUpdateData = UsersGenerator::generateUpdateUserData();
        $invalidUserStoreData = Arr::set($userUpdateData, 'phone', '');

        $response = $this
            ->actingAs($user)
            ->patchJson(route(AdminRoutes::ADMIN_USERS_UPDATE, [app()->getLocale(), $userUpdateData['id']]),
                $invalidUserStoreData,
                ['HTTP_X-Requested-With' => 'XMLHttpRequest']);

        $response->assertStatus(422);
    }

    /**
     * @group http
     * @group users
     * @group update
     */

    public function testUpdatePostRequestCorrectlyAsActiveAdmin()
    {

        $user = UsersGenerator::generateActiveAdmin();
        $userUpdateData = UsersGenerator::generateUpdateUserData();
        $userNewData = $userUpdateData;
        $userNewData = Arr::set($userNewData, 'email', Str::random(10) . '@gmail.com');

        $response = $this
            ->actingAs($user)
            ->patch(route(AdminRoutes::ADMIN_USERS_UPDATE, [app()->getLocale(), $userUpdateData['id']]),
                Arr::except($userNewData, ['id']));

        $response->assertStatus(200);
        $updatedUser = $this->getEloquentUserRepository()->findUserByEmail($userNewData['email']);

        $this->assertNotNull($updatedUser);
        $this->assertNotEquals($userUpdateData['email'], $updatedUser['email']);
    }

    private function getEloquentUserRepository(): EloquentUserRepository
    {
        return app(EloquentUserRepository::class);
    }
}