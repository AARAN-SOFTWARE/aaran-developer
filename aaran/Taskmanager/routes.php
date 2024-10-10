<?php

use Illuminate\Support\Facades\Route;

//master
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/task', \App\Livewire\TaskManger\Task\Index::class)->name('task');
    Route::get('/task/{id}/upsert', \App\Livewire\TaskManger\Task\Upsert::class)->name('task.upsert');
    Route::get('/activity', \App\Livewire\TaskManger\Activity\Index::class)->name('activity');

});
