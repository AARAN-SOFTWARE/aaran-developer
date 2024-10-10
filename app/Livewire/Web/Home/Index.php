<?php

namespace App\Livewire\Web\Home;

use Aaran\Web\Models\Home;
use Aaran\Web\Models\HomeSlide;
use Livewire\Component;

class Index extends Component
{
    public $slides;

    public function getData(){
        $this->slides = HomeSlide::take(4)->latest()->get();
}
    public function render()
    {
        $this->getData();
        return view('livewire.web.home.index')->layout('layouts.web');
    }


}
