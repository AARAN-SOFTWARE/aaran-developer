<?php

namespace App\Livewire\SoftVersion;

use App\Models\SoftVersion;
use Livewire\Component;

class Upsert extends Component
{
    public $softVersion;

    public function mount($id)
    {
        $this->softVersion = SoftVersion::find($id);
    }

    public function render()
    {
        return view('livewire.soft-version.upsert');
    }
}
