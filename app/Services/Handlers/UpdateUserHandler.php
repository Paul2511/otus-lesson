<?php


namespace App\Services\Handlers;


use App\Services\Users\Repositories\EloquentUserRepository;

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
        $user = $this->eloquentUserRepository->updateUserById($id, $data);
        $user = $this->eloquentUserRepository->attachProjectsToUser($user, $data);
        $user = $this->eloquentUserRepository->attachResourcesToUser($user, $data);
//        $user = $this->eloquentUserRepository->attachSettingsToUser($user, $data);

        return $user;
    }
}
