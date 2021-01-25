<?php


namespace Tests\Feature\Http\Controllers\CMS\Users;


use App\Models\User;
use App\Services\Routes\CMS\CMSRoutes;
use Tests\TestCase;

class UserControllerIndexTest extends TestCase
{
    /**
     * @group user
     */
    public function testRedirectTo302(): void
    {
        $response = $this->get(route(CMSRoutes::CMS_USERS_INDEX));
        $response->assertStatus(302)->assertRedirect(route('login'));
    }

    /**
     * @group user
     */
    public function testReturn403(): void
    {
        $user = User::factory()->create(['type'=>User::TYPE_MANAGER]);
        $response = $this->actingAs($user)->get(route(CMSRoutes::CMS_USERS_INDEX));
        $response->assertStatus(403);
    }


    /**
     * @group user
     */
    public function testUserReturn403(): void
    {
        $user = User::factory()->create(['type'=>User::TYPE_USER]);
        $response = $this->actingAs($user)->get(route(CMSRoutes::CMS_USERS_INDEX));
        $response->assertStatus(403);
    }
    /**
     * @group user
     */
    public function testReturn200(): void
    {
        $user = User::factory()->create(['type' => User::TYPE_ADMIN]);
        $response = $this->actingAs($user)->get(route(CMSRoutes::CMS_USERS_INDEX));
        $response->assertStatus(200);

    }


}
