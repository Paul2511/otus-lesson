<?php


namespace Http\Controllers\CMS\Role;


use App\Services\Roles\Repository\EloquentRoleRepository;
use Illuminate\Http\Response;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class RoleControllerIndexTest extends TestCase
{
    private function getEloquentRoleRepository(): EloquentRoleRepository
    {
        return app(EloquentRoleRepository::class);
    }

    /**
     * @group http
     * @group role
     */
    public function testIndexRedirectNotAuthUsers()
    {
        $response = $this->get(route('role.index'));
        $response->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('login');
    }

    /**
     * @group http
     * @group role
     */
    public function testIndexReturns200()
    {
        $user = UserGenerator::generateAdmin();
        $response = $this->actingAs($user)->get(route('role.index'));
        $response->assertStatus(Response::HTTP_OK);

        $roles = $this->getEloquentRoleRepository()->search();
        $this->assertNotNull($roles);
    }

}
