<?php

use Illuminate\Support\Facades\Route;

//Issue
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/issues', App\Livewire\IssueManagement\Issue\Index::class)->name('issues');
    Route::get('/issues/{id}/activities', App\Livewire\IssueManagement\Issue\Activity::class)->name('issues.activities');

});
