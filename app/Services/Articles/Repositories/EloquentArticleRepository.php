<?php


namespace App\Services\Articles\Repositories;


use App\Models\Article;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentArticleRepository
{

    public function search(int $pregPage, array $with = []): LengthAwarePaginator
    {
        $qd = Article::query();
        $qd->with($with);

        return $qd->paginate($pregPage);
    }

    public function getByNameStart(string $name, int $limit, int $offset = 0)
    {
        return Article::with('name', 'LIKE', $name . '%')
            ->take($limit)
            ->skip($offset)
            ->get();
    }

    public function findByName(string $name)
    {
        return Article::with('name', $name)->first();
    }


    public function createFromArray(array $data): Article
    {
        return Article::create($data);
    }

    public function update(Article $article, array $date): bool
    {
        return $article->update($date);
    }

    public function delete($article)
    {

        $item = Article::find((int)$article->id);

        return $item->delete();
    }
}
