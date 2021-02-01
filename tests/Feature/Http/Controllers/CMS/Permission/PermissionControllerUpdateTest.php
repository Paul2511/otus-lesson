<?php


namespace Http\Controllers\CMS\Permission;


use Illuminate\Http\Response;
use Tests\Generators\PermissionGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class PermissionControllerUpdateTest extends TestCase
{
    /**
     * @group http
     * @group permission
     */
    public function testUpdateReturns200()
    {
        $admin = UserGenerator::generateAdmin();
        $permission = PermissionGenerator::generatePermission('testPermission');
        $permissionUpdate = PermissionGenerator::generatePermission('testPermissions');
        $response = $this->actingAs($admin)->put(route('permission.update', ['permission' => $permission->id]), $permissionUpdate->toArray());
        $response->assertStatus(Response::HTTP_OK);
    }

}
