<?php


namespace App\Support\Phone;

use Spatie\DataTransferObject\DataTransferObject;
use Support\Phone\PhoneFormat;

class PhoneData extends DataTransferObject
{
    public ?string $phone;
    public ?string $formatPhone;

    public static function fromPhone(?string $phone): self
    {
        return new self([
            'phone' => $phone,
            'formatPhone' => $phone ? PhoneFormat::formatPhone($phone) : null
        ]);
    }
}