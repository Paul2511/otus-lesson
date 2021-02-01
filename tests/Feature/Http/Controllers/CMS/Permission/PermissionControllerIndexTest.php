<?php


namespace Http\Controllers\CMS\Permission;


use App\Services\Permissions\Repository\EloquentPermissionRepository;
use Illuminate\Http\Response;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class PermissionControllerIndexTest extends TestCase
{
    private function getEloquentPermissionRepository(): EloquentPermissionRepository
    {
        return app(EloquentPermissionRepository::class);
    }

    /**
     * @group http
     * @group permission
     */
    public function testIndexRedirectNotAuthUsers()
    {
        $response = $this->get(route('permission.index'));
        $response->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('login');
    }

    /**
     * @group http
     * @group permission
     */
    public function testIndexReturns200()
    {
        $user = UserGenerator::generateAdmin();
        $response = $this->actingAs($user)->get(route('permission.index'));
        $response->assertStatus(Response::HTTP_OK);

        $permissions = $this->getEloquentPermissionRepository()->search();
        $this->assertNotNull($permissions);
    }

}
