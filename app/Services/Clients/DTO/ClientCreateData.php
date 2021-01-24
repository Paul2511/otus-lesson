<?php


namespace App\Services\Clients\DTO;

use App\States\Client\Classifier\ClientClassifier;
use Spatie\DataTransferObject\DataTransferObject;
class ClientCreateData extends DataTransferObject
{
    public int $user_id;

    /**
     * @var ClientClassifier|string|null
     */
    public $classifier;

    public static function fromArray(array $data): self
    {
        return new self($data);
    }
}