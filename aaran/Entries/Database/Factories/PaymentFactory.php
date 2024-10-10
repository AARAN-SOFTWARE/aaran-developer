<?php

namespace Aaran\Entries\Database\Factories;

use Aaran\Common\Models\Common;
use Aaran\Entries\Models\Payment;
use Aaran\Master\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        $contact = Contact::pluck('id')->random();
        $receiptType = Common::where('label_id', '=', 14)->pluck('id')->random();
        $bank = Common::where('label_id', '=', 9)->pluck('id')->random();
        $mode = Common::where('label_id', '=', 20)->pluck('id')->random();

        return [
            'company_id' => 1,
            'acyear' => 2024-25,
            'vdate' => $this->faker->dateTimeThisMonth()->format('Y-m-d'),
            'mode' => $mode,
            'contact_id' => $contact,
            'receipttype_id' => $receiptType,
            'chq_no' => $this->faker->randomNumber(),
            'chq_date' => $this->faker->dateTimeThisMonth()->format('Y-m-d'),
            'bank_id' => $bank,
            'active_id' => 1,
        ];
    }
}
