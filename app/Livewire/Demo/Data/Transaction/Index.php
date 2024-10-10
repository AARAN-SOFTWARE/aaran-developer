<?php

namespace App\Livewire\Demo\Data\Transaction;

use Aaran\Common\Models\Common;
use Aaran\Master\Models\Company;
use Aaran\Master\Models\Contact;
use Aaran\Master\Models\Order;
use Aaran\Transaction\Models\Transaction;
use Livewire\Component;

class Index extends Component
{
    public $count = 25;

    public function loadDummy()
    {
        $this->Transaction();
    }

    private function Transaction()
    {
        for ($i = 0; $i < $this->count; $i++) {
            $contact = Contact::pluck('id')->random();
            $company = Company::pluck('id')->random();
            $order = Order::pluck('id')->random();
            $trans_type = Common::where('label_id', '=', '19')->pluck('id')->random();
            $mode = Common::where('label_id', '=', '20')->pluck('id')->random();
            if ($trans_type == 108) {
                $receipttype = 85;
            } else {
                $receipttype = Common::where('label_id', '=', '14')->where('id', '!=', '85')->pluck('id')->random();
            }
            $bank = Common::where('label_id', '=', '9')->pluck('id')->random();

            Transaction::create([
                'acyear' => session()->get('acyear'),
                'company_id' => $company,
                'contact_id' => $contact,
                'paid_to' => '-',
                'order_id' => $order,
                'trans_type_id' => $trans_type,
                'mode_id' => $mode,
                'vdate' => date('Y-m-d'),
                'vname' => fake()->numberBetween(1, 1000),
                'receipttype_id' => $receipttype,
                'remarks' => '-',
                'chq_no' => fake()->numberBetween(1, 1000),
                'chq_date' => date('Y-m-d'),
                'bank_id' => $bank,
                'deposit_on' => date('Y-m-d'),
                'realised_on' => date('Y-m-d'),
                'against_id' => '1',
                'verified_by' => '-',
                'verified_on' => date('Y-m-d'),
                'ref_no' => fake()->numberBetween(1, 100),
                'ref_amount' => fake()->numberBetween(1, 10000),
                'user_id' => auth()->id(),
                'active_id' => 1,


            ]);

        }
        $successMessage = 'Transaction Create Successfully.';
        $this->dispatch('notify', ...['type' => 'success', 'content' => $successMessage]);
    }

    public function render()
    {
        return view('livewire.demo.data.transaction.index');
    }
}
