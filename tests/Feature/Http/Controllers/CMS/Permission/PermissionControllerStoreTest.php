<?php


namespace Http\Controllers\CMS\Permission;


use App\Services\Permissions\Repository\EloquentPermissionRepository;
use Illuminate\Http\Response;
use Tests\Generators\PermissionGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class PermissionControllerStoreTest extends TestCase
{
    private function getEloquentPermissionRepository(): EloquentPermissionRepository
    {
        return app(EloquentPermissionRepository::class);
    }

    /**
     * @group http
     * @group permission
     */
    public function testStoreRedirectNotAuthUsers()
    {
        $permission = PermissionGenerator::generatePermission('testPermission');
        $response = $this->post(route('permission.store'), $permission->toArray());
        $response->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('login');
    }

    /**
     * @group http
     * @group permission
     */
    public function testStoreReturn200()
    {
        $permission = PermissionGenerator::generatePermission('testPermission');
        $admin = UserGenerator::generateAdmin();
        $response = $this->actingAs($admin)->post(route('permission.store'), $permission->toArray());
        $response->assertStatus(Response::HTTP_CREATED);

        $createdRole = $this->getEloquentPermissionRepository()->findOrFail($response->json()['id']);
        $this->assertNotNull($createdRole);
    }

}
