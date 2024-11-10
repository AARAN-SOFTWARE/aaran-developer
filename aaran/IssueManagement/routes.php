<?php

use Illuminate\Support\Facades\Route;

//Issue
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/issues', App\Livewire\IssueManagement\Issue\Index::class)->name('issues');

});
