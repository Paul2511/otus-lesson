<?php


namespace Tests\Generators;


use App\Models\User;

class UsersGenerator
{
    public static function generateAdmin(array $data = []): User
    {
        return static::generate(array_merge($data,[
            'level' => User::LEVEL_ADMIN
        ]));
    }

    protected static function generate(array $data = []): User
    {
        return User::factory()->create($data);
    }

}
