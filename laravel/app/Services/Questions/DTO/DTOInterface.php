<?php


namespace App\Services\Questions\DTO;


interface DTOInterface
{
    public static function fromArray(array $data): self;
    public function toArray(): array;
}
