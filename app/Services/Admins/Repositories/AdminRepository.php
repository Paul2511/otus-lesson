<?php


namespace App\Services\Admins\Repositories;

use App\Models\Admin;
class AdminRepository
{
    public function create(array $data): Admin
    {
        return Admin::create($data);
    }
}