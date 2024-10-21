<?php

use Illuminate\Support\Facades\Route;

//master
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('demo', App\Livewire\Demo\Index::class)->name('demo');


});
