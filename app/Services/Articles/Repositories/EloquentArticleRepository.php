<?php


namespace App\Services\Articles\Repositories;


use App\Models\Article;
use App\Services\Cache\CacheTime;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class EloquentArticleRepository
{
    const CACHE_TTL = CacheTime::MINUTE_IN_SECONDS;
    const CACHE_TAG = Article::class;

    public function find($id)
    {
        return Article::remember(self::CACHE_TTL)
            ->cacheTags(self::CACHE_TAG)
            ->find($id);
    }

    public function search(int $pregPage, array $with = []): LengthAwarePaginator
    {
        return Article::query()
            ->remember(self::CACHE_TTL)
            ->cacheTags(self::CACHE_TAG)
            ->with($with)
            ->paginate($pregPage);


    }

    public function getByNameStart(string $name, int $limit, int $offset = 0)
    {
        return Article::remember(self::CACHE_TTL)
            ->cacheTags(self::CACHE_TAG)
            ->with('name', 'LIKE', $name . '%')
            ->take($limit)
            ->skip($offset)
            ->get();
    }

    public function findByName(string $name)
    {
        return Article::remember(self::CACHE_TTL)
            ->cacheTags(self::CACHE_TAG)
            ->with('name', $name)
            ->first();


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
