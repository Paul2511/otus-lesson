<?php


namespace App\Services\Countries\Repositories;


use App\Models\Country;
use App\Services\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

class EloquentCountryRepository implements BaseRepositoryInterface
{
    /**
     * @var Country
     */
    private $country;

    /**
     * EloquentCountryRepository constructor.
     * @param Country $country
     */
    public function __construct(Country $country)
    {
        $this->country = $country;
    }

    /**
     * @param array $data
     */
    public function createByArray(array $data): void
    {
        $this->country->create($data);
    }

    /**
     * @param array $data
     * @param int $id
     */
    public function updateByArray(array $data, int $id): void
    {
        $this->country->find($id)->update($data);
    }

    /**
     * @param int $id
     */
    public function deleteById(int $id): void
    {
        $this->country->find($id)->delete();
    }

    /**
     * @param int $id
     * @return Country|null
     */
    public function findById(int $id): ?Country
    {
        return $this->country->find($id);
    }

    /**
     * @return Builder
     */
    public function newQuery():Builder
    {
        return  $this->country->newQuery();
    }
}
