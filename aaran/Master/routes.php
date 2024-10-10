<?php

use Illuminate\Support\Facades\Route;

//Master
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/products', App\Livewire\Master\Product\Index::class)->name('products');

    Route::get('/contacts', App\Livewire\Master\Contact\Index::class)->name('contacts');
    Route::get('/contacts/{id}/upsert', App\Livewire\Master\Contact\Upsert::class)->name('contacts.upsert');

    Route::get('/companies', App\Livewire\Master\Company\Index::class)->name('companies');

    Route::get('/orders', App\Livewire\Master\Orders\Index::class)->name('orders');

    Route::get('/styles', App\Livewire\Master\Style\Index::class)->name('styles');

});
