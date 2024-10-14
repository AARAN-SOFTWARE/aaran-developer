<?php

use Illuminate\Support\Facades\Route;

//Project
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('projects', App\Livewire\Project\Project\Index::class)->name('projects');
    Route::get('workFlows', App\Livewire\Project\WorkFlow\Index::class)->name('workFlows');
    Route::get('projectTasks', App\Livewire\Project\ProjectTask\Index::class)->name('projectTasks');

});
