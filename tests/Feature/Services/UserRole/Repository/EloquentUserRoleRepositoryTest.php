<?php


namespace Services\UserRole\Repository;


use App\Services\UserRole\Repository\EloquentUserRoleRepository;
use Tests\Generators\RoleGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class EloquentUserRoleRepositoryTest extends TestCase
{
    private function getEloquentUserRoleRepository(): EloquentUserRoleRepository
    {
        return app(EloquentUserRoleRepository::class);
    }

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
