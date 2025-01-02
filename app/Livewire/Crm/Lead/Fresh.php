<?php

namespace App\Livewire\Crm\Lead;

use Aaran\Crm\Models\Attempt;
use Aaran\Crm\Models\Enquiry;
use Aaran\Crm\Models\Lead;
use Aaran\Crm\Models\Question;
use Illuminate\Support\Facades\Config;
use Livewire\Component;
use Aaran\Common\Models\Common;
use Illuminate\Database\Eloquent\Collection;

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
        // $this->e_enquiry_id = $id;
        // $this->a_enquiry_data = Enquiry::find($this->a_enquiry_id);
        $this->softwareTypeCollection = Common::all();
        $this->getSoftwareTypeList();

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
            $this->body = $obj->body;
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
        $this->lead_id = '';
        $this->body = '';
        $this->status_id = '';
        $this->verified_by = '';
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



    ///////-- Add Information Place--/////////
    public $vid;

    public $a_enquiry_id;

    public $a_title;

    public $a_lead_id;

    public $a_body;

    public $a_status_id;

    public $a_active_id;

     public $softwareType_id;

    public $softwareType_name = '';

    public $a_verified_by;

    public $questions = [
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
        if ($this->a_title != '') {

//            $questions = Question::where('softwareType_id', $this->softwareType_id)->first();
//            $questionsJson = $questions ? json_encode($questions->question) : null;

            if ($this->vid == "") {
                Lead::create([
                    'enquiry_id' => $this->enquiry_id,
                    'title' => $this->a_title,
                    'lead_id' => $this->a_lead_id,
                    'body' => $this->a_body,
                    'softwareType_id' => $this->softwareType_id,
                    'questions' => json_encode($this->questions),
//                    'questions_id' => $questions ? $questions->id : null,
                    'verified_by' => $this->a_verified_by,
                    'active_id'=>1,
                ]);

                $message = "Saved";

            } else {
                $obj = Lead::find($this->vid);
                $obj->enquiry_id = $this->enquiry_id;
                $obj->title = $this->a_title;
                $obj->lead_id = $this->a_lead_id;
                $obj->body = $this->a_body;
                $obj->softwareType_id = $this->softwareType_id;
                $obj->questions = json_encode($this->questions);
//                $obj->questions_id = $questions ? $questions->id : null;
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
            $this->enquiry_id = $obj->enquiry_id;
            $this->a_title = $obj->title;
            $this->a_lead_id = $obj->lead_id;
            $this->a_body = $obj->body;
            $this->softwareType_id = $obj->softwareType_id;
            $this->softwareType_name = Common::find($obj->softwareType_id)->vname;
            $this->questions = json_decode($obj->questions, true);
//            $this->questions = $obj->questions ? json_decode($obj->questions->question, true) : [];
            $this->a_verified_by = $obj->verified_by;
            $this->a_active_id = $obj->active_id;
            return $obj;
        }
        return null;
    }
    #endregion

    #region[Add Info]
    public function clearFieldsAddInfo(): void
    {
        $this->vid = '';
        $this->a_title = '';
        $this->a_lead_id = '';
        $this->a_body = '';
        $this->softwareType_id = '';
        $this->softwareType_name = '';
        $this->questions = [];
        $this->a_verified_by = '';
        $this->a_active_id = 1;
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

    #region[softwareType]
    public Collection $softwareTypeCollection;
    public $highlightSoftwareType = 0;
    public $softwareTypeTyped = false;

    public function decrementSoftwareType(): void
    {
        if ($this->highlightSoftwareType === 0) {
            $this->highlightSoftwareType = count($this->softwareTypeCollection) - 1;
            return;
        }
        $this->highlightSoftwareType--;
    }

    public function incrementSoftwareType(): void
    {
        if ($this->highlightSoftwareType === count($this->softwareTypeCollection) - 1) {
            $this->highlightSoftwareType = 0;
            return;
        }
        $this->highlightSoftwareType++;
    }

    public function setSoftwareType($name, $id): void
    {
        $this->softwareType_name = $name;
        $this->softwareType_id = $id;
        $this->getSoftwareTypeList();
//        $this->loadQuestions();
    }

    public function enterSoftwareType(): void
    {
        $obj = $this->softwareTypeCollection[$this->highlightSoftwareType] ?? null;

        $this->softwareType_name = '';
        $this->softwareTypeCollection = Collection::empty();
        $this->highlightSoftwareType = 0;

        $this->softwareType_name = $obj['vname'] ?? '';
        $this->softwareType_id = $obj['id'] ?? '';
        $this->loadQuestions();
    }

    public function refreshSoftwareType($v): void
    {
        $this->softwareType_id = $v['id'];
        $this->softwareType_name = $v['name'];
        $this->softwareTypeTyped = false;
    }

    public function softwareTypeSave($name)
    {
        $obj = Common::create([
            'label_id' => 26,
            'vname' => $name,
            'active_id' => '1'
        ]);
        $v = ['name' => $name, 'id' => $obj->id];
        $this->refreshSoftwareType($v);
    }

    public function getSoftwareTypeList(): void
    {
        $this->softwareTypeCollection = $this->softwareType_name ?
            Common::search(trim($this->softwareType_name))->where('label_id', '=', '26')->get():
            Common::where('label_id', '=', '26')->orWhere('label_id', '=', '1')->get();
    }


#endregion

//    public function loadQuestions(): void
//    {
//        if ($this->softwareType_id) { $questionsRecord = Question::where('softwareType_id', $this->softwareType_id)->first();
//            $this->questions = $questionsRecord ? json_decode($questionsRecord->question, true) : []; }
//    }


    #region[Render]
    public function render()
    {
        $this->getSoftwareTypeList();
//        $this->loadQuestions();
        $questions = Question::where('softwareType_id', $this->softwareType_id)->get();

        return view('livewire.crm.lead.fresh')->with([
            'list' => Attempt::where('enquiry_id', $this->enquiry_id)->get(),
            'leadList' => Lead::where('enquiry_id', $this->enquiry_id)->get(),
            'questions' => $this->questions,
        ]);
    }

    #endregion

    public function getQuestionsProperty()
    {
        return Config::get('questions');
    }



}
