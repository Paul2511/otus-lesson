<?php


namespace App\Services\Countries\Handlers;


use App\Models\Country;
use App\Services\Countries\Repositories\EloquentCountryRepository;

class CountryUpdateHendler
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
     * @param array $data
     * @param Country $country
     */
    public function handle(array $data, Country $country): void
    {
        $this->countryRepository->updateByArray($data,$country->id);
    }
}
