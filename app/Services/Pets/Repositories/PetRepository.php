<?php


namespace App\Services\Pets\Repositories;

use App\Http\Requests\ApiGetRequest;
use App\Models\Pet;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
abstract class PetRepository
{
    /**
     * @var Request
     */
    protected $request;

    abstract public function findById(int $id): Pet;

    abstract public function get();

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|mixed
     */
    abstract public function paginate(int $perPage);

    abstract public function create(array $data): Pet;

    abstract public function update(Pet $pet, array $data): bool;

    /** @return bool|null */
    abstract public function delete(Pet $pet);

    /**
     * @var Pet|\Illuminate\Database\Eloquent\Builder
     */
    protected $query;

    protected $isSearch = false;

    protected $tag;


    public function __construct(ApiGetRequest $request)
    {
        $this->request = $request;

        $this->tag = \Str::plural(class_basename(Pet::class));

        $this->query = Pet::query();
    }

    protected function setOrder(): void
    {
        $request = $this->request;

        $order = $request->get('sort', 'id');
        $direction = $request->get('direction', 'asc');

        $this->query->orderBy($order, $direction);
    }

    public function filterByClient(int $clientId): self
    {
        $this->query->where(['client_id'=>$clientId]);

        return $this;
    }

    public function withRequest(): self
    {
        $search = $this->request->get('query', null);

        if ($search) {
            $this->query = Pet::search($search);
            $this->isSearch = true;
        }

        $filters = $this->request->get('filter');


        if ($filters && count($filters) && !$search) {
            $this->query->where($filters);
        }

        $this->setOrder();

        return $this;
    }

}