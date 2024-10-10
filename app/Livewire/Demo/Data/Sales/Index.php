<?php

namespace App\Livewire\Demo\Data\Sales;

use Aaran\Common\Models\Common;
use Aaran\Entries\Models\Sale;
use Aaran\Entries\Models\Saleitem;
use Aaran\Master\Models\Company;
use Aaran\Master\Models\Contact;
use Aaran\Master\Models\ContactDetail;
use Aaran\Master\Models\Order;
use Aaran\Master\Models\Product;
use Aaran\Master\Models\Style;
use Livewire\Component;

class Index extends Component
{

    public $count = 25;

    public function loadDummy()
    {
        $this->Sale();
    }

    private function Sale()
    {
        for ($i = 0; $i < $this->count; $i++) {

            $contact = Contact::pluck('id')->random();
            $company = Company::pluck('id')->random();
            $order = Order::pluck('id')->random();
            $billing = ContactDetail::where('contact_id', '=', $contact)->pluck('id')->random();
            $shipping = ContactDetail::where('contact_id', '=', $contact)->pluck('id')->random();
            $style = Style::pluck('id')->random();
            $despatch = Common::where('label_id', '=', '1')->pluck('id')->random();
            $transport = '122';
            $product = Product::pluck('id')->random();
            $colour = Common::where('label_id', '=', '7')->pluck('id')->random();
            $size = Common::where('label_id', '=', '8')->pluck('id')->random();
            $this->quantity = substr(str_shuffle("0123456789"), 0, 4);
            $this->price = substr(str_shuffle("0123456789"), 0, 2);
            $distance = substr(str_shuffle("0123456789"), 0, 2);
            $this->gst_percent = Common::find(Product::find($product)->gstpercent_id)->vname;
            $salesValue = $this->calculateTotal();
            $invoice_no = Sale::nextNo();

            $obj = Sale::create([
                'uniqueno' => session()->get('company_id') . '~' . session()->get('acyear') . '~' . Sale::nextNo(),
                'acyear' => session()->get('acyear'),
                'company_id' => $company,
                'contact_id' => $contact,
                'invoice_no' => $invoice_no,
                'invoice_date' => date('Y-m-d'),
                'sales_type' => '1',
                'order_id' => $order,
                'billing_id' => $billing,
                'shipping_id' => $shipping,
                'style_id' => $style,
                'despatch_id' => $despatch,
                'job_no' => '',
                'transport_id' => $transport,
                'destination' => '-',
                'bundle' => '-',
                'distance' => $distance,
                'TransMode' => '1',
                'Transid' => '1',
                'Transname' => '-',
                'Transdocno' => $invoice_no,
                'TransdocDt' => date('Y-m-d'),
                'Vehno' => 'ka123456',
                'Vehtype' => 'R',
                'total_qty' => $salesValue['total_quantity'],
                'total_taxable' => $salesValue['total_taxable'],
                'total_gst' => $salesValue['total_gst'],
                'ledger_id' => '1',
                'additional' => '0',
                'grand_total' => $salesValue['grand_total'],
                'received_by' => 'office',
                'active_id' => 1,

            ]);

            Saleitem::create([
                'sale_id' => $obj->id,
                'po_no' => '-',
                'dc_no' => '-',
                'no_of_roll' => '-',
                'product_id' => $product,
                'colour_id' => $colour,
                'size_id' => $size,
                'qty' => $this->quantity,
                'price' => $this->price,
                'gst_percent' => $this->gst_percent,
            ]);
        }
        $successMessage = 'Sale Create Successfully.';
        $this->dispatch('notify', ...['type' => 'success', 'content' => $successMessage]);

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

        ];

    }


    public function render()
    {
        return view('livewire.demo.data.sales.index');
    }
}
