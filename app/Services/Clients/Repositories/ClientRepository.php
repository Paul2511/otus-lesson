<?php


namespace App\Services\Clients\Repositories;

use App\Models\Client;
class ClientRepository
{
    public function create(array $data): Client
    {
        return Client::create($data);
    }
}