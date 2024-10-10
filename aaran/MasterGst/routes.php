<?php

use Illuminate\Support\Facades\Route;

//Demo
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/gstAuth', App\Livewire\MasterGst\Authenticate::class)->name('gstAuth');

});
