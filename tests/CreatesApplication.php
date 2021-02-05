<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        //Проверка на верно закэшированную конфигурацию
        if (env('DB_DATABASE') !== 'default_testing') {
            echo 'Ошибочная конфигурация'.PHP_EOL;
            exit;
        }

        return $app;
    }
}
