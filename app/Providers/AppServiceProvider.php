<?php

namespace App\Providers;

use App\Http\Controllers\Api\Location\Interface\LocationRepositoryInterface;
use App\Http\Controllers\Api\Location\Repository\LocationRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register() {
        $this->app->bind(LocationRepositoryInterface::class, LocationRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
