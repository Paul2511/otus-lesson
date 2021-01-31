<?php


namespace App\Services\Countries\Repositories;


use App\Models\Country;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentCountryRepository
{

    public function findByName(string $name)
    {
        return Country::where("name", $name)->first();
    }

    public function search(
        array $filters = []
    ): LengthAwarePaginator
    {
        return Country::paginate();
    }

    public function getCountriesByContinentName(string $continentName   )
    {
        return Country::where('continent_name', $continentName)
            ->get();
    }

    public function createFromArray(
        array $data
    ): Country
    {
        $country = new Country();
        $country = $country->create($data);
        return $country;
    }

    public function updateFromArray(Country $country, array $data)
    {
        $country->update($data);
        return $country;
    }

}
