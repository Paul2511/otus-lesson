<?php

namespace Tests\Generators;

use App\Models\User;
use App\Services\Users\Repositories\EloquentUserRepository;

class UsersGenerator
{
    public static function generateAdmin(array $data = [])
    {
        return self::generate(array_merge(['is_admin' => 1], $data));
    }

    public static function generatePlain(array $data = [])
    {
        return self::generate($data);
    }

    public static function generateActivePlainUser(array $data = [])
    {
        return self::generate(array_merge(['is_active' => 1], $data));
    }

    public static function addResourceForUser(User $user, int $resource_id): User
    {
        return app(EloquentUserRepository::class)->attachResourcesToUser($user, ['resources' => [$resource_id]]);
    }

    private static function generate(array $data)
    {
        return User::factory()->create($data);
    }

}
