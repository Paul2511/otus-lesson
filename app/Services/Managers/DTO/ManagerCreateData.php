<?php


namespace App\Services\Managers\DTO;

use Spatie\DataTransferObject\DataTransferObject;
class ManagerCreateData extends DataTransferObject
{
    public int $user_id;

    public static function fromArray(array $data): self
    {
        return new self($data);
    }
}