<?php


namespace App\Services\Pets\DTO;

use App\Http\Requests\Pet\PetUpdateRequest;
use App\Services\Files\DTO\ImageData;
use Spatie\DataTransferObject\DataTransferObject;

class PetUpdateData extends DataTransferObject
{
    public ?string $name;

    public ?ImageData $photo;

    public ?string $bread;

    public ?int $pet_type_id;

    public ?string $sex;

    public static function fromRequest(PetUpdateRequest $request): self
    {
        return new self([
            'name' => $request->get('name'),
            'photo' => $request->get('photo'),
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