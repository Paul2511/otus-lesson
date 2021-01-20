<?php


namespace App\Services\Users\Dto;

use App\Models\User;
use Spatie\DataTransferObject\DataTransferObject;
use App\Http\Requests\ApiRequest;

class UserRegisterData extends DataTransferObject
{
    public string $role;

    public string $email;

    public string $password;

    public ?string $phone;

    public ?bool $sendWelcomeEmail;

    public string $clientPassword;


    public static function fromRequest(ApiRequest $request): self
    {
        return new self([
            'role' => $request->get('role', User::ROLE_CLIENT),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'phone' => $request->get('phone'),
            'sendWelcomeEmail' => $request->get('sendWelcomeEmail'),
            'clientPassword' => $request->get('password')
        ]);
    }

    public static function fromArray(array $data): self
    {
        if (!isset($data['clientPassword'])) {
            $data['clientPassword'] = $data['password'];
        }

        return new self($data);
    }

}