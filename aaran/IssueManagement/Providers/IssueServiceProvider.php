<?php

namespace Aaran\IssueManagement\Providers;

use Illuminate\Support\ServiceProvider;

class IssueServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->mergeConfigFrom(__DIR__ . '/../config.php','issue-management');

        $this->app->register(IssueRouteServiceProvider::class);
    }

}
