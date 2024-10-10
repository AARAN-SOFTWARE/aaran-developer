<?php

namespace Aaran\MasterGst\Providers;

use Illuminate\Support\ServiceProvider;

class MasterGstServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->mergeConfigFrom(__DIR__ . '/../config.php','common');

        $this->app->register(MasterGstRouteServiceProvider::class);
    }

}
