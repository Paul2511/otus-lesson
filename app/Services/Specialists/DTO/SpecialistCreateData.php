<?php


namespace App\Services\Specialists\DTO;

use App\States\Specialist\Classifier\SpecialistClassifier;
use Spatie\DataTransferObject\DataTransferObject;
class SpecialistCreateData extends DataTransferObject
{
    public int $user_id;

    public ?int $specialization_id;

    /**
     * @var SpecialistClassifier|string|null
     */
    public $classifier;

    public static function fromArray(array $data): self
    {
        return new self($data);
    }
}