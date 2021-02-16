<?php


namespace App\Services\Users\DTO;


use App\Models\User;

class CreateUserDTO
{
    private string $name;
    private string $email;
    private string $password;
    private bool $isAdmin;
    private bool $isModerator;

    public function __construct(
        string $name,
        string $email,
        string $password,
        bool $isAdmin,
        bool $isModerator
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->isAdmin = $isAdmin;
        $this->isModerator = $isModerator;
    }

    public static function initFromArray(array $data): CreateUserDTO
    {
        return new static(
            $data["name"],
            $data["email"],
            $data["password"],
            $data["isAdmin"],
            $data["isModerator"],
        );
    }

    public function getUserRole(): int
    {
        if ($this->isAdmin) {
            return User::ROLE_ADMIN;
        }
        if ($this->isModerator) {
            return User::ROLE_MODERATOR;
        }

        return User::ROLE_DEFAULT;
    }

    public function getUserCreateArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->getUserRole(),
            'password' => bcrypt($this->password),
        ];
    }

}
