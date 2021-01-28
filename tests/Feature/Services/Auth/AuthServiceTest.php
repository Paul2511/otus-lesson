<?php


namespace Services\Auth;


use App\Models\Permission;
use App\Services\Auth\Auth\AuthService;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class AuthServiceTest extends TestCase
{
    private function getAuthService(): AuthService
    {
        return app(AuthService::class);
    }

    /**
     * @group hasPermission
     */
    public function testHasUserAdminPermission()
    {
        $admin = UserGenerator::generateAdmin();

        $response = $this->getAuthService()->hasUserPermission($admin, Permission::ADMIN);

        $this->assertTrue($response);

    }

    public function testHasUserPemissionView()
    {
        $user = UserGenerator::generateUserWithRole();
        $response = $this->getAuthService()->hasUserPermission($user, Permission::VIEW);

        $this->assertTrue($response);

    }

    public function testNotRoleInUser()
    {
        $user = UserGenerator::generateUser();
        $response = $this->getAuthService()->hasUserPermission($user, Permission::VIEW);

        $this->assertFalse($response);
    }

}
