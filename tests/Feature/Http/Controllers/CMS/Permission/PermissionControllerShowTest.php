<?php


namespace Http\Controllers\CMS\Permission;

use Illuminate\Http\Response;
use Tests\Generators\PermissionGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class PermissionControllerShowTest extends TestCase
{


    /**
     * @group http
     * @group permission
     */
    public function testShowRedirectNotAuthUsers()
    {
        $permission = PermissionGenerator::generatePermission('testPermission');
        $response = $this->get(route('permission.show', ['permission' => $permission->id]));
        $response->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('login');
    }

    /**
     * @group http
     * @group permission
     */
    public function testShowReturns404()
    {
        $admin = UserGenerator::generateAdmin();
        $response = $this->actingAs($admin)->get(route('permission.show', ['permission' => 0]));
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /**
     * @group http
     * @group permission
     */
    public function testShowReturns200()
    {
        $admin = UserGenerator::generateAdmin();
        $permission = PermissionGenerator::generatePermission('testPermission');
        $response = $this->actingAs($admin)->get(route('permission.show', ['permission' => $permission->id]));
        $response->assertStatus(Response::HTTP_OK);
    }

}
