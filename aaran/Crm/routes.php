<?php

use Illuminate\Support\Facades\Route;

//Common
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/enquiries', \App\Livewire\Crm\Enquiry\Index::class)->name('enquiries');


});
