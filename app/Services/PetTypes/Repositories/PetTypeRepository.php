<?php


namespace App\Services\PetTypes\Repositories;

use App\Http\Requests\ApiGetRequest;
use App\Models\PetType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

abstract class PetTypeRepository
{
    /**
     * @var Request
     */
    protected $request;

    abstract public function findById(int $id): PetType;

    /**
     * @return PetType[]|\Illuminate\Database\Eloquent\Builder[]|Collection|mixed
     */
    abstract public function get();

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|mixed
     */
    abstract public function paginate(int $perPage);

    abstract public function create(array $data): PetType;

    abstract public function update(PetType $petType, array $data): bool;

    /** @return bool|null */
    abstract public function delete(PetType $petType);

    /**
     * @var PetType|\Illuminate\Database\Eloquent\Builder
     */
    protected $query;

    protected $isSearch = false;

    protected $tag;

    public function __construct(ApiGetRequest $request)
    {
        $this->request = $request;

        $this->tag = \Str::plural(class_basename(PetType::class));

        $search = $request->get('query', null);

        if ($search) {
            $this->query = PetType::search($search);
            $this->isSearch = true;
        } else {
            $this->query = PetType::query();
        }

        $order = $request->get('sort', 'id');
        $direction = $request->get('direction', 'asc');

        $this->query->orderBy($order, $direction);
    }
}