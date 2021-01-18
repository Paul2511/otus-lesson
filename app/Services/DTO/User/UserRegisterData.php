<?php


namespace App\Services\DTO\User;

use App\Models\User;
use Spatie\DataTransferObject\DataTransferObject;
use App\Http\Requests\ApiRequest;
/**
 * Class UserRegisterData
 * @package App\Services\DTO\User
 */

class UserRegisterData extends DataTransferObject
{
    public string $role;

    public string $email;

    public string $password;

    public ?string $phone;

    public ?bool $sendWelcomeEmail;


    public static function fromRequest(ApiRequest $request): self
    {
        return new self([
            'role' => $request->get('role', User::ROLE_CLIENT),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'phone' => $request->get('phone'),
            'sendWelcomeEmail' => $request->get('sendWelcomeEmail'),
        ]);
    }
}