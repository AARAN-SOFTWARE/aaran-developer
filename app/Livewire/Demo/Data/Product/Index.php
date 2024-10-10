<?php

namespace App\Livewire\Demo\Data\Product;

use Aaran\Common\Models\Common;
use Aaran\Master\Models\Product;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public function loadDummy()
    {
        $this->Product();
    }

    private function Product()
    {
        $product_name = [
            '100% Cotton Hosier Fabric',
            '100% Cotton Knitted Dyed Fabric ',
            '100% Cotton Pique Dyed Fabric ',
            '100% Cotton T-shirt',
            '100% Cotton Jogger Pant',
            '100% Cotton Polo T-shirt',
            '100% Cotton Men s Collar T-shirt',
            '100% Cotton Women s Collar T-shirt',
            '100% Cotton Round Neck T-shirt',
            '100% Cotton V Neck T-shirt',
            '20s Combed Cotton Yarn',
            '30s Combed Cotton Yarn',
            '25s Combed Cotton Yarn',
            '30s Semi Combed Cotton Yarn',
            '40 x 25 Walz Sticker',
            '100 x 150 mm Sticker',
            'A8 Carton Silp',
            'Atex Recycled Satin Label',
            'Barcode Label',
            'Bed black',
            'Brand Name Sticker',
            'Canada Carton Silp',
            'Carton Ratio Silps',
            'Casino Design',
            'Color Changeprint Sticker',
            'Bed Plate & Design',
            'ColorKid Sample Sticker',
            'Coton E-173 Cut&Fold',
            'Cotton Page',
            'Courier Charge',
            'Crazy Jack Watch Care Label',
            'Minymo Loop',
            'Month Sticker Black',
            'More Hang Tag',
            'Salzer Design Charge',
            'Sareey box step',
            'SASTI 4 COLOR FOLD CARD',
            'Transprint Size Sticker',
            'UNREAL LABEL 2 COLOR',
            'Tag String',
            'Topitm Black Satin Cutsel Screen print',
            'Topitm Tag',
            'Varthman Box Month Change To Plate',
            'Walz Carton Silp',
            'Warning Transprint Sticker',
            'ERNIE BRANISTER COTTON LABEL',
            'LABEL ROLL',
            'SUPER CROMO',
            'SSD',
            'FILA STICKER COLOR AND WHITE',
            'Recycled Satin Fixoni',
            'Latter Pad Multi Color 1 book 105 Copies',
            'LDP COLOR STICKER',
            'Kela Wash Care Label Front & Back Ultrasonic',
            'Kurinji Metro 2 color Design And Varnam 2 color',
            'Kela Recycle Label'

        ];

        for ($i = 0; $i < count($product_name); $i++) {

            $users = User::pluck('id');
            $product_type = Common::where('label_id','=','15')->pluck('id')->random();
            $hsncodes = Common::where('label_id', '=', '6')->pluck('id')->random();
            $units = Common::where('label_id', '=', '16')->pluck('id')->random();
            $gstpercents = Common::where('label_id', '=', '17')->pluck('id')->random();

            Product::create([
                'vname' => $product_name[$i],
                'producttype_id' => $product_type,
                'hsncode_id' => $hsncodes,
                'unit_id' => $units,
                'gstpercent_id' => $gstpercents,
                'initial_quantity' => fake()->numberBetween(0,999) ,
                'initial_price' => fake()->numberBetween(0,999),
                'active_id' => '1',
                'user_id' => $users->random(),
                'company_id' => '1',
            ]);
        }
        $successMessage = 'Product Create Successfully.';
        $this->dispatch('notify', ...['type' => 'success', 'content' => $successMessage]);
    }

    public function render()
    {
        return view('livewire.demo.data.product.index');
    }
}
