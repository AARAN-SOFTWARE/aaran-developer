<?php

namespace App\Livewire\Web\Home;

use Livewire\Component;

class Info extends Component
{
    public function render()
    {
        return view('livewire.web.home.info')->layout('layouts.web');
    }
}
