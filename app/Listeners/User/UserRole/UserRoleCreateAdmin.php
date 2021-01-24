<?php


namespace App\Listeners\User\UserRole;

use App\Models\User;
use App\Services\Admins\DTO\AdminCreateData;
use App\Services\Admins\AdminService;
class UserRoleCreateAdmin implements UserRoleCreateInterface
{
    private function getAdminService(): AdminService
    {
        return app(AdminService::class);
    }

    /**
     * @throws \App\Exceptions\Admin\AdminCreateException
     */
    public function handle(User $user): void
    {
        $service = $this->getAdminService();

        $data = array_merge([
            'user_id' => $user->id
        ], $user->adminData);

        $adminData = AdminCreateData::fromArray($data);

        $service->create($adminData);
    }
}