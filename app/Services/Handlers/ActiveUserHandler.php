<?php


namespace App\Services\Handlers;


use App\Services\Users\Repositories\EloquentUserRepository;
use Illuminate\Database\Eloquent\Collection;

class ActiveUserHandler
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


    public function handle(int $id, int $is_active)
    {
        return $this->eloquentUserRepository->activeUser($id, $is_active);
    }
}
