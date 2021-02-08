<?php


namespace App\Services\Specializations\Repositories;

use App\Http\Requests\ApiGetRequest;
use App\Models\Specialization;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

abstract class SpecializationRepository
{
    /**
     * @var Request
     */
    protected $request;

    abstract public function findById(int $id): Specialization;

    /**
     * @return Specialization[]|\Illuminate\Database\Eloquent\Builder[]|Collection|mixed
     */
    abstract public function get();

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|mixed
     */
    abstract public function paginate(int $perPage);

    abstract public function create(array $data): Specialization;

    abstract public function update(Specialization $specialization, array $data): bool;


    /** @return bool|null */
    abstract public function delete(Specialization $specialization);

    /**
     * @var Specialization|\Illuminate\Database\Eloquent\Builder
     */
    protected $query;

    protected $isSearch = false;

    protected $tag;

    public function __construct(ApiGetRequest $request)
    {
        $this->request = $request;

        $this->tag = \Str::plural(class_basename(Specialization::class));

        $search = $request->get('query', null);

        if ($search) {
            $this->query = Specialization::search($search);
            $this->isSearch = true;
        } else {
            $this->query = Specialization::query();
        }

        $order = $request->get('sort', 'id');
        $direction = $request->get('direction', 'asc');

        $this->query->orderBy($order, $direction);
    }
}