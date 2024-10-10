<?php

namespace Aaran\Master\Database\Factories;

use Aaran\Common\Models\Common;
use Aaran\Master\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    protected $model = Company::class;
    public function definition(): array
    {
        $users = User::pluck('id')->random();
        $cities = Common::where('label_id','=','2')->pluck('id')->random();
        $states = Common::where('label_id','=','3')->pluck('id')->random();
        $pincodes = Common::where('label_id','=','4')->pluck('id')->random();
        $banks = Common::where('label_id','=','9')->pluck('id')->random();

        return [
            'vname' => $this->faker->company,
            'display_name' => $this->faker->name,
            'address_1' => $this->faker->address,
//            'address_2' => $this->faker->address,
            'mobile' => $this->faker->phoneNumber,
            'landline' => $this->faker->phoneNumber,
            'gstin' => $this->faker->phoneNumber(),
            'pan' => $this->faker->creditCardNumber(),
            'email' => $this->faker->companyEmail,
            'website' => $this->faker->url,
            'city_id' => $cities,
            'state_id' => $states,
            'pincode_id' => $pincodes,
            'bank' => $banks,
            'acc_no' => $this->faker->creditCardNumber(),
            'ifsc_code' => $this->faker->creditCardNumber(),
            'branch' => $this->faker->creditCardNumber(),
            'msme_no' => $this->faker->creditCardNumber(),
            'msme_type' => $this->faker->creditCardNumber(),
            'active_id' => '1',
            'user_id' => $users,
            'tenant_id' => '1'
        ];
    }
}
