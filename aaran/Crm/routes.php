<?php

use App\Livewire\Crm\Enquiry\Index;
use Illuminate\Support\Facades\Route;

//Common
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/enquiries', Index::class)->name('enquiries');
    Route::get('/leads/{id}', \App\Livewire\Crm\Lead\Index::class)->name('leads');
    Route::get('/followups/{id}', \App\Livewire\Crm\FollowUp\Index::class)->name('followups');

    Route::get('/logbooks', \App\Livewire\Crm\LogBook\Index::class)->name('logbooks');

//    Route::get('enquiries-upsert/{id}', App\Livewire\Crm\Enquiry\Upsert::class)->name('enquiries.upsert');

    Route::get('leads-upsert/{id}', App\Livewire\Crm\Lead\Upsert::class)->name('leads.upsert');

    Route::get('leads-attempt', App\Livewire\Crm\Lead\Attempt::class)->name('leads.attempt');

    Route::get('leads-fresh/{id}', App\Livewire\Crm\Lead\Fresh::class)->name('leads.fresh');

});
