<?php

namespace App\Livewire\Crm\Lead;

use Aaran\Crm\Models\Enquiry;
use Aaran\Crm\Models\Lead;
use App\Livewire\Trait\CommonTraitNew;
use Livewire\Component;



class Attempt extends Component
{
    use CommonTraitNew;

    public $enquiry_id;
    public $lead_id;

    public $enquiry_data;

    public function create(): void
    {
        $this->redirect(route('leads.attempt', ['0']));
    }


    public function mount($id, $lead_id = null): void
    {
        $this->enquiry_id = $id;
        $this->lead_id = $lead_id;

        if ($this->lead_id) {
            $this->getObj($this->lead_id);
        }

        $this->enquiry_data = Enquiry::find($this->enquiry_id);
    }


    public function getObj($id)
    {
        if ($id) {
            $obj = \Aaran\Crm\Models\Attempt::find($id);
            if ($obj) {
                $this->common->vid = $obj->id;
                return $obj; // Return the found object, not null
            }
        }
        return null; // Return null if no object is found
    }


    public function render()
    {
        return view('livewire.crm.lead.attempt');
    }
}
