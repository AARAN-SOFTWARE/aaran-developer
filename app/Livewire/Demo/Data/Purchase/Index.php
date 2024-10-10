<?php

namespace App\Livewire\Demo\Data\Purchase;

use Aaran\Common\Models\Common;
use Aaran\Entries\Models\Purchase;
use Aaran\Entries\Models\Purchaseitem;
use Aaran\Master\Models\Company;
use Aaran\Master\Models\Contact;
use Aaran\Master\Models\Order;
use Aaran\Master\Models\Product;
use Livewire\Component;

class Index extends Component
{
    public $count = 25;

    public function loadDummy()
    {
        $this->Purchase();
    }

    private function Purchase()
    {
        for ($i = 0; $i < $this->count; $i++) {

            $contact = Contact::pluck('id')->random();
            $company = Company::pluck('id')->random();
            $order = Order::pluck('id')->random();
            $product = Product::pluck('id')->random();
            $transport = Common::where('label_id', '=', '1')->pluck('id')->random();
            $colour = Common::where('label_id', '=', '7')->pluck('id')->random();
            $size = Common::where('label_id', '=', '8')->pluck('id')->random();
            $this->quantity = substr(str_shuffle("0123456789"), 0, 4);
            $this->price = substr(str_shuffle("0123456789"), 0, 2);
            $this->gst_percent = Common::find(Product::find($product)->gstpercent_id)->vname;
            $purchaseValue = $this->calculateTotal();

            $obj = Purchase::create([
                'uniqueno' => session()->get('company_id') . '~' . session()->get('acyear') . '~' . Purchase::nextNo(),
                'acyear' => session()->get('acyear'),
                'company_id' => $company,
                'contact_id' => $contact,
                'order_id' => $order,
                'purchase_no' => fake()->numberBetween(1, 9),
                'purchase_date' => date('Y-m-d'),
                'Entry_no' =>Purchase::nextNo() ,
                'sales_type' => '1',
                'transport_id' => $transport,
                'ledger_id'=>1,
                'bundle' => '1',
                'total_qty' => $purchaseValue['total_quantity'],
                'total_taxable' => $purchaseValue['total_taxable'],
                'total_gst' => $purchaseValue['total_gst'],
                'grand_total' => $purchaseValue['grand_total'],
                'additional'=>0,
                'round_off'=>0,
                'active_id' => 1,

            ]);

            Purchaseitem::create([
                'purchase_id' => $obj->id,
                'product_id' => $product,
                'colour_id' => $colour,
                'size_id' => $size,
                'qty' => $this->quantity,
                'price' => $this->price,
                'gst_percent' => $this->gst_percent,

            ]);
        $this->contactUpdate($contact,$obj->grand_total);
        }
        $successMessage = 'Purchase Create Successfully.';
        $this->dispatch('notify', ...['type' => 'success', 'content' => $successMessage]);
    }

    public function contactUpdate($contact,$total)
    {
        $obj=Contact::find($contact);
        $outstanding= ($obj->contact_type_id==124?$obj->outstanding-$total:$obj->outstanding+$total);
        $obj->outstanding=$outstanding;
        $obj->save();
    }

    public $quantity;
    public $price;
    public $gst_percent;
    public $additional = 0;

    public function calculateTotal()
    {

        $total_qty = round(floatval($this->quantity), 3);
        $total_taxable = round(floatval($this->quantity * $this->price), 2);
        $total_gst = round(floatval(($this->quantity * $this->price) * $this->gst_percent / 100), 2);
        $grandtotalBeforeRound = round(floatval($this->quantity * $this->price + (($this->quantity * $this->price) * $this->gst_percent / 100)), 2);

        $grand_total = round($grandtotalBeforeRound);
        $round_off = $grandtotalBeforeRound - $grand_total;

        if ($grandtotalBeforeRound > $grand_total) {
            $round_off = round($round_off, 2) * -1;
        }
        $this->quantity = round(floatval($this->quantity), 3);
        $total_taxable = round(floatval($total_taxable), 2);
        $total_gst = round(floatval($total_gst), 2);
        $round_off = round(floatval($round_off), 2);
        $grand_total = round((floatval($grand_total)) + (floatval($this->additional)), 2);

        return [
            'total_quantity' => $total_qty,
            'total_taxable' => $total_taxable,
            'total_gst' => $total_gst,
            'round_off' => $round_off,
            'grand_total' => $grand_total,
            ''
        ];

    }

    public function render()
    {
        return view('livewire.demo.data.purchase.index');
    }
}
