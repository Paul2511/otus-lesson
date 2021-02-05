<?php

namespace App\Providers;

use App\Models\User;
use App\Services\PetTypes\Repositories\CachePetTypeRepository;
use App\Services\PetTypes\Repositories\EloquentPetTypeRepository;
use App\Services\PetTypes\Repositories\PetTypeRepository;
use Illuminate\Support\ServiceProvider;
use Gate;
use Support\Cache\CacheHelper;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
        if (!CacheHelper::isCacheEnabled()) {
            $this->app->bind(PetTypeRepository::class, CachePetTypeRepository::class);
        } else {
            $this->app->bind(PetTypeRepository::class, EloquentPetTypeRepository::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
