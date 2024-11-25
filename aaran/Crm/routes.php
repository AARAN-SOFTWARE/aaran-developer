<?php

use Illuminate\Support\Facades\Route;

//Common
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/enquiries', \App\Livewire\Crm\Enquiry\Index::class)->name('enquiries');

    Route::get('/leads/{id}', \App\Livewire\Crm\Lead\Index::class)->name('leads');


});
