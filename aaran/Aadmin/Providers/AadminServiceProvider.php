<?php

namespace Aaran\Aadmin\Providers;

use Illuminate\Support\ServiceProvider;

class AadminServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->mergeConfigFrom(__DIR__ . '/../config.php','aadmin');
        $this->mergeConfigFrom(__DIR__ . '/../software.php', 'software');
        $this->mergeConfigFrom(__DIR__ . '/../clients.php', 'clients');

        $this->mergeConfigFrom(__DIR__ . '/../Softwares/developer.php', 'developer');


        $this->app->register(AadminRouteServiceProvider::class);
    }

}
