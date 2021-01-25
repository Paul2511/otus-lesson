<?php


namespace App\Services\Countries\Handlers;


use App\Models\Country;
use App\Services\Countries\Repositories\EloquentCountryRepository;

class CountryDeleteHandler
{

    /**
     * @var EloquentCountryRepository
     */
    private $countryRepository;

    public function __construct(EloquentCountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * @param Country $country
     */
    public function handle(Country $country): void
    {
        $this->countryRepository->deleteById($country->id);
    }
}
