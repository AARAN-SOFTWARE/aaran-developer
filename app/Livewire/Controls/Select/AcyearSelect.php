<?php

namespace App\Livewire\Controls\Select;

use Aaran\Common\Models\Common;
use App\Models\DefaultCompany;
use Livewire\Component;

class AcyearSelect extends Component
{
    public mixed $acyear;
    public $years;

    public function changeAcyear()
    {
        if ($this->acyear) {
            session()->put('acyear', $this->acyear);

            $obj = DefaultCompany::find(1);
            $obj->acyear = session()->get('acyear');
            $obj->save();
        }
    }

    public function mount()
    {
        $defaultAcyear = DefaultCompany::find('1');
        $this->acyear = $defaultAcyear->acyear;
    }

    public function render()
    {
        $this->years=Common::where('label_id',21)->orderBy('vname','asc')->get();
        return view('livewire.controls.select.acyear-select');
    }
}
