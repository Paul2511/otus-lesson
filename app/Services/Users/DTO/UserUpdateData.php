<?php


namespace App\Services\Users\DTO;

use App\Http\Requests\User\UserUpdateRequest;
use App\Services\Files\DTO\ImageData;
use Spatie\DataTransferObject\DataTransferObject;
use Support\Person\PersonName\PersonNameData;

class UserUpdateData extends DataTransferObject
{
    public ?string $status;

    public ?PersonNameData $name;

    public ?ImageData $avatar;

    public ?string $locale;

    public static function fromRequest(UserUpdateRequest $request): self
    {
        return new self([
            'status' => $request->get('status'),
            'name' => $request->get('name'),
            'avatar' => $request->get('avatar'),
            'locale' => $request->get('locale')
        ]);
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

}