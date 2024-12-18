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
    public $attempt_no;

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


    #region[Create-Attempt]
    public function createAttempt(): void
    {
        $this->clearFieldsAttempt();
        $this->showAttemptEditModal = true;
    }
    #endregion

    #region[Save-Attempt]
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
        $this->clearFieldsAttempt();
        $this->showAttemptEditModal = false;
    }

    #endregion

    public function editAttempt($id): void
    {
        $this->clearFieldsAttempt();
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
            $this->a_body = $obj->body;
            $this->status_id = $obj->status_id;
            $this->verified_by = $obj->verified_by;
            return $obj;
        }
        return null;
    }
    #endregion

    #region[Attempt]
    public function clearFieldsAttempt(): void
    {
        $this->aid = '';
        $this->attempt_no = '';
        $this->active_id = 1;
    }

    public function getDeleteAttempt($id): void
    {
        if ($id) {
            $this->clearFieldsAttempt();
            $this->getObjAttempt($id);
            $this->showDeleteModal = true;
        }
    }

    public function trashDataAttempt($id): void
    {
        if ($this->aid) {
            $obj = $this->getObjAttempt($this->aid);
            $obj->delete();
            $this->showDeleteModal = false;
            $this->clearFieldsAttempt();
        }
    }

    #endregion

    #region[Render]
    public function render()
    {
//        $this->getSoftwareTypeList();
        return view('livewire.crm.lead.fresh')->with(
            [
                'list' => Attempt::all(),
                'leadList' => Lead::where('enquiry_id', $this->enquiry_id)->get(),
            ]);
    }

    #endregion

    ///////-- Add Information Place--/////////
    public $vid;

    public $a_enquiry_id;

    public $a_title;

    public $a_lead_id;

    public $a_body;

    public $a_status_id;

    public $a_active_id;

    public $a_softwareType_id;

    public $a_verified_by;

    public $a_questions = [
        'question1' => null,
        'question2' => null,
        'question3' => null,
        'question4' => null,
        'question5' => null,
        'question6' => null,
        'question7' => null,
    ];

    public $showAddInfoEditModal = false;
    public $showDeleteModalAddInfo = false; // Controls the modal visibility
    public $deleteId = null; // Stores the ID of the record to delete

    ###########  Start ###############

    #region[Create-AddInfo]
    public function createAddInfo(): void
    {
        $this->clearFieldsAddInfo();
        $this->showAddInfoEditModal = true;
    }
    #endregion

    #region[Save-AddInfo]
    public function getSaveAddInfo(): string
    {
        if ($this->title != '') {

            if ($this->vid == "") {
                Lead::create([
                    'enquiry_id' => $this->a_enquiry_id,
                    'title' => $this->a_title,
                    'lead_id' => $this->a_lead_id,
                    'body' => $this->a_body,
                    'softwareType_id' => $this->a_softwareType_id,
                    'questions' => $this->a_questions,
                    'verified_by' => $this->a_verified_by,
                    'active_id'=>1,
                ]);
                $message = "Saved";

            } else {
                $obj = Lead::find($this->vid);
                $obj->enquiry_id = $this->a_enquiry_id;
                $obj->title = $this->a_title;
                $obj->lead_id = $this->a_lead_id;
                $obj->body = $this->a_body;
                $obj->softwareType_id = $this->a_softwareType_id;
                $obj->questions = $this->a_questions ;
                $obj->verified_by = $this->a_verified_by;
                $obj->active_id = $this->a_active_id;
                $obj->save();
                $message = "Updated";
            }
//            $this->desc = '';
            $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
        }
//        $this->clearFields();
        return '';
    }

    public function saveAddInfo(): void
    {
        $message = $this->getSaveAddInfo();
        session()->flash('success', '"' . $this->a_title . '"  has been' . $message . ' .');
        $this->clearFieldsAddInfo();
        $this->showAddInfoEditModal = false;
    }

    #endregion

    public function editAddInfo($id): void
    {
        $this->clearFieldsAddInfo();
        $this->getObjAddInfo($id);
        $this->showAddInfoEditModal = true;
    }

    #region[obj AddInfo]
    public function getObjAddInfo($id)
    {
        if ($id) {
            $obj = Lead::find($id);
            $this->vid = $obj->id;
            $this->a_enquiry_id = $obj->enquiry_id;
            $this->a_title = $obj->title;
            $this->a_lead_id = $obj->lead_id;
            $this->a_body = $obj->body;
            $this->a_softwareType_id = $obj->softwareType_id;
            $this->a_questions = $obj->questions;
            $this->a_verified_by = $obj->verified_by;
            $this->a_active_id = $obj->active_id;
            return $obj;
        }
        return null;
    }
    #endregion

    #region[Attempt]
    public function clearFieldsAddInfo(): void
    {
        $this->vid = '';
        $this->a_title = '';
        $this->a_active_id = 1;
    }

//    public function getDeleteAddInfo($id): void
//    {
//        if ($id) {
//            $this->clearFieldsAddInfo();
//            $this->getObjAddInfo($id);
//            $this->showDeleteModalAddInfo = true;
//        }
//    }

//    public function trashDataAddInfo($id): void
//    {
//        if ($this->aid) {
//            $obj = $this->getObjAddInfo($this->aid);
//            $obj->delete();
//            $this->showDeleteModalAddInfo = false;
//            $this->clearFieldsAddInfo();
//        }
//    }

    #endregion


//    public function getObjAddInfo($id)
//    {
//        if ($id) {
//            $obj = Lead::find($id);
//            if ($obj) {
//            $this->vid = $obj->id;
//            return $obj;
//            }
//        }
//        return null;
//    }

    #region[ Delete-AddInfo]
    public function getDeleteAddInfo($id): void
    {
        $this->deleteId = $id; // Store the ID of the record to delete
        $this->showDeleteModalAddInfo = true; // Open the modal
    }

    public function trashDataAddInfo(): void
    {
        if ($this->deleteId) {
            $obj = Lead::find($this->deleteId); // Fetch the record
            if ($obj) {
                $obj->delete(); // Delete the record
            }
        }

        $this->reset(['showDeleteModalAddInfo', 'deleteId']); // Close the modal and reset
    }
    #endregion





}
