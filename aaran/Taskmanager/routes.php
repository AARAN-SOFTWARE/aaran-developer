<?php

use Illuminate\Support\Facades\Route;

//master
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/myTask', \App\Livewire\TaskManger\Task\Index::class)->name('myTask');
    Route::get('/task/{id}/upsert', \App\Livewire\TaskManger\Task\Upsert::class)->name('task.upsert');
    Route::get('/allTask', \App\Livewire\TaskManger\AllTask\Index::class)->name('allTask');
    Route::get('/publicTask', \App\Livewire\TaskManger\PublicTask\Index::class)->name('publicTask');
    Route::get('/activity', \App\Livewire\TaskManger\Activity\Index::class)->name('activity');

});
