<?php

use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/homeslides', App\Livewire\Web\Slide\Index::class)->name('homeslides');
    Route::get('/demorequest', App\Livewire\Common\DemoRequest\Index::class)->name('demorequest');
    Route::get('/todo', App\Livewire\Web\Todo\Index::class)->name('todo');
});
