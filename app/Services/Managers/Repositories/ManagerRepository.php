<?php


namespace App\Services\Managers\Repositories;

use App\Models\Manager;
class ManagerRepository
{
    public function create(array $data): Manager
    {
        return Manager::create($data);
    }
}