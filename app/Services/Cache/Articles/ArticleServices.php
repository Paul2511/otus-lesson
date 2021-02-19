<?php


namespace App\Services\Cache\Articles;


use App\Models\Article;
use App\Services\Cache\CacheServiceInterface;

class ArticleServices implements CacheServiceInterface
{

    public function clear(): void
    {
        Article::flushCache();
    }

    public function warm(): void
    {
        // TODO: Implement warm() method.
    }
}
