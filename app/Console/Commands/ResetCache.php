<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use App\Service\KnowledgeService;

class ResetCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appcache:reset';
    protected $knowledgeService;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cache reseter';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(KnowledgeService $knowledgeService)
    {
        parent::__construct();
        $this->knowledgeService = $knowledgeService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->knowledgeService->updateKnowledgeCache();
        $this->knowledgeService->getCachedKnowledges();
    }
}
