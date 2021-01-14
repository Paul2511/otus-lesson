<?php


namespace App\Services\Columns\Repository\Interfaces;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface EloquentColumnRepositoryInterfaces
{
    public function getColumnsWithTasks(): Collection;

    public function create(array $data): Model;

    public function destroy(int $id): bool;

}
