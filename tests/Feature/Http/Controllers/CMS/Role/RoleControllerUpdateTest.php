<?php


namespace Http\Controllers\CMS\Role;


use Illuminate\Http\Response;
use Tests\Generators\RoleGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class RoleControllerUpdateTest extends TestCase
{

    /**
     * @group http
     * @group role
     */
    public function testUpdateReturns200()
    {
        $admin = UserGenerator::generateAdmin();
        $role = RoleGenerator::generateRole('testRole');
        $updateRole = RoleGenerator::generateRole('updateRole');
        $response = $this->actingAs($admin)->put(route('role.update', ['role' => $role->id]), $updateRole->toArray());
        $response->assertStatus(Response::HTTP_OK);
    }

}
