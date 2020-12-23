<?php


namespace Tests\Generators;

use App\Models\User;
use App\Models\UserDetail;
use App\Services\Users\Helpers\UserLabelsHelper;
class UserGenerator
{
    private static function generate(array $data): User
    {
        /** @var User $user */
        $user = User::factory()->create($data);
        UserDetail::factory()->create([
            'user_id' => $user->id,
        ]);
        return $user;
    }

    public static function generateClient(?array $data = []): User
    {
        return self::generate(array_merge([
            'role' => User::ROLE_CLIENT,
        ], $data));
    }

    public static function generateSpec(?array $data = []): User
    {
        return self::generate(array_merge([
            'role' => User::ROLE_SPEC,
        ], $data));
    }

    public static function generateManager(?array $data = []): User
    {
        return self::generate(array_merge([
            'role' => User::ROLE_MANAGER,
        ], $data));
    }

    public static function generateAdmin(?array $data = []): User
    {
        return self::generate(array_merge([
            'role' => User::ROLE_ADMIN,
        ], $data));
    }


    /**
     * @param string $role
     * @param array|null $data
     * @return User|null
     */
    public static function generateRole(string $role, ?array $data = []): ?User
    {
        $roles = UserLabelsHelper::roleLabels();

        if (in_array($role, array_keys($roles))) {
            return self::generate(array_merge([
                'role' => $role,
            ], $data));
        }

        return null;
    }
}