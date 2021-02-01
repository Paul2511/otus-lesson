<?php


namespace Tests\Generators;


class UserRegisterGenerator
{
    public static function dataFromRegister()
    {
        $payload = [
            'name' => 'Test',
            'email' => 'test@mail.com',
            'password' => '123123'
        ];

        return self::generate($payload);

    }

    public static function wrongDataFromRegister()
    {
        $payload = [
            'email' => 'testmail.com',
            'password' => '123123'
        ];

        return self::generate($payload);

    }

    private static function generate(array $data)
    {
        return $data;

    }
}
