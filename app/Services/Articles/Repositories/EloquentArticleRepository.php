<?php


namespace App\Services\Articles\Repositories;


use App\Models\Article;
use App\Services\Cache\CacheTime;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;


class EloquentArticleRepository
{

    public function find($id)
    {
        return Cache::remember('find_' . Article::class . '_by_id_' . $id, CacheTime::MINUTE_IN_SECONDS, function () use ($id) {
            return Article::find($id);
        });

    }

    public function search(int $pregPage, array $with = []): LengthAwarePaginator
    {
        return Cache::remember(Article::class . '_search_page_' . $pregPage . '_width_' . $with, CacheTime::MINUTE_IN_SECONDS, function () use ($pregPage, $with) {
            $qd = Article::query();
            $qd->with($with);

            return $qd->paginate($pregPage);
        });

    }

    public function getByNameStart(string $name, int $limit, int $offset = 0)
    {
        return Cache::remember('find_' . Article::class . '_by_name_start_' . $name . '_limit_' . $limit, CacheTime::MINUTE_IN_SECONDS, function () use ($offset, $limit, $name) {
            return Article::with('name', 'LIKE', $name . '%')
                ->take($limit)
                ->skip($offset)
                ->get();
        });

    }

    public function findByName(string $name)
    {
        return Cache::remember('find_' . Article::class . '_by_name_' . $name, CacheTime::MINUTE_IN_SECONDS, function () use ($name) {
            return Article::with('name', $name)->first();
        });

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
