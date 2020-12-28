<?php

namespace App\Services\Handlers;

use App\Services\Users\Repositories\EloquentUserRepository;
use Illuminate\Support\Facades\Hash;

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

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function handle(int $id, array $data)
    {
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        $user = $this->eloquentUserRepository->updateUserById($id, $data);
        $user = $this->eloquentUserRepository->attachProjectsToUser($user, $data);
        $user = $this->eloquentUserRepository->attachResourcesToUser($user, $data);
//        $user = $this->eloquentUserRepository->attachSettingsToUser($user, $data);

        return $user;
    }
}
