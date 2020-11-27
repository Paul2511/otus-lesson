<?php


namespace App\Services\Handlers;


use App\Services\Users\Repositories\EloquentUserRepository;

class FindUserHandler
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

    public function handle(int $id)
    {
        $user = $this->eloquentUserRepository->findUserByIdWithRelations($id, [
            'roles', 'companies'
        ]);

        return $user;
    }
}