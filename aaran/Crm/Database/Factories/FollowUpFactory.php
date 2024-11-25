<?php

namespace Aaran\Crm\Database\Factories;

use Aaran\Crm\Models\FollowUp;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Aaran\Client\Models\Payment>
 */
class FollowUpFactory extends Factory
{
    protected $model = FollowUp::class;
    public function definition(): array
    {
        return [
            'lead_id' => '1',
            'vname' => $this->faker->name,
            'body' => $this->faker->text(200),
            'action' => $this->faker->text(40),
            'status_id' => '1',
            'priority_id' => '1',
            'active_id' => '1',
        ];
    }
}
