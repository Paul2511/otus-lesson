<?php


namespace Tests\Feature\Http\Controllers\Admin\Users;

use App\Services\Routes\Providers\Admin\AdminRoutes;
use App\Services\Routes\Providers\Auth\AuthRoutes;
use Tests\Generators\UsersGenerator;
use Tests\TestCase;


class AdminUsersControllerCreateTest extends TestCase
{
    /**
     * @group admin
     * @group create
     */
    public function testCreateRedirectsNotAuthenticatedUsers()
    {
        $response = $this->get(route(AdminRoutes::ADMIN_USERS_CREATE));
        $response->assertStatus(302)->assertRedirect(AuthRoutes::AUTH_LOGIN);
    }

    /**
     * @group admin
     * @group create
     */
    public function testCreateReturns200()
    {
        $user = UsersGenerator::generateAdmin();
        $response = $this->actingAs($user)
            ->get(route(AdminRoutes::ADMIN_USERS_CREATE));
        $response->assertStatus(200);
    }

    /**
     * @group admin
     * @group create
     */
    public function testCreateReturns403ForPlainUser()
    {
        $user = UsersGenerator::generatePlain();
        $response = $this->actingAs($user)
            ->get(route(AdminRoutes::ADMIN_USERS_CREATE));
        $response->assertStatus(403);
    }
}
