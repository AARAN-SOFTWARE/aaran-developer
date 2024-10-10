<?php

namespace Aaran\Common\Database\Factories;

use Aaran\Common\Models\Common;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommonFactory extends Factory
{
    protected $model = Common::class;

    public function definition(): array
    {
        return [
            'vname' => $this->faker->name,
            'desc' => $this->faker->bothify(),
            'desc_1' => $this->faker->bothify(),
            'active_id' => 1
        ];
    }
}
