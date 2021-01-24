<?php


namespace App\Listeners\User\UserRole;

use App\Models\User;
use App\Services\Clients\DTO\ClientCreateData;
use App\Services\Clients\ClientService;
class UserRoleCreateClient implements UserRoleCreateInterface
{
    private function getClientService(): ClientService
    {
        return app(ClientService::class);
    }

    /**
     * @throws \App\Exceptions\Client\ClientCreateException
     */
    public function handle(User $user): void
    {
        $clientService = $this->getClientService();

        $data = array_merge([
            'user_id' => $user->id
        ], $user->clientData);

        $clientData = ClientCreateData::fromArray($data);

        $clientService->create($clientData);
    }
}