<?php


namespace App\Services\PetTypes\DTO;

use App\Http\Requests\PetType\PetTypeRequest;
use Spatie\DataTransferObject\DataTransferObject;
use App\Services\Translates\DTO\TranslateDTO;
class PetTypeDTO extends DataTransferObject
{
    public string $slug;

    public ?array $translates;

    public static function fromRequest(PetTypeRequest $request)
    {
        $result = [
            'slug' => $request->get('slug')
        ];

        $translates = $request->get('translates');
        if ($translates && count($translates)) {
            foreach ($translates as $translate) {
                try {
                    $result['translates'][] = TranslateDTO::fromArray($translate);
                } catch (\Throwable $e) {

                }

            }
        }

        return new self($result);
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }
}