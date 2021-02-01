<?php


namespace App\Services\Columns\Repository;


use App\Models\Column;
use App\Services\Columns\Repository\Interfaces\EloquentColumnRepositoryInterfaces;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class EloquentColumnRepository implements EloquentColumnRepositoryInterfaces
{
    public function getColumnsWithTasks(): Collection
    {
        return Column::with('tasks')->get();
    }


    public function create(array $data): Model
    {
        return Column::create($data);
    }

    public function destroy(int $id): bool
    {
        $model = Column::findOrFail($id);
        $model->delete();
        return true;
    }

}
