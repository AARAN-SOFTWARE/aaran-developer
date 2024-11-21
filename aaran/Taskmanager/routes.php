<?php

use Illuminate\Support\Facades\Route;

//master
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/tasks', \App\Livewire\TaskManger\Task\Index::class)->name('tasks');
    Route::get('/myTasks/{id?}', \App\Livewire\TaskManger\Task\Index::class)->name('myTasks');
    Route::get('/openTasks/{id?}', \App\Livewire\TaskManger\Task\Index::class)->name('openTasks');
    Route::get('/allTasks/{id?}', \App\Livewire\TaskManger\Task\Index::class)->name('allTasks');

    Route::get('/tasks/{id}/upsert', \App\Livewire\TaskManger\Task\Upsert::class)->name('tasks.upsert');
//
//    Route::get('/activity', \App\Livewire\TaskManger\Activity\Index::class)->name('activity');

});
