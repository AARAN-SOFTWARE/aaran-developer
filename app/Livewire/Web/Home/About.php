<?php

namespace App\Livewire\Web\Home;

use Livewire\Component;

class About extends Component
{
    public function render()
    {
        return view('livewire.web.home.about')->layout('layouts.web');
    }
}
