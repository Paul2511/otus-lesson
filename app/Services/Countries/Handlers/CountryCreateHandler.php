<?php


namespace App\Services\Countries\Handlers;


use App\Services\Countries\Repositories\EloquentCountryRepository;

class CountryCreateHandler
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
     */
    public function handle(array $data): void
    {
        $this->countryRepository->createByArray($data);
    }
}
