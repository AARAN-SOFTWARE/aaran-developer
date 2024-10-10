<?php

use Illuminate\Support\Facades\Route;

//Common
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/commons/{id?}', App\Livewire\Common\CommonList::class)->name('commons');
    Route::get('/labels', App\Livewire\Common\LabelList::class)->name('labels');

    Route::get('/cities/{id}', App\Livewire\Common\Index::class)->name('cities');
    Route::get('/states/{id}', App\Livewire\Common\Index::class)->name('states');
    Route::get('/pin-codes/{id}', App\Livewire\Common\Index::class)->name('pin-codes');
    Route::get('/countries/{id}', App\Livewire\Common\Index::class)->name('countries');
    Route::get('/hsn-codes/{id}', App\Livewire\Common\Index::class)->name('hsn-codes');
    Route::get('/colours/{id}', App\Livewire\Common\Index::class)->name('colours');
    Route::get('/sizes/{id}', App\Livewire\Common\Index::class)->name('sizes');
    Route::get('/banks/{id}', App\Livewire\Common\Index::class)->name('banks');
    Route::get('/ledgers/{id}', App\Livewire\Common\Index::class)->name('ledgers');
    Route::get('/transports/{id}', App\Livewire\Common\Index::class)->name('transports');
    Route::get('/departments/{id}', App\Livewire\Common\Index::class)->name('departments');
    Route::get('/dispatches/{id}', App\Livewire\Common\Index::class)->name('dispatches');
    Route::get('/receipt-types/{id}', App\Livewire\Common\Index::class)->name('receipt-types');

    Route::get('Factory', App\Livewire\Demo\Data\Factory\Index::class)->name('Factory');
//    Route::get('productFactory', App\Livewire\Demo\Data\Product\Index::class)->name('productFactory');


});
