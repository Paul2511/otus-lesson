<?php


namespace App\Services\Countries\Handlers;


use App\Models\Country;
use App\Services\Countries\DTO\UpdateCountryDTO;
use App\Services\Countries\Repositories\EloquentCountryRepository;

class UpdateCountryHandler
{

    private EloquentCountryRepository $eloquentCountryRepository;

    public function __construct(
        EloquentCountryRepository $eloquentCountryRepository
    )
    {
        $this->eloquentCountryRepository = $eloquentCountryRepository;
    }

    public function handle(Country $country, UpdateCountryDTO $updateCountryDTO): Country
    {
        return $this->eloquentCountryRepository->updateFromArray($country, $updateCountryDTO->toArray());
    }
}
