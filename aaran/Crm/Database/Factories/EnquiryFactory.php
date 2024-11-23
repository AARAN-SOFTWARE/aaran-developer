<?php

namespace Aaran\Crm\Database\Factories;

use Aaran\Crm\Models\Enquiry;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Aaran\Client\Models\Payment>
 */
class EnquiryFactory extends Factory
{
    protected $model = Enquiry::class;
    public function definition(): array
    {
        return [
            'contact_id' => '1',
            'vname' => $this->faker->name,
            'body' => $this->faker->text(200),
            'status_id' => '1',
            'active_id' => '1',
        ];
    }
}
