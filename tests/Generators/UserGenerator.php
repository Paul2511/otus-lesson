<?php


namespace Tests\Generators;

use App\Models\User;
use App\States\User\Role\AdminUserRole;
use App\States\User\Role\ClientUserRole;
use App\States\User\Role\ManagerUserRole;
use App\States\User\Role\SpecialistUserRole;
use App\States\User\Role\UserRole;

class UserGenerator
{
    private static function generate(array $data): User
    {
        /** @var User $user */
        $user = User::factory()->create($data);

        return $user;
    }

    public static function generateClient(?array $data = []): User
    {
        return self::generate(array_merge([
            'role' => ClientUserRole::class,
        ], $data));
    }

    public static function generateSpec(?array $data = []): User
    {
        return self::generate(array_merge([
            'role' => SpecialistUserRole::class,
        ], $data));
    }

    public static function generateManager(?array $data = []): User
    {
        return self::generate(array_merge([
            'role' => ManagerUserRole::class,
        ], $data));
    }

    public static function generateAdmin(?array $data = []): User
    {
        return self::generate(array_merge([
            'role' => AdminUserRole::class,
        ], $data));
    }


    /**
     * @param string|UserRole $role
     * @param array|null $data
     * @return User
     */
    public static function generateRole($role, ?array $data = []): ?User
    {
        return self::generate(array_merge([
            'role' => $role,
        ], $data));
    }
}