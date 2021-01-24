<?php


namespace App\Services\Users\DTO;

use App\Http\Requests\User\UserRegisterRequest;
use App\States\User\Role\ClientUserRole;
use Spatie\DataTransferObject\DataTransferObject;
class UserRegisterData extends DataTransferObject
{
    public string $role;

    public string $email;

    public string $password;

    public ?string $phone;

    public ?bool $sendWelcomeEmail;

    public string $clientPassword;

    public ?string $locale;

    public static function fromRequest(UserRegisterRequest $request): self
    {
        return new self([
            'role' => $request->get('role', ClientUserRole::$name),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'phone' => $request->get('phone'),
            'sendWelcomeEmail' => $request->get('sendWelcomeEmail'),
            'clientPassword' => $request->get('password'),
            'locale' => $request->get('locale'),
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