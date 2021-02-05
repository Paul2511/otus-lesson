<?php


namespace App\Services\QuestionsCategories\DTO;


interface DTOInterface
{
    public static function fromArray(array $data): self;
    public function toArray(): array;
}
