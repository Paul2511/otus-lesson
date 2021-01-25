<?php


namespace App\Services\Countries;


use App\Models\Country;
use App\Services\Countries\Handlers\CountryCreateHandler;
use App\Services\Countries\Handlers\CountryDeleteHandler;
use App\Services\Countries\Handlers\CountryUpdateHendler;
use App\Services\Countries\Repositories\EloquentCountryRepository;
use Illuminate\Database\Eloquent\Builder;

class CountryService
{
    /**
     * @var CountryCreateHandler
     */
    private $countryCreateHandler;
    /**
     * @var CountryUpdateHendler
     */
    private $countryUpdateHandler;
    /**
     * @var CountryDeleteHandler
     */
    private $countryDeleteHandler;
    /**
     * @var EloquentCountryRepository
     */
    private $countryRepository;

    /**
     * CountryService constructor.
     * @param CountryCreateHandler $countryCreateHandler
     * @param CountryUpdateHendler $countryUpdateHandler
     * @param CountryDeleteHandler $countryDeleteHandler
     * @param EloquentCountryRepository $countryRepository
     */
    public function __construct(CountryCreateHandler $countryCreateHandler, CountryUpdateHendler $countryUpdateHandler, CountryDeleteHandler $countryDeleteHandler, EloquentCountryRepository $countryRepository)
    {
        $this->countryCreateHandler = $countryCreateHandler;
        $this->countryUpdateHandler = $countryUpdateHandler;
        $this->countryDeleteHandler = $countryDeleteHandler;
        $this->countryRepository = $countryRepository;
    }

    /**
     * @param array $data
     */
    public function createByArray(array $data): void
    {
        $this->countryCreateHandler->handle($data);
    }

    /**
     * @param array $data
     * @param Country $country
     */
    public function updateByArray(array $data, Country $country): void
    {
        $this->countryUpdateHandler->handle($data, $country);
    }

    /**
     * @param Country $country
     */
    public function deleteById(Country $country): void
    {
        $this->countryDeleteHandler->handle($country);
    }

    public function newQuery():Builder{
        return $this->countryRepository->newQuery();
    }
}
