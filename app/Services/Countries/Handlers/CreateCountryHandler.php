<?php


namespace App\Services\Countries\Handlers;


use App\Models\Country;
use App\Services\Countries\DTO\CreateCountryDTO;
use App\Services\Countries\Repositories\EloquentCountryRepository;

class CreateCountryHandler
{

    private EloquentCountryRepository $eloquentCountryRepository;

    public function __construct(
        EloquentCountryRepository $eloquentCountryRepository
    )
    {
        $this->eloquentCountryRepository = $eloquentCountryRepository;
    }

    public function handle(CreateCountryDTO $createCountryDTO): Country
    {
        return $this->eloquentCountryRepository->createFromArray($createCountryDTO->toArray());
    }
}
