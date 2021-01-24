<?php


namespace App\Services\Admins;

use App\Exceptions\Admin\AdminCreateException;
use App\Models\Admin;
use App\Services\Admins\DTO\AdminCreateData;
Use App\Services\Admins\Repositories\AdminRepository;

class AdminService
{
    /**
     * @var AdminRepository
     */
    private $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    /**
     * @throws AdminCreateException
     */
    public function create(AdminCreateData $adminCreateData): Admin
    {
        $data = $adminCreateData->toArray();
        try {
            $admin = $this->adminRepository->create($data);
            return $admin;
        } catch (\Throwable $e) {
            throw new AdminCreateException($e->getMessage());
        }
    }
}