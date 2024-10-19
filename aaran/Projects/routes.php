<?php

use Illuminate\Support\Facades\Route;

//Project
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('projects', App\Livewire\Project\Project\Index::class)->name('projects');
    Route::get('workFlows', App\Livewire\Project\WorkFlow\Index::class)->name('workFlows');

    Route::get('projects/{id}/work-flows', App\Livewire\Project\WorkFlow\Index::class)->name('projects.work-flows');

    Route::get('projectTasks', App\Livewire\Project\ProjectTask\Index::class)->name('projectTasks');
    Route::get('projectTasks/{id}/activity', App\Livewire\Project\Activity\Index::class)->name('projectTasks.activity');
    Route::get('projectTasks/{id}/show', App\Livewire\Project\ProjectTask\Show::class)->name('projectTasks.show');

});
