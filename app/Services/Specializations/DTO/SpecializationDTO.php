<?php


namespace App\Services\Specializations\DTO;

use App\Http\Requests\Specialization\SpecializationRequest;
use Spatie\DataTransferObject\DataTransferObject;
use App\Services\Translates\DTO\TranslateDTO;
class SpecializationDTO extends DataTransferObject
{
    public string $slug;

    public ?array $translates;

    public static function fromRequest(SpecializationRequest $request)
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