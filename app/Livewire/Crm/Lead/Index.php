<?php

namespace App\Livewire\Crm\Lead;

use Aaran\Common\Models\Common;
use Aaran\Crm\Models\Enquiry;
use Aaran\Crm\Models\Lead;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Index extends Component
{
    use CommonTraitNew;

    #region[property]
    public $body;
    public mixed $status_id;
    public $lead_id;
//    public $assignee_id;
    public $enquiry_id;
    public $enquiry_data;
    public $verified_by;

    public bool $showAttemptModal = false;

    public $questions = [
        'question1' => null,
        'question2' => null,
        'question3' => null,
        'question4' => null,
        'question5' => null,
        'question6' => null,
        'question7' => null,
    ];

    #endregion


    public function create(): void
    {
        $this->redirect(route('leads.upsert', ['0']));
    }



    public function addAttempt()
    {
        $this->showAttemptModal = true;
    }

    public function getObj($id)
    {
        if ($id) {
            $obj = Lead::find($id);
            if ($obj) {
                $this->common->vid = $obj->id;
                return $obj; // Return the found object, not null
            }
        }
        return null; // Return null if no object is found
    }


    public function mount($id, $lead_id = null)
    {
        $this->enquiry_id = $id;
        $this->lead_id = $lead_id;

        if ($this->lead_id) {
            $this->getObj($this->lead_id);
        }

        $this->enquiry_data = Enquiry::find($this->enquiry_id);
    }




    #region[Render]
    public function render()
    {
//        $this->getSoftwareTypeList();
        return view('livewire.crm.lead.index')->with([
            'list' => Lead::where('enquiry_id', $this->enquiry_id)->get(),
        ]);
    }

    #endregion

}
