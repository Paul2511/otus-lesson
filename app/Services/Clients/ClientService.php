<?php


namespace App\Services\Clients;

use App\Exceptions\Client\ClientCreateException;
use App\Models\Client;
use App\Services\Clients\DTO\ClientCreateData;
use App\Services\Clients\Repositories\ClientRepository;

class ClientService
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    /**
     * @throws ClientCreateException
     */
    public function create(ClientCreateData $clientCreateData): Client
    {
        $data = $clientCreateData->toArray();
        try {
            $client = $this->clientRepository->create($data);
            return $client;
        } catch (\Throwable $e) {
            throw new ClientCreateException($e->getMessage());
        }
    }
}