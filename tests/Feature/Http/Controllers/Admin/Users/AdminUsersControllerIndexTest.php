<?php


namespace Tests\Feature\Http\Controllers\Admin\Users;

use App\Services\Routes\Providers\Admin\AdminRoutes;
use App\Services\Routes\Providers\Auth\AuthRoutes;
use Tests\Generators\UsersGenerator;
use Tests\TestCase;


class AdminUsersControllerIndexTest extends TestCase
{
    /**
     * @group admin
     */
    public function testIndexRedirectsNotAuthenticatedUsers()
    {
        $response = $this->get(
            route(AdminRoutes::ADMIN_USERS_INDEX)
        );
        $response->assertStatus(302)->assertRedirect(AuthRoutes::AUTH_LOGIN);
    }

    /**
     * @group admin
     */
    public function testIndexReturns200()
    {
        $user=UsersGenerator::generateAdmin();
        $response = $this->actingAs($user)->get(
            route(AdminRoutes::ADMIN_USERS_INDEX)
        );
        $response->assertStatus(200);
    }
    /**
     * @group admin
     */
    public function testIndexReturns403ForPlainUser()
    {
        $user=UsersGenerator::generatePlain();
        $response = $this->actingAs($user)->get(
            route(AdminRoutes::ADMIN_USERS_INDEX)
        );
        $response->assertStatus(403);
    }

}
