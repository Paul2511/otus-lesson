<?php


namespace App\Services\Auth\DTO;

use App\Http\Requests\Auth\AuthResetPasswordRequest;
use Spatie\DataTransferObject\DataTransferObject;
class AuthResetPasswordData extends DataTransferObject
{
    public string $email;
    public string $password;
    public string $password_confirmation;
    public string $token;

    public static function fromRequest(AuthResetPasswordRequest $request)
    {
        return new self([
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'password_confirmation' => $request->get('password_confirmation'),
            'token' => $request->get('token'),
        ]);
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }
}