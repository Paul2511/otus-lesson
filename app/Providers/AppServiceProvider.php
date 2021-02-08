<?php

namespace App\Providers;

use App\Services\PetTypes\Repositories\CachePetTypeRepository;
use App\Services\PetTypes\Repositories\EloquentPetTypeRepository;
use App\Services\PetTypes\Repositories\PetTypeRepository;
use App\Services\Specializations\Repositories\CacheSpecializationRepository;
use App\Services\Specializations\Repositories\EloquentSpecializationRepository;
use App\Services\Specializations\Repositories\SpecializationRepository;
use Illuminate\Support\ServiceProvider;
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
            $this->app->bind(SpecializationRepository::class, CacheSpecializationRepository::class);
        } else {
            $this->app->bind(PetTypeRepository::class, EloquentPetTypeRepository::class);
            $this->app->bind(SpecializationRepository::class, EloquentSpecializationRepository::class);
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
