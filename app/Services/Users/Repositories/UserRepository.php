<?php


namespace App\Services\Users\Repositories;

use App\Http\Requests\ApiGetRequest;
use App\Models\User;
abstract class UserRepository
{
    /**
     * @var ApiGetRequest
     */
    protected $request;

    abstract public function findById(int $id): User;

    abstract public function get();

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|mixed
     */
    abstract public function paginate(int $perPage);

    abstract public function create(array $data): User;

    abstract public function update(User $user, array $data): bool;

    /** @return bool|null */
    abstract public function delete(User $user);

    /**
     * @var User|\Illuminate\Database\Eloquent\Builder
     */
    protected $query;

    protected $isSearch = false;

    protected $tag;


    public function __construct(ApiGetRequest $request)
    {
        $this->request = $request;

        $this->tag = \Str::plural(class_basename(User::class));

        $this->query = User::query();
    }

    protected function setOrder(): void
    {
        $request = $this->request;

        $order = $request->get('sort', 'id');
        $direction = $request->get('direction', 'asc');

        $this->query->orderBy($order, $direction);
    }

    public function withRequest(): self
    {
        $search = $this->request->get('query', null);

        if ($search) {
            $this->query = User::search($search);
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