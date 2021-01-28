<?php


namespace Http\Controllers\CMS\Permission;


use Illuminate\Http\Response;
use Tests\Generators\PermissionGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class PermissionControllerDestroyTest extends TestCase
{

    /**
     * @group http
     * @group permission
     */
    public function testDestroyReturns200()
    {
        $admin = UserGenerator::generateAdmin();
        $permission = PermissionGenerator::generatePermission('testPermission');

        $response = $this->actingAs($admin)->delete(route('permission.destroy', ['permission' => $permission->id]));

        $response->assertStatus(Response::HTTP_OK);
    }

}
