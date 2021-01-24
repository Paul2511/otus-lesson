<?php


namespace App\Listeners\User\UserRole;

use App\Models\User;
use App\Services\Specialists\DTO\SpecialistCreateData;
use App\Services\Specialists\SpecialistService;
class UserRoleCreateSpecialist implements UserRoleCreateInterface
{
    private function getSpecialistService(): SpecialistService
    {
        return app(SpecialistService::class);
    }

    /**
     * @throws \App\Exceptions\Specialist\SpecialistCreateException
     */
    public function handle(User $user): void
    {
        $service = $this->getSpecialistService();

        $data = array_merge([
            'user_id' => $user->id
        ], $user->specialistData);

        $specialistData = SpecialistCreateData::fromArray($data);

        $service->create($specialistData);
    }
}