<?php

use Illuminate\Support\Facades\Route;

//Issue
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/issues', App\Livewire\IssueManagement\Issue\Index::class)->name('issues');
    Route::get('/issues/{id}/activities', App\Livewire\IssueManagement\Issue\Activity::class)->name('issues.activities');
    Route::get('/myIssues', App\Livewire\IssueManagement\MyIssue\Index::class)->name('myIssues');
    Route::get('/publicIssues', App\Livewire\IssueManagement\PublicIssue\Index::class)->name('publicIssues');
    Route::get('/allIssues', App\Livewire\IssueManagement\AllIssue\Index::class)->name('allIssues');

});
