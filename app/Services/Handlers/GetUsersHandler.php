<?php


namespace App\Services\Handlers;


use App\Services\Users\Repositories\EloquentUserRepository;
use Illuminate\Database\Eloquent\Collection;

class GetUsersHandler
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


    public function handle():Collection
    {
        return $this->eloquentUserRepository->getList();
    }
}
