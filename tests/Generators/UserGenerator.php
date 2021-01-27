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

    public static function generateUser()
    {
        return self::generate();
    }

    private static function generate()
    {
        return User::factory()->create();

    }


}
