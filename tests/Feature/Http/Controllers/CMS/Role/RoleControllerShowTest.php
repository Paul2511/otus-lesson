<?php


namespace Http\Controllers\CMS\Role;


use App\Services\Roles\Repository\EloquentRoleRepository;
use Illuminate\Http\Response;
use Tests\Generators\RoleGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class RoleControllerShowTest extends TestCase
{
    private function getEloquentRoleRepository(): EloquentRoleRepository
    {
        return app(EloquentRoleRepository::class);
    }

    /**
     * @group http
     * @group role
     */
    public function testShowRedirectNotAuthUsers()
    {
        $role = RoleGenerator::generateRole('testRole');
        $response = $this->get(route('role.show', ['role' => $role->id]));
        $response->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('login');
    }

    /**
     * @group http
     * @group role
     */
    public function testShowReturns404()
    {
        $admin = UserGenerator::generateAdmin();
        $response = $this->actingAs($admin)->get(route('role.show', ['role' => 0]));
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /**
     * @group http
     * @group role
     */
    public function testShowReturns200()
    {
        $admin = UserGenerator::generateAdmin();
        $role = RoleGenerator::generateRole('testRole');
        $response = $this->actingAs($admin)->get(route('role.show', ['role' => $role->id]));
        $response->assertStatus(Response::HTTP_OK);
    }

}
