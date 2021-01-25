<?php


namespace App\Services\Interfaces;


interface BaseRepositoryInterface
{
    public function createByArray(array $data);

    public function updateByArray(array $data,int $id);

    public function deleteById(int $id);

    public function findById(int $id);
}
