<?php


namespace App\Services\Auth\DTO;

use App\Http\Requests\Auth\AuthLoginRequest;
use Spatie\DataTransferObject\DataTransferObject;
class AuthLoginData extends DataTransferObject
{
    public string $email;
    public string $password;

    public static function fromRequest(AuthLoginRequest $request)
    {
        return new self([
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ]);
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }
}