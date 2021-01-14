<?php


namespace App\Services\Columns;


use App\Services\Columns\Repository\Interfaces\EloquentColumnRepositoryInterfaces;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ColumnService
{
    private EloquentColumnRepositoryInterfaces $columnRepositoryInterfaces;

    public function __construct(EloquentColumnRepositoryInterfaces $columnRepositoryInterfaces)
    {
        $this->columnRepositoryInterfaces = $columnRepositoryInterfaces;
    }

    public function getColumnsWithTasks(): Collection
    {
        return $this->columnRepositoryInterfaces->getColumnsWithTasks();
    }

    public function storeColumn(array $data): Model
    {
        return $this->columnRepositoryInterfaces->create($data);
    }

    public function destroyColumn(int $id): bool
    {
        return $this->columnRepositoryInterfaces->destroy($id);
    }

}
