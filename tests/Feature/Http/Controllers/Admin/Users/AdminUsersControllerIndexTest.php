<?php

namespace Tests\Feature\Http\Controllers\Admin\Users;

use App\Models\Ability;
use App\Models\Role;
use App\Models\User;
use App\Services\Routes\Providers\Admin\AdminRoutes;
use App\Services\Routes\Providers\User\UserRoutes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Generators\UsersGenerator;
use Tests\TestCase;

class AdminUsersControllerIndexTest extends TestCase
{
    /**
     * @group http
     * @group users
     * @group index
     */

    // Users
    public function testIndexNotAuthenticatedUsers()
    {
        $response = $this->get(route(AdminRoutes::ADMIN_USERS_INDEX, app()->getLocale()));

        $response->assertStatus(302)
            ->assertRedirect(route('login', app()->getLocale()));
    }

    /**
     * @group http
     * @group users
     * @group index
     */
    public function testIndexAsActiveUser()
    {
        $user = UsersGenerator::generateActiveUser();
        $response = $this->actingAs($user)->get(route(AdminRoutes::ADMIN_USERS_INDEX, app()->getLocale()));

        $response->assertStatus(302)
            ->assertRedirect(route(UserRoutes::USER_DASHBOARD, app()->getLocale()));
    }

    /**
     * @group http
     * @group users
     * @group index
     */
    public function testIndexAsActiveUserCantView()
    {
        $user = UsersGenerator::generateActiveUser();
        $this->be($user);

        $this->assertFalse($user->can('view', User::class));
    }

    /**
     * @group http
     * @group users
     * @group index
     */
    public function testIndexAsInactiveUser()
    {
        $user = UsersGenerator::generateInactiveUser();
        $response = $this->actingAs($user)
            ->get(route(AdminRoutes::ADMIN_USERS_INDEX, app()->getLocale()));

        $response->assertStatus(302)
            ->assertRedirect(route(UserRoutes::USER_DASHBOARD, app()->getLocale()));;
    }
    /**
     * @group http
     * @group users
     * @group index
     */
    // Managers
    public function testIndexAsInactiveManager()
    {
        $user = UsersGenerator::generateInactiveManager();
        $response = $this->actingAs($user)
            ->get(route(AdminRoutes::ADMIN_USERS_INDEX, app()->getLocale()));

        $response->assertStatus(403);
    }

    /**
     * @group http
     * @group users
     * @group index
     */
    public function testIndexAsActiveManager()
    {
        $user = UsersGenerator::generateActiveManager();
        $response = $this->actingAs($user)
            ->get(route(AdminRoutes::ADMIN_USERS_INDEX, app()->getLocale()));

        $response->assertStatus(200);
    }

    /**
     * @group http
     * @group users
     * @group index
     */
    public function testIndexAsActiveManagerCanView()
    {
        $user = UsersGenerator::generateActiveManager();
        $this->be($user);

        $this->assertTrue($user->can('view', User::class));
    }

    /**
     * @group http
     * @group users
     * @group index
     */
    public function testIndexAsActiveManagerCanViewAny()
    {
        $user = UsersGenerator::generateActiveManager();
        $this->be($user);

        $this->assertTrue($user->can('viewAny', User::class));
    }
    /**
     * @group http
     * @group users
     * @group index
     */
    // Admins
    public function testIndexAsActiveAdmin()
    {
        $user = UsersGenerator::generateActiveAdmin();
        $response = $this->actingAs($user)
            ->get(route(AdminRoutes::ADMIN_USERS_INDEX, app()->getLocale()));

        $response->assertStatus(200);
    }

    /**
     * @group http
     * @group users
     * @group index
     */
    public function testIndexAsInactiveAdmin()
    {
        $user = UsersGenerator::generateInactiveAdmin();
        $response = $this->actingAs($user)
            ->get(route(AdminRoutes::ADMIN_USERS_INDEX, app()->getLocale()));

        $response->assertStatus(403);
    }

    /**
     * @group http
     * @group users
     * @group index
     */
    public function testIndexAsInactiveAdminCantView()
    {
        $user = UsersGenerator::generateInactiveAdmin();
        $this->be($user);

        $this->assertFalse($user->can('view', User::class));
    }

    /**
     * @group http
     * @group users
     * @group index
     */
    public function testIndexAsInactiveAdminCantViewAny()
    {
        $user = UsersGenerator::generateInactiveAdmin();
        $this->be($user);

        $this->assertFalse($user->can('viewAny', User::class));
    }

    /**
     * @group http
     * @group users
     * @group index
     */
    public function testIndexAsActiveAdminCanView()
    {
        $user = UsersGenerator::generateActiveAdmin();
        $this->be($user);

        $this->assertTrue($user->can('view', User::class));
    }

    /**
     * @group http
     * @group users
     * @group index
     */
    public function testIndexAsActiveAdminCanViewAny()
    {
        $user = UsersGenerator::generateActiveAdmin();
        $this->be($user);

        $this->assertTrue($user->can('viewAny', User::class));
    }

}
