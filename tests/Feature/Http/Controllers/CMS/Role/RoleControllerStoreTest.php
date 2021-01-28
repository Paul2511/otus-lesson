<?php


namespace Http\Controllers\CMS\Role;


use App\Services\Roles\Repository\EloquentRoleRepository;
use Illuminate\Http\Response;
use Tests\Generators\RoleGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class RoleControllerStoreTest extends TestCase
{
    private function getEloquentRoleRepository(): EloquentRoleRepository
    {
        return app(EloquentRoleRepository::class);
    }

    /**
     * @group http
     * @group role
     */
    public function testStoreRedirectNotAuthUsers()
    {
        $role = RoleGenerator::generateRole('testRole');
        $response = $this->post(route('role.store'), $role->toArray());
        $response->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('login');
    }

    /**
     * @group http
     * @group role
     */
    public function testStoreReturn200()
    {
        $role = RoleGenerator::generateRole('testRole');
        $admin = UserGenerator::generateAdmin();
        $response = $this->actingAs($admin)->post(route('role.store'), $role->toArray());
        $response->assertStatus(Response::HTTP_CREATED);

        $createdRole = $this->getEloquentRoleRepository()->findOrFail($response->json()['id']);
        $this->assertNotNull($createdRole);
    }

}
