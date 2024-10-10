<?php

use Illuminate\Support\Facades\Route;

//Entries
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/sales', App\Livewire\Entries\Sales\Index::class)->name('sales');
    Route::get('/sales/{id}/upsert', App\Livewire\Entries\Sales\Upsert::class)->name('sales.upsert');
    Route::get('/sales/{id}/eway', App\Livewire\Entries\Sales\EwayBill::class)->name('sales.eway');
    Route::get('/sales/{id}/einvoice', App\Livewire\Entries\Sales\Einvoice::class)->name('sales.einvoice');
    Route::get('/sales/{id}/print', App\Http\Controllers\Entries\Sales\SalesInvoiceController::class)->name('sales.print');
    Route::get('/purchases/{id}/print', App\Http\Controllers\Entries\Purchases\PurchaseInvoiceController::class)->name('purchases.print');
    Route::get('/sales/{id}/invoice', App\Http\Controllers\Entries\Sales\InvController::class)->name('sales.invoice');

    Route::get('/purchase', App\Livewire\Entries\Purchase\Index::class)->name('purchase');
    Route::get('/purchase/{id}/upsert', App\Livewire\Entries\Purchase\Upsert::class)->name('purchase.upsert');

    Route::get('/exportsales', App\Livewire\Entries\ExportSales\Index::class)->name('exportsales');
    Route::get('/exportsales/{id}/upsert', App\Livewire\Entries\ExportSales\Upsert::class)->name('exportsales.upsert');
    Route::get('/exportsales/{id}/packingList', App\Livewire\Entries\ExportSales\PackingList::class)->name('exportsales.packingList');
    Route::get('/exportsales/{id}/print', App\Http\Controllers\Entries\ExportSales\ExportInvoiceController::class)->name('exportsales.print');
    Route::get('/exportsales/{id}/packingListPrint', App\Http\Controllers\Entries\ExportSales\ExportPackingListController::class)->name('exportsales.packingListPrint');

    Route::get('transactions/{id}', App\Livewire\Entries\Payment\Index::class)->name('transactions');
    Route::get('transactions/{id}/print', App\Http\Controllers\Transaction\PaymentController::class)->name('transactions.print');

    Route::get('/receviables', App\Livewire\Reports\Statement\Receivables::class)->name('receviables');
    Route::get('/payables', App\Livewire\Reports\Statement\Payables::class)->name('payables');
    Route::get('/salesMonthly', App\Livewire\Reports\Sales\MonthlyReport::class)->name('salesMonthly');
    Route::get('/gstReport', App\Livewire\Reports\Sales\GstReport::class)->name('gstReport');

    Route::get('/receviables/print/{party}/{start_date?}/{end_date?}', App\Http\Controllers\Report\ReceivablesController::class)->name('receviables.print');
    Route::get('/payables/print/{party}/{start_date?}/{end_date?}', App\Http\Controllers\Report\PayablesController::class)->name('payables.print');

    Route::get('/monthlySalesReport/print/{month?}/{year?}', App\Http\Controllers\Report\Sales\MonthlyReportController::class)->name('monthlySalesReport.print');
    Route::get('/monthlyPurchaseReport/print/{month?}/{year?}', App\Http\Controllers\Report\Purchase\MonthlyReportController::class)->name('monthlyPurchaseReport.print');
    Route::get('/gstReport/print/{month?}/{year?}', App\Http\Controllers\Report\Sales\GstReportController::class)->name('gstReport.print');
    Route::get('/summary/print/{year?}', App\Http\Controllers\Report\Sales\SummaryController::class)->name('summary.print');

    Route::get('/contactReport/{id}/{month?}/{year?}', App\Livewire\Reports\Contact\PartyReport::class)->name('contactReport');
});
