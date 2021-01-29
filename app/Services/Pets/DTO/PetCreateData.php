<?php


namespace App\Services\Pets\DTO;

use App\Http\Requests\Pet\PetCreateRequest;
use Spatie\DataTransferObject\DataTransferObject;

class PetCreateData extends DataTransferObject
{
    public string $name;

    public ?string $bread;

    public int $pet_type_id;

    public string $sex;

    public ?int $client_id;

    public static function fromRequest(PetCreateRequest $request): self
    {
        return new self([
            'name' => $request->get('name'),
            'bread' => $request->get('bread'),
            'pet_type_id' => $request->get('pet_type_id'),
            'sex' => $request->get('sex')
        ]);
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

}