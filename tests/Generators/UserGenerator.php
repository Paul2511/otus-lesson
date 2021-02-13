<?php


namespace Tests\Generators;


use App\Models\User;

class UserGenerator
{

    private static function generate(array $data)
    {
        return User::factory()->create($data);
    }

    public static function admin(array $data = [])
    {
        return self::generate(array_merge([
            'level' => User::LEVEL_ADMIN
        ], $data));
    }

    public static function moderator(array $data = [])
    {
        return self::generate(array_merge([
            'level' => User::LEVEL_MODERATOR
        ], $data));
    }

    public static function plain(array $data = [])
    {
        return self::generate(array_merge([
            'level' => User::LEVEL_USER
        ], $data));
    }
}
