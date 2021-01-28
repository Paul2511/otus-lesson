<?php


namespace Tests\Generators;


use App\Models\Role;

class RoleGenerator
{
    public static function generateRole(string $roleName)
    {
        $data = [
            'title' => $roleName
        ];
        return self::generate($data);
    }

    public static function generateUserRole()
    {
        return self::generate(['title' => Role::USER_ROLE]);
    }

    public static function generateAdminRole()
    {
        return self::generate(['title' => Role::ADMIN_ROLE]);
    }

    private static function generate(array $data)
    {
        return Role::factory()->create($data);

    }

}
