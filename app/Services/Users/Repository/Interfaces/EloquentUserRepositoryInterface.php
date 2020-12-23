<?php


namespace App\Services\Users\Repository\Interfaces;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

interface EloquentUserRepositoryInterface
{
    public function search(): LengthAwarePaginator;

    public function findOrFail(int $id): Model;

    public function create(array $data): Model;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;

}
