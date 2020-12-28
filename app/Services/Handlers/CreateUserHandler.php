<?php


namespace App\Services\Handlers;


use App\Services\Users\Repositories\EloquentUserRepository;
use Illuminate\Support\Facades\Hash;

class CreateUserHandler
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

    public function handle($data)
    {
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        $user = $this->eloquentUserRepository->createUser($data);
        $user = $this->eloquentUserRepository->attachProjectsToUser($user, $data);
        $user = $this->eloquentUserRepository->attachResourcesToUser($user, $data);
//        $user = $this->eloquentUserRepository->attachSettingsToUser($user, $data);
        return $user;
    }
}
