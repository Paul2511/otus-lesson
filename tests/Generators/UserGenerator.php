<?php


namespace Tests\Generators;


use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use App\Services\UserRole\UserRoleService;

class UserGenerator
{

    public static function generateAdmin()
    {
        $user = self::generate();
        $adminRoleId = Role::where('title', Role::ADMIN_ROLE)->first()->id;
        UserRole::factory()->create([
            'user_id' => $user->id,
            'role_id' => $adminRoleId
        ]);

        return $user;
    }

    public static function generateUserWithRole()
    {
        $user = self::generate();
        $userRoleId = Role::where('title', Role::USER_ROLE)->first()->id;
        UserRole::factory()->create([
            'user_id' => $user->id,
            'role_id' => $userRoleId
        ]);

        return $user;
    }

    public static function generateUser(array $data = [])
    {
        return self::generate($data);
    }

    private static function generate(array $data = [])
    {
        return User::factory()->create($data);

    }


}
