<?php


namespace App\Services\Handlers;


use App\Services\Users\Repositories\EloquentUserRepository;

class ShowUserHandler
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
        $user = $this->eloquentUserRepository->showUserByIdWithRelations($id, [
            'roles', 'companies'
        ]);

        return $user;
    }
}