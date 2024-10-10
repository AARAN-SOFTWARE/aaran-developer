<?php

namespace App\Livewire\Demo\DemoRequest;

use Aaran\Web\Models\DemoRequest;
use App\Livewire\Trait\CommonTraitNew;
use Livewire\Component;

class Index extends Component
{


    public function render()
    {
        return view('livewire.demo.demo-request.index');
    }
}
