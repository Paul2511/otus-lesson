<?php


namespace Services\Register;


use App\Services\Roles\RolesServices;
use App\Services\Users\Repository\EloquentUserRepository;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class RegisterServiceTest extends TestCase
{
    private function getEloquentUserRepository(): EloquentUserRepository
    {
        return app(EloquentUserRepository::class);
    }

    private function getRoleService(): RolesServices
    {
        return app(RolesServices::class);
    }

    /**
     * @group register
     */
    public function testRegister()
    {
        $userData = UserGenerator::generateDataRegister();

        $user = $this->getEloquentUserRepository()->create($userData);
        $this->assertDatabaseHas('users', [
            'email' => $userData['email'],
        ]);
        $role = $this->getRoleService()->getDefaultRole();
        $user->roles()->attach($role->id);

        $this->assertDatabaseHas('user_roles', [
            'user_id' => $user->id,
            'role_id' => $role->id,
        ]);

        $this->assertNotEmpty($user);

    }

}
