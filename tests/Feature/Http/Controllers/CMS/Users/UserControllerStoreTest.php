<?php


namespace Tests\Feature\Http\Controllers\CMS\Users;


use App\Models\User;
use App\Services\Routes\CMS\CMSRoutes;
use Tests\TestCase;

class UserControllerStoreTest extends TestCase
{
    /**
     * @group user
     * @group userStore
     */
    public function testRedirectTo302(): void
    {
        $response = $this->post(route(CMSRoutes::CMS_USERS_STORE, []));
        $response->assertStatus(302)->assertRedirect(route('login'));
    }

    /**
     * @group user
     * @group userStore
     */
    public function testReturn403(): void
    {
        $user = User::factory()->create(['type' => User::TYPE_MANAGER]);
        $response = $this->actingAs($user)->post(route(CMSRoutes::CMS_USERS_STORE, []));
        $response->assertStatus(302)->assertRedirect('/');
    }


    /**
     * @group user
     * @group userStore
     */
    public function testUserReturn403(): void
    {
        $user = User::factory()->create(['type' => User::TYPE_USER]);
        $response = $this->actingAs($user)->post(route(CMSRoutes::CMS_USERS_STORE, []));
        $response->assertStatus(302)->assertRedirect('/');
    }

    /**
     * @group user
     * @group userStore
     */
    public function testReturn422IfEmailEmpty(): void
    {
        $user = User::factory()->create(['type' => User::TYPE_ADMIN]);
        $data = [
            'first_name' => 'Jon',
            'last_name' => 'Summit'
        ];
        $response = $this->actingAs($user)->post(route(CMSRoutes::CMS_USERS_STORE, $data));
        $response->assertStatus(302);
    }
    /**
     * @group user
     * @group userStore2
     */
    public function testReturn200(): void
    {
        $user = User::factory()->create(['type' => User::TYPE_ADMIN]);
        $data = [
            'first_name' => 'Jon',
            'last_name' => 'Summit',
            'email' => 'test@test.com'
        ];
        $response = $this->actingAs($user)->post(route(CMSRoutes::CMS_USERS_STORE, $data));
        $response->assertStatus(302)->assertRedirect(route(CMSRoutes::CMS_USERS_INDEX));
    }
}
