<?php


namespace App\Services\Translates\DTO;

use Spatie\DataTransferObject\DataTransferObject;
class TranslateDTO extends DataTransferObject
{
    public ?int $id;
    public string $type;
    public ?int $row_id;
    public string $locale;
    public ?string $value;


    public static function fromArray(array $data): self
    {
        return new self($data);
    }
}