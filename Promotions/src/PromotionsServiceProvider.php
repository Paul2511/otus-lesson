<?php

namespace Otuslessons\Promotions;

use \Illuminate\Support\ServiceProvider;

class PromotionsServiceProvider extends ServiceProvider {
    
    public function boot(){
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../views', 'promotions');
        $this->loadMigrationsFrom(__DIR__.'/../migrations');
    }
}
