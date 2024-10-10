<?php

namespace Aaran\Taskmanager\Providers;

use Illuminate\Support\ServiceProvider;

class TaskmanagerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->mergeConfigFrom(__DIR__ . '/../config.php','taskmanager');

        $this->app->register(TaskmanagerRouteServiceProvider::class);
    }

}
