<?php


namespace Tests\Feature\Http\Controllers\Admin\Users;

use Faker\Generator as Faker;
use App\Services\Routes\Providers\Admin\AdminRoutes;
use App\Services\Routes\Providers\User\UserRoutes;
use App\Services\Users\Repositories\EloquentUserRepository;
use Illuminate\Support\Arr;
use Tests\Feature\Generators\UsersGenerator;
use Tests\TestCase;

class AdminUsersControllerDeleteTest extends TestCase
{

    private function getEloquentUserRepository(): EloquentUserRepository
    {
        return app(EloquentUserRepository::class);
    }

    /**
     * @group http
     * @group users
     * @group delete
     */

    // Users
    public function testDeleteGetRequestNotAuthenticatedUsers()
    {
        $response = $this->get(route(AdminRoutes::ADMIN_USERS_DELETE, 1));

        $response->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @group http
     * @group users
     * @group delete
     */

    public function testDeleteRequestAsActiveUser()
    {
        $user = UsersGenerator::generateActiveUser();
        $response = $this->actingAs($user)->delete(
            route(AdminRoutes::ADMIN_USERS_DELETE,
            $this->setRandomUser()));

        $response->assertStatus(302)
            ->assertRedirect(route(UserRoutes::USER_DASHBOARD));
    }


    public function testDeleteRequestAsInactiveUser()
    {
        $user = UsersGenerator::generateInactiveUser();
        $response = $this
            ->actingAs($user)
            ->delete(route(AdminRoutes::ADMIN_USERS_DELETE,
                $this->setRandomUser()));

        $response->assertStatus(302)
            ->assertRedirect(route(UserRoutes::USER_DASHBOARD));
    }


//    Managers
    /**
     * @group http
     * @group users
     * @group delete
     */

    public function testDeleteRequestAsInactiveManager()
    {
        $user = UsersGenerator::generateInactiveManager();
        $response = $this
            ->actingAs($user)
            ->delete(route(AdminRoutes::ADMIN_USERS_DELETE,
                $this->setRandomUser()));

        $response->assertStatus(403);
    }

    /**
     * @group http
     * @group users
     * @group delete
     */

    public function testDeleteRequestAsActiveManager()
    {
        $user = UsersGenerator::generateActiveManager();
        $response = $this
            ->actingAs($user)
            ->delete(route(AdminRoutes::ADMIN_USERS_DELETE,
                $this->setRandomUser()));

        $response->assertStatus(200);
    }
//    Admins
    /**s
     * @group http
     * @group users
     * @group delete
     */

    public function testDeleteRequestAsInactiveAdmin()
    {
        $user = UsersGenerator::generateInactiveAdmin();
        $response = $this
            ->actingAs($user)
            ->delete(route(AdminRoutes::ADMIN_USERS_DELETE,
                $this->setRandomUser()));

        $response->assertStatus(403);
    }

    /**
     * @group http
     * @group users
     * @group delete
     */

    public function testDeleteRequestInvalidAsActiveAdmin()
    {
        $user = UsersGenerator::generateActiveAdmin();
        $response = $this
            ->actingAs($user)
            ->delete(route(AdminRoutes::ADMIN_USERS_DELETE, 0));

        $response->assertStatus(404);
    }


    /**
     * @group http
     * @group users
     * @group delete
     */

    public function testDeleteRequestCorrectlyAsActiveAdmin()
    {
        $user = UsersGenerator::generateActiveAdmin();
        $response = $this
            ->actingAs($user)
            ->delete(route(AdminRoutes::ADMIN_USERS_DELETE,
                $this->setRandomUser()));

        $response->assertStatus(200);

    }

    public function setRandomUser(): int
    {
        $userIds = $this->getEloquentUserRepository()->getUserIds();

        return Arr::random($userIds);
    }

}