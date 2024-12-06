<?php

use App\Livewire\Crm\Enquiry\Index;
use Illuminate\Support\Facades\Route;

//Common
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/enquiries', Index::class)->name('enquiries');
    Route::get('/leads/{id}', \App\Livewire\Crm\Lead\Index::class)->name('leads');
    Route::get('/followups/{id}', \App\Livewire\Crm\FollowUp\Index::class)->name('followups');

    Route::get('/logbooks', \App\Livewire\Crm\LogBook\Index::class)->name('logbooks');

    Route::get('enquiries-upsert/{id}', App\Livewire\Crm\Enquiry\Upsert::class)->name('enquiries.upsert');


});
