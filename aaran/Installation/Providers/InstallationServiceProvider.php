<?php

namespace Aaran\Installation\Providers;

use Illuminate\Support\ServiceProvider;

class InstallationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->mergeConfigFrom(__DIR__ . '/../config.php','installation');

        $this->app->register(InstallationRouteServiceProvider::class);
    }

}
