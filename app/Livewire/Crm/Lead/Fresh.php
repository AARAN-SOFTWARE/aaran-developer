<?php

namespace App\Livewire\Crm\Lead;

use Aaran\Crm\Models\Attempt;
use Aaran\Crm\Models\Enquiry;
use Aaran\Crm\Models\Lead;
use Livewire\Component;

class Fresh extends Component
{
    #region[AttemptProperty]
    public $aid;
    public $attempt_no ;

    public $lead_id;

    public $body;

    public mixed $status_id;

    public $active_id;

    public $enquiry_id;
    public $enquiry_data;
    public $verified_by;

    public bool $showAttemptEditModal = false;
    public bool $showDeleteModal = false;

    #endregion

    #region[Mount]
    public function mount($id)
    {
        // Validate enquiry_id
        $this->enquiry_id = $id;

        $this->enquiry_data = Enquiry::find($this->enquiry_id);

    }
    #endregion


    #region[Create]
    public function create(): void
    {
        $this->clearFields();
        $this->showAttemptEditModal = true;
    }
    #endregion

    #region[Save]
    public function getSaveAttempt(): string
    {
        if ($this->attempt_no != '') {

            if ($this->aid == "") {
                Attempt::create([
                    'enquiry_id' => $this->enquiry_id,
                    'attempt_no' => $this->attempt_no,
                    'lead_id' => $this->lead_id,
                    'body' => $this->body,
                    'status_id' => $this->status_id,
                    'verified_by' => $this->verified_by,
//                    'active_id'=>1,
                ]);
                $message = "Saved";

            } else {
                $obj = Attempt::find($this->aid);
                $obj->enquiry_id = $this->enquiry_id;
                $obj->attempt_no = $this->attempt_no;
                $obj->lead_id = $this->lead_id;
                $obj->body = $this->body;
                $obj->status_id = $this->status_id;
                $obj->verified_by = $this->verified_by;
//                $obj->active_id = $this->active_id;
                $obj->save();
                $message = "Updated";
            }
//            $this->desc = '';
            $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
        }
//        $this->clearFields();
        return '';
    }

    public function saveAttempt(): void
    {
        $message = $this->getSaveAttempt();
        session()->flash('success', '"' . $this->attempt_no . '"  has been' . $message . ' .');
        $this->clearFields();
        $this->showAttemptEditModal = false;
    }
    #endregion

    public function edit($id): void
    {
        $this->clearFields();
        $this->getObjAttempt($id);
        $this->showAttemptEditModal = true;
    }

    #region[obj]
    public function getObjAttempt($id)
    {
        if ($id) {
            $obj = Attempt::find($id);
            $this->aid = $obj->id;
            $this->enquiry_id = $obj->enquiry_id;
            $this->attempt_no = $obj->attempt_no;
            $this->lead_id = $obj->lead_id;
            $this->body = $obj->body;
            $this->status_id = $obj->status_id;
            $this->verified_by = $obj->verified_by;
            return $obj;
        }
        return null;
    }
    #endregion

    public function clearFields():void
    {
        $this->aid='';
        $this->attempt_no = '';
        $this->active_id = 1;
    }

    public function getDelete($id): void
    {
        if ($id) {
            $this->clearFields();
            $this->getObjAttempt($id);
            $this->showDeleteModal = true;
        }
    }

    public function trashData()
    {
        if ($this->aid) {
            $obj = $this->getObjAttempt($this->aid);
            $obj->delete();
            $this->showDeleteModal = false;
            $this->clearFields();
        }
    }

    #region[Render]
    public function render()
    {
//        $this->getSoftwareTypeList();
        return view('livewire.crm.lead.fresh')->with(
            ['list' => Attempt::all(), ]
        );
    }

    #endregion
}
