<?php


namespace Tests\Feature\Generators;


use App\Models\Role;
use App\Models\User;
use App\Services\Users\Repositories\EloquentUserRepository;

class UsersGenerator
{
    private function getEloquentUserRepository(): EloquentUserRepository
    {
        return app(EloquentUserRepository::class);
    }

    public static $roles = [
        Role::ROLE_USER => 1,
        Role::ROLE_MANAGER => 2,
        Role::ROLE_ADMIN => 3
    ];

    public static function generateActiveUser(array $data = []): User
    {
        $user = self::generate(array_merge(['status' => User::STATUS_ACTIVE], $data));
        $user = self::assignRole($user, self::$roles[Role::ROLE_USER]);

        return $user;
    }

    public static function generateInactiveUser(array $data = []): User
    {
        $user = self::generate(array_merge(['status' => User::STATUS_INACTIVE], $data));
        $user = self::assignRole($user, self::$roles[Role::ROLE_USER]);

        return $user;
    }

    public static function generateActiveManager(array $data = []): User
    {
        $user = self::generate(array_merge(['status' => User::STATUS_ACTIVE], $data));
        $user = self::assignRole($user, self::$roles[Role::ROLE_MANAGER]);

        return $user;
    }

    public static function generateInactiveManager(array $data = []): User
    {
        $user = self::generate(array_merge(['status' => User::STATUS_INACTIVE], $data));
        $user = self::assignRole($user, self::$roles[Role::ROLE_MANAGER]);

        return $user;
    }

    public static function generateActiveAdmin(array $data = []): User
    {
        $user = self::generate(array_merge(['status' => User::STATUS_ACTIVE], $data));
        $user = self::assignRole($user, self::$roles[Role::ROLE_ADMIN]);

        return $user;
    }

    public static function generateInactiveAdmin(array $data = []): User
    {
        $user = self::generate(array_merge(['status' => User::STATUS_INACTIVE], $data));
        $user = self::assignRole($user, self::$roles[Role::ROLE_ADMIN]);

        return $user;
    }

    public static function generateUserData(array $data = []): array
    {
        $user = User::factory()->make(array_merge(['status' => User::STATUS_ACTIVE], $data));
        $user = $user->role()->associate(self::$roles[Role::ROLE_USER]);

        $data = $user->only([
            'first_name',
            'last_name',
            'email',
            'phone',
            'password',
            'inn',
        ]);
        $role = $user->role->only(['name']);
        $role['role'] = $role['name'];
        unset($role['name']);

        $data = array_merge($data, $role);

        return $data;
    }

    public static function generateUpdateUserData(array $data = []): array
    {
        $user = User::factory()->create(array_merge(['status' => User::STATUS_ACTIVE], $data));
        $user = $user->role()->associate(self::$roles[Role::ROLE_USER]);

        $data = $user->only([
            'id',
            'first_name',
            'last_name',
            'email',
            'phone',
            'password',
            'inn',
        ]);

        $role = $user->role->only(['name']);
        $role['role'] = $role['name'];
        unset($role['name']);

        $data = array_merge($data, $role);

        return $data;
    }

    public static function generate(array $data): User
    {
        return User::factory()->create($data);
    }

    public static function assignRole(User $user, int $role): User
    {
        $user->role()->associate($role)->save();

        return $user;
    }

}