<?php

namespace App\Livewire\Web\Dashboard;

use Aaran\Blog\Models\Post;
use Aaran\Entries\Models\Purchase;
use Aaran\Entries\Models\Sale;
use Aaran\Master\Models\Contact;
use Aaran\Master\Models\Product;
use Aaran\Transaction\Models\Transaction;
use App\Helper\ConvertTo;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    use CommonTraitNew;

    public $transactions;
    public $entries;
    public $contacts;
    public $blogs;
    public $user;


    public function mount()
    {
        $this->transactions = $this->getTransactions();
        $this->entries = $this->getEntries();

    }

    public function getTransactions()
    {
        $first = date('Y-m-01');
        $last = date('Y-m-t');

        $total_sales = Sale::select(
            DB::raw("SUM(grand_total) as grand_total"),
        )
            ->where('acyear', '=', session()->get('acyear'))
            ->where('company_id', '=', session()->get('company_id'))
            ->firstOrFail();

        $month_sales = Sale::select(
            DB::raw("SUM(grand_total) as grand_total"),
        )->where('acyear', '=', session()->get('acyear'))
            ->WhereBetween('invoice_date', [$first, $last])
            ->where('company_id', '=', session()->get('company_id'))
            ->firstOrFail();

        $total_purchase = Purchase::select(
            DB::raw("SUM(grand_total) as grand_total"),
        )->where('acyear', '=', session()->get('acyear'))
            ->where('company_id', '=', session()->get('company_id'))
            ->firstOrFail();

        $month_purchase = Purchase::select(
            DB::raw("SUM(grand_total) as grand_total"),
        )->where('acyear', '=', session()->get('acyear'))
            ->where('company_id', '=', session()->get('company_id'))
            ->WhereBetween('purchase_date', [$first, $last])
            ->firstOrFail();

        $total_receivable = Transaction::select(
            DB::raw("SUM(vname) as receipt_amount"),
        )->where('acyear', '=', session()->get('acyear'))
            ->where('mode_id', '=', 111)
            ->where('company_id', '=', session()->get('company_id'))
            ->firstOrFail();

        $month_receivable = Transaction::select(
            DB::raw("SUM(vname) as receipt_amount"),
        )->where('acyear', '=', session()->get('acyear'))
            ->where('mode_id', '=', 111)
            ->WhereBetween('vdate', [$first, $last])
            ->where('company_id', '=', session()->get('company_id'))
            ->firstOrFail();

        $total_payable = Transaction::select(
            DB::raw("SUM(vname) as payment_amount"),
        )->where('acyear', '=', session()->get('acyear'))
            ->where('mode_id', '=', 110)
            ->where('company_id', '=', session()->get('company_id'))
            ->firstOrFail();

        $month_payable = Transaction::select(
            DB::raw("SUM(vname) as payment_amount"),
        )->where('acyear', '=', session()->get('acyear'))
            ->where('mode_id', '=', 110)
            ->where('company_id', '=', session()->get('company_id'))
            ->WhereBetween('vdate', [$first, $last])
            ->firstOrFail();

        return Collection::make([
            'total_sales' => ConvertTo::rupeesFormat($total_sales->grand_total ?? 0 ),
            'month_sales' => ConvertTo::rupeesFormat($month_sales->grand_total ?? 0),
            'total_purchase' => ConvertTo::rupeesFormat($total_purchase->grand_total ?? 0 ),
            'month_purchase' => ConvertTo::rupeesFormat($month_purchase->grand_tota ?? 0 ),
            'total_receivable' => ConvertTo::rupeesFormat($total_receivable->receipt_amount ?? 0 ),
            'month_receivable' => ConvertTo::rupeesFormat($month_receivable->receipt_amount ?? 0 ),
            'total_payable' => ConvertTo::rupeesFormat($total_payable->payment_amount ?? 0 ),
            'month_payable' => ConvertTo::rupeesFormat($month_payable->payment_amount ?? 0),
            'net_profit' => ConvertTo::rupeesFormat($total_sales->grand_total - $total_purchase->grand_total ?? 0),
            'month_profit' => ConvertTo::rupeesFormat($month_sales->grand_total - $month_purchase->grand_total ?? 0),
        ]);
    }

    public function getEntries()
    {
        $sales = Sale::latest()->first();
        $purchase = Purchase::latest()->first();
        $payment = Transaction::latest()->where('mode_id', '=', 110)->first();
        $receipt = Transaction::latest()->where('mode_id', '=', 111)->first();

        return Collection::make([
            'sales' => ConvertTo::rupeesFormat($sales->grand_total ?? 0),
            'sales_no' => $sales->invoice_no ?? 0,
            'sales_date' => $sales->invoice_date ?? '-',
            'purchase' => ConvertTo::rupeesFormat($purchase->grand_total ?? 0),
            'purchase_no' => $purchase->purchase_no ?? 0,
            'purchase_date' => $purchase->purchase_date ?? '-',
            'payment' => ConvertTo::rupeesFormat($payment->vname ?? 0),
            'payment_date' => $payment->vdate ?? '-',
            'receipt' => ConvertTo::rupeesFormat($receipt->vname ??0),
            'receipt_date' => $receipt->vdate ?? '-',
        ]);
    }

    public function getCustomer($id)
    {
        $openingbalance = Contact::find($id)->opening_balance;

        $sales = Sale::select(DB::raw("SUM(grand_total) as grand_total"))
            ->where('contact_id', '=', $id)
            ->where('company_id', '=', session()->get('company_id'))
            ->firstOrFail();

        $transactions = Transaction::select(DB::raw("SUM(vname) as receipt_total"))
            ->where('contact_id', '=', $id)
            ->where('company_id', '=', session()->get('company_id'))
            ->where('mode_id', '=', 111)
            ->firstOrFail();

        return $sales->grand_total - $transactions->receipt_total + $openingbalance;
    }

    public function getContact()
    {
        $this->contacts = Contact::all();
    }

    public function getBlog()
    {
        $this->blogs = Post::latest()->get();
    }



    public function render()
    {
        $this->getContact();
        $this->getBlog();

        return view('livewire.web.dashboard.index');
    }
}
