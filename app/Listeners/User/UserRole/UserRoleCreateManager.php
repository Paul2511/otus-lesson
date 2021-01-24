<?php


namespace App\Listeners\User\UserRole;

use App\Models\User;
use App\Services\Managers\DTO\ManagerCreateData;
use App\Services\Managers\ManagerService;
class UserRoleCreateManager implements UserRoleCreateInterface
{
    private function getManagerService(): ManagerService
    {
        return app(ManagerService::class);
    }

    /**
     * @throws \App\Exceptions\Manager\ManagerCreateException
     */
    public function handle(User $user): void
    {
        $service = $this->getManagerService();

        $data = array_merge([
            'user_id' => $user->id
        ], $user->managerData);

        $managerData = ManagerCreateData::fromArray($data);

        $service->create($managerData);
    }
}