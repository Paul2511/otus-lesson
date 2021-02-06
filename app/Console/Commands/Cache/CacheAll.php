<?php

namespace App\Console\Commands\Cache;

use Illuminate\Console\Command;
use Support\Log\LogHelper;

class CacheAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:all';


    protected $name = 'cache-all';

    private static $commands = [
        'cache:clear' => [],
        'event:cache' => [],
        'optimize' => [], //config, route, files
        //'view:cache' => [] - не нужно в случае SPA на vue
    ];

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear and cached all system cache';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach (self::$commands as $command=>$arguments) {
            $result = $this->callSilently($command, $arguments);
            $message = "The command {$command} was ";
            if ($result === 0) {
                $message .= "executed successfully";
                $level = 'info';
            } else {
                $message .= "interrupted with errors";
                $level = 'error';
            }
            LogHelper::schedule($message, $level);
        }

        return 0;
    }
}
