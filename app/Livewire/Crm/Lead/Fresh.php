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

    public $a_body;

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
                    'body' => $this->a_body,
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
                $obj->body = $this->a_body;
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
    public $showDeleteModalAddInfo = false; // Controls the modal visibility
    public $deleteId = null; // Stores the ID of the record to delete

    public function createAddInfo(): void
    {
        $this->redirect(route('leads.upsert', [0]));
    }


    public function getObjAddInfo($id)
    {
        if ($id) {
            $obj = Lead::find($id);
            if ($obj) {
            $this->vid = $obj->id;
            return $obj;
            }
        }
        return null;
    }

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
