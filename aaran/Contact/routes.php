<?php

use Illuminate\Support\Facades\Route;

//Contact
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/soft', App\Livewire\Contact\SoftInstallation\Index::class)->name('soft');

    Route::get('/maintenance/{id}', App\Livewire\Contact\Maintenance\Index::class)->name('maintenance');

});
