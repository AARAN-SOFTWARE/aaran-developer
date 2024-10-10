<?php

namespace App\Livewire\Sys\Artisan;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;

class Migration extends Component
{


    #region[DbMigration]
    public function clearView(): void
    {
        Artisan::call('view:clear');
    }

    public function runMigration(): void
    {
        Artisan::call('migrate');
    }

    public function runMigrationRollBack(): void
    {
        Artisan::call('migrate:rollback');
    }


    public function runMigrationFreshSeed(): void
    {
        Artisan::call('migrate:fresh --seed');
    }

    public function storageLink(): void
    {
        Artisan::call('storage:link');
    }

    public function storageUnLink(): void
    {
        Artisan::call('storage:unlink');
    }

    #endregion


    public function render()
    {
        return view('livewire.sys.artisan.migration');
    }
}
