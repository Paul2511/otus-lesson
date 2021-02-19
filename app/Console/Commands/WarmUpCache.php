<?php


namespace App\Console\Commands;


use App\Services\Cache\Articles\ArticleServices;
use Illuminate\Console\Command;

class WarmUpCache extends Command
{

    protected $signature = 'cache:warm';

    protected $description = 'The method warms up the cache of models';
    /**
     * @var ArticleServices
     */
    private ArticleServices $articleServices;

    public function __construct(ArticleServices $articleServices)
    {
        parent::__construct();
        $this->articleServices = $articleServices;
    }

    public function handle()
    {
        $this->warmArticles();
    }

    private function warmArticles(): void
    {
        $this->articleServices->clear();
        $this->articleServices->warm();
        $this->info('Article cache warmed!');
    }
}
