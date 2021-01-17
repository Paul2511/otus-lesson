<?php

namespace App\Services\Handlers;

use App\Models\User;
use App\Services\Users\Repositories\EloquentUserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UpdateUserHandler
{
    /**
     * @var EloquentUserRepository
     */
    private $eloquentUserRepository;


    public function __construct(
        EloquentUserRepository $eloquentUserRepository
    )
    {
        $this->eloquentUserRepository = $eloquentUserRepository;
    }


    public function handle(int $id, array $data)
    {
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        try {
            $user = $this->eloquentUserRepository->updateUserById($id, $data);
            $user = $this->eloquentUserRepository->attachProjectsToUser($user, $data);
            $user = $this->eloquentUserRepository->attachResourcesToUser($user,$data);
            //        $user = $this->eloquentUserRepository->attachSettingsToUser($user, $data);
            return $user;
        } catch (\Exception $e) {
            Log::channel('slack')->error('Ошибка сохранения пользователя '.$e->getMessage());
        }
    }
}
