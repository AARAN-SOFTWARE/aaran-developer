<?php

use Illuminate\Support\Facades\Route;

//master
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('demo', App\Livewire\Demo\Index::class)->name('demo');

    Route::get('contactFactory', App\Livewire\Demo\Data\Contact\Index::class)->name('contactFactory');
    Route::get('saleFactory', App\Livewire\Demo\Data\Sales\Index::class)->name('saleFactory');
    Route::get('productFactory', App\Livewire\Demo\Data\Product\Index::class)->name('productFactory');
    Route::get('purchaseFactory', App\Livewire\Demo\Data\Purchase\Index::class)->name('purchaseFactory');
    Route::get('transactionFactory', App\Livewire\Demo\Data\Transaction\Index::class)->name('transactionFactory');

});
