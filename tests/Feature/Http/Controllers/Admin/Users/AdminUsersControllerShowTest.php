<?php


namespace Tests\Feature\Http\Controllers\Admin\Users;

use App\Services\Routes\Providers\Admin\AdminRoutes;
use App\Services\Routes\Providers\Auth\AuthRoutes;
use Tests\Generators\UsersGenerator;
use Tests\TestCase;


class AdminUsersControllerShowTest extends TestCase
{
    /**
     * @group admin
     * @group show
     */
    public function testShowRedirectsNotAuthenticatedUsers()
    {
        $user=UsersGenerator::generateAdmin();
        $response = $this->get(
            route(AdminRoutes::ADMIN_USERS_SHOW, ['user'=>$user->id])
        );
        $response->assertStatus(302)->assertRedirect(AuthRoutes::AUTH_LOGIN);
    }

    /**
     * @group admin
     * @group show
     */
    public function testShowReturns200ForPlainUser()
    {
        $user=UsersGenerator::generatePlain();
        $response = $this->actingAs($user)->get(
            route(AdminRoutes::ADMIN_USERS_SHOW, ['user'=>$user->id])
        );
        $response->assertStatus(200);
    }
    /**
     * @group admin
     * @group show
     */
    public function testShowReturns403ForPlainUser()
    {
        $user=UsersGenerator::generatePlain();
        $userForShow=UsersGenerator::generatePlain();
        $response = $this->actingAs($user)->get(
            route(AdminRoutes::ADMIN_USERS_SHOW,['user'=>$userForShow->id])
        );
        $response->assertStatus(403);
    }
    /**
     * @group admin
     * @group show
     */
    public function testShowReturns200ForAdminUser()
    {
        $user=UsersGenerator::generateAdmin();
        $userForShow=UsersGenerator::generatePlain();
        $response = $this->actingAs($user)->get(
            route(AdminRoutes::ADMIN_USERS_SHOW,['user'=>$userForShow->id])
        );
        $response->assertStatus(200);
    }

    /**
     * @group admin
     * @group show
     */
    public function testShowUserNotFound404()
    {
        $user=UsersGenerator::generateAdmin();
        $response = $this->actingAs($user)->get(
            route(AdminRoutes::ADMIN_USERS_SHOW,['user'=>2])
        );
        $response->assertStatus(404);
    }

}
