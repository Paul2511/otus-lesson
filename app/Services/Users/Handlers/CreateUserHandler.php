<?php


namespace App\Services\Users\Handlers;


use App\Models\User;

class CreateUserHandler
{
    public function create(array $data)
    {
        User::create($data);
    }
}
