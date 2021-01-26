<?php

namespace App\Console\Commands;

use App\Services\Users\Cache\UsersCacheService;
use App\Services\Queues\Cache\QueuesCacheService;
use App\Services\Resources\Cache\ResourcesCacheService;
use Illuminate\Console\Command;

/**
 * Class WarmCache
 * Команда для прогрева кэша
 * @package App\Console\Commands
 */
class WarmCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:warm';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Method for warming up the cache';

    private UsersCacheService $usersCacheService;
    private QueuesCacheService $queuesCacheService;
    private ResourcesCacheService $resourcesCacheService;


    public function __construct(UsersCacheService $usersCacheService,
        QueuesCacheService $queuesCacheService,
        ResourcesCacheService $resourcesCacheService)
    {
        parent::__construct();
        $this->usersCacheService = $usersCacheService;
        $this->queuesCacheService = $queuesCacheService;
        $this->resourcesCacheService = $resourcesCacheService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->warmUsers();
        $this->warmQueues();
        $this->warmResources();
    }

    /**
     * Прогреть кэш пользователей
     */
    private function warmUsers():void
    {
        $this->usersCacheService->clear();
        $this->usersCacheService->warm();
        $this->info('Users cache warmed!');
    }

    /**
     * Прогреть кэш проектов
     */
    private function warmQueues():void
    {
        $this->queuesCacheService->clear();
        $this->queuesCacheService->warm();
        $this->info('Queues cache warmed!');
    }

    /**
     * Прогреть кэш Ресурсов
     */
    private function warmResources():void
    {
        $this->resourcesCacheService->clear();
        $this->resourcesCacheService->warm();
        $this->info('Resources cache warmed!');
    }
}
