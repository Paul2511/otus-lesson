<?php


namespace Services\UserRole;


use App\Services\UserRole\Repository\EloquentUserRoleRepository;
use App\Services\UserRole\Repository\Interfaces\EloquentUserRoleRepositoryInterface;
use Tests\Generators\RoleGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class UserRoleServiceTest extends TestCase
{
    private function getEloquentUserRoleRepository(): EloquentUserRoleRepositoryInterface
    {
        return app(EloquentUserRoleRepository::class);
    }

    /**
     * @group setRoleOnUser
     */
    public function testSetRoleOnUser()
    {
        $user = UserGenerator::generateUser();
        $role = RoleGenerator::generateUserRole();

        $response = $this->getEloquentUserRoleRepository()->setRoleOnUser($user->id, $role->id);
        $this->assertDatabaseHas('user_roles', [
            'user_id' => $user->id,
            'role_id' => $role->id,
        ]);

        $this->assertTrue($response);
    }

}
