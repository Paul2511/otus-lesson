<?php


namespace Tests\Generators;


use App\Models\User;


class UsersGenerator
{

    public static function generateModerator(array $data = []): User
    {
        return static::generate(
            array_merge(
                ["role" => User::ROLE_MODERATOR],
                $data
            )
        );
    }

    public static function generateAdmin(array $data = []): User
    {
        return static::generate(
            array_merge(
                ["role" => User::ROLE_ADMIN],
                $data
            )
        );
    }

    public static function generate(array $data = []): User
    {
        return User::factory()->create($data);
    }

}
