<?php

namespace App\Providers;

use App\Contracts\CacheServiceInterface;
use App\Http\Services\Cache\RedisCacheService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CacheServiceInterface::class, RedisCacheService::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
