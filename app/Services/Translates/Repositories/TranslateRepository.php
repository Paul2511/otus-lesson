<?php


namespace App\Services\Translates\Repositories;


use App\Models\Translate;

class TranslateRepository
{
    public function findById(int $id): Translate
    {
        return Translate::findOrFail($id);
    }

    public function create(array $data): Translate
    {
        $data = collect($data)->whereNotNull()->all();

        return Translate::create($data);
    }

    /**
     * @throws \Exception
     */
    public function delete(Translate $translate)
    {
        return $translate->delete();
    }

    public function update(Translate $translate, array $data): bool
    {
        $data = collect($data)->whereNotNull()->all();

        return $translate->update($data);
    }
}