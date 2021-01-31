<?php


namespace App\Services\Countries;


use App\Models\Country;
use App\Services\Countries\DTO\CreateCountryDTO;
use App\Services\Countries\DTO\UpdateCountryDTO;
use App\Services\Countries\Handlers\CreateCountryHandler;
use App\Services\Countries\Handlers\UpdateCountryHandler;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CountriesService
{

    /**
     * @var CreateCountryHandler
     */
    private CreateCountryHandler $createCountryHandler;
    private UpdateCountryHandler $updateCountryHandler;

    public function __construct(
        CreateCountryHandler $createCountryHandler,
        UpdateCountryHandler $updateCountryHandler
    )
    {
        $this->createCountryHandler = $createCountryHandler;
        $this->updateCountryHandler = $updateCountryHandler;
    }

    public function createCountry(CreateCountryDTO $createCountryDTO): Country
    {
        return $this->createCountryHandler->handle($createCountryDTO);
    }

    public function updateCountry(Country $country, UpdateCountryDTO $updateCountryDTO): Country
    {
        return $this->updateCountryHandler->handle($country, $updateCountryDTO);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function searchCountries(): LengthAwarePaginator
    {
        return $this->countryRepository->search();
    }

}
