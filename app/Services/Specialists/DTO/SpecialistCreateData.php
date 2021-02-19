<?php


namespace App\Services\Specialists\DTO;

use App\States\Specialist\Classifier\SpecialistClassifier;
use Spatie\DataTransferObject\DataTransferObject;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        $validator = Validator::make($data, [
            'specialization_id' => ['exists:\App\Models\Specialization,id']
        ]);

        if ($validator->fails()) {
            unset($data['specialization_id']);
        }

        return new self($data);
    }
}