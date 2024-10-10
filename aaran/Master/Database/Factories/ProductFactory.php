<?php

namespace Aaran\Master\Database\Factories;

use Aaran\Common\Models\Common;
use Aaran\Master\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $product_name = [
            '100% COTTON IN CHECKS FABRIC ',
            '100% Cotton Knitted Dyed Fabrics ',
            '100% Cotton Knitted Hosiery Dyed Fab (180 Gsm)'
        ];
        $users = User::pluck('id');
        $product_type = Common::where('label_id', '=', '15')->pluck('id')->random();
        $hsncodes = Common::where('label_id', '=', '6')->pluck('id')->random();
        $units = Common::where('label_id', '=', '16')->pluck('id')->random();
        $gstpercents = Common::where('label_id', '=', '17')->pluck('id')->random();

        return [
            'vname' => $product_name[array_rand($product_name)],
            'producttype_id' => $product_type,
            'hsncode_id' => $hsncodes,
            'unit_id' => $units,
            'gstpercent_id' => $gstpercents,
            'initial_quantity' => $this->faker->numberBetween(1, 100),
            'initial_price' => $this->faker->numberBetween(1, 100),
            'active_id' => '1',
            'user_id' => $users->random(),
            'company_id' => '1',

        ];
    }
}
