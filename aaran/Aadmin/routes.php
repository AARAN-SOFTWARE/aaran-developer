<?php

use Illuminate\Support\Facades\Route;

//master
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

//    Route::get('/styles', \App\Livewire\Orders\Style\Club::class)->name('styles');

});
