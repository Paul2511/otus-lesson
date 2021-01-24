<?php


namespace App\Services\Admins\DTO;

use Spatie\DataTransferObject\DataTransferObject;
class AdminCreateData extends DataTransferObject
{
    public int $user_id;

    public static function fromArray(array $data): self
    {
        return new self($data);
    }
}