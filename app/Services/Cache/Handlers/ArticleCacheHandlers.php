<?php


namespace App\Services\Cache\Handlers;


use App\Models\Article;
use App\Services\Cache\Articles\ArticleServices;

class ArticleCacheHandlers
{


    private ArticleServices $articleServices;

    public function __construct(ArticleServices $articleServices)
    {

        $this->articleServices = $articleServices;
    }

    public function created(Article $article)
    {
        $this->articleServices->clear();
    }

    public function updated(Article $article)
    {
        $this->articleServices->clear();
    }


    public function deleted(Article $article)
    {
        $this->articleServices->clear();
    }


    public function restored(Article $article)
    {
        $this->articleServices->clear();
    }

    public function forceDeleted(Article $article)
    {
        $this->articleServices->clear();
    }
}
