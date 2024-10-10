<?php

namespace Aaran\Demodata\Providers;

use Illuminate\Support\ServiceProvider;

class DemodataServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->mergeConfigFrom(__DIR__ . '/../config.php','demodata');

        $this->app->register(DemodataRouteServiceProvider::class);
    }

}
