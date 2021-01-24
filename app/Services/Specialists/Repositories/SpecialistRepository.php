<?php


namespace App\Services\Specialists\Repositories;

use App\Models\Specialist;
class SpecialistRepository
{
    public function create(array $data): Specialist
    {
        return Specialist::create($data);
    }
}