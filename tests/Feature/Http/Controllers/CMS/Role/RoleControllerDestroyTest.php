<?php


namespace Http\Controllers\CMS\Role;

use Illuminate\Http\Response;
use Tests\Generators\RoleGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class RoleControllerDestroyTest extends TestCase
{
    /**
     * @group http
     * @group role
     */
    public function testDestroyReturns200()
    {
        $admin = UserGenerator::generateAdmin();
        $role = RoleGenerator::generateRole('testRole');

        $response = $this->actingAs($admin)->delete(route('role.destroy', ['role' => $role->id]));

        $response->assertStatus(Response::HTTP_OK);
    }

}
