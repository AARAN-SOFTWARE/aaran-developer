<?php

namespace Aaran\Master\Database\Factories;

use Aaran\Common\Models\Common;
use Aaran\Master\Models\Contact;
use Aaran\Master\Models\ContactDetail;
use Illuminate\Database\Eloquent\Factories\Factory;


class ContactDetailFactory extends Factory
{
    protected $model = ContactDetail::class;

    public function definition(): array
    {
        $contacts = Contact::pluck('id')->random();
        $cities = Common::where('label_id','=','2')->pluck('id')->random();
        $states = Common::where('label_id','=','3')->pluck('id')->random();
        $pincodes = Common::where('label_id','=','4')->pluck('id')->random();
        $countries = Common::where('label_id','=','5')->pluck('id')->random();
        return [
            'contact_id' =>Contact::factory(),
            'address_type' => 'Primary',
            'address_1'=> $this->faker->address(),
            'address_2'=> $this->faker->address,
            'city_id' => $cities,
            'state_id' => $states,
            'pincode_id' => $pincodes,
            'country_id' => $countries,

        ];
    }
}
