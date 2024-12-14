<?php

namespace App\Livewire\Crm\Lead;

use Aaran\Common\Models\Common;
use Aaran\Crm\Models\Enquiry;
use Aaran\Crm\Models\Lead;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Upsert extends Component
{
    use CommonTraitNew;

    #region[property]
    public $body;
    public $lead_id;
//    public $assignee_id;
    public $enquiry_id;
    public $enquiry_data;
    public $verified_by;

//    public $status_id;

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

    #region[Rules]
    public function rules(): array
    {
        return [
            'common.vname' => 'required|min:3',
            'body' => 'required|min:5',
            'questions.question1' => 'nullable|string',
            'questions.question2' => 'nullable|string',
            'questions.question3' => 'nullable|string',
            'questions.question4' => 'nullable|string',
            'questions.question5' => 'nullable|string',
            'questions.question6' => 'nullable|string',
            'questions.question7' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'common.vname.required' => ' Mention The :attribute',
            'body.required' => ' :attribute is required. ',

        ];
    }

    public function validationAttributes()
    {
        return [
            'common.vname' => 'Lead',
            'body' => 'Description',
        ];
    }
    #endregion

    #region[Mount]
    public function mount($id)
    {
        if ($id != 0) {
            $obj = Lead::find($id);
            $this->common->vid = $obj->id;
            $this->enquiry_id = $obj->enquiry_id;
            $this->common->vname = $obj->vname;
//            $this->assignee_id = $obj->assignee_id;
            $this->lead_id = $obj->lead_id;
            $this->body = $obj->body;
            $this->softwareType_id = $obj->softwareType_id;
            $this->questions = $obj->questions;
            $this->verified_by = $obj->verified_by;

    }
    }
    #endregion

    #region[getSave]
    public function save()
    {
        $this->validate($this->rules());

        if ($this->common->vid == '') {

            $lead = new Lead();

            $extraFields = [
                'enquiry_id' => $this->enquiry_id ?: 1,
                'body' => $this->body,
                'lead_id' => $this->lead_id ?: 1,
//                'assignee_id' => $this->assignee_id ?: 1,
                'softwareType_id' => $this->softwareType_id ?: 1,
//                'user_id' => auth()->id(),
                'questions' => json_encode($this->questions),
//                'status_id' => $this->status_id ?: 1,
                'verified_by' => $this->verified_by ?: 1,
            ];

            $this->common->save($lead, $extraFields);
            $this->common->logEntry('lead','create',$this->common->vname.' has been created');
            $this->clearFields();
            $message = "Saved";
//            $this->getBack();
        } else {

            $lead = Lead::find($this->common->vid);

            $extraFields = [
                'enquiry_id' => $this->enquiry_id,
                'body' => $this->body,
                'lead_id' => $this->lead_id ?: 1,
//                'assignee_id' => $this->assignee_id ?: 1,
                'softwareType_id' => $this->softwareType_id ?: 1,
//                'user_id' => auth()->id(),
                'questions' => json_encode($this->questions),
//                'status_id' => $this->status_id ?: 1,
                'verified_by' => $this->verified_by ?: 1,
            ];

            $this->common->edit($lead, $extraFields);
            $this->common->logEntry('lead','update',$this->common->vname.' has been updated');
            $this->clearFields();
            $message = "Updated";
        }
        $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
//        $this->getBack();
//        return redirect()->route('leads', ['id' => $this->enquiry_id]);
    }
    #endregion

    #region[getObj]
    public function getObj($id)
    {
        if ($id) {
            $obj = Lead::find($id);
            $this->common->vid = $obj->id;
            $this->common->vname = $obj->vname;
            $this->lead_id = $obj->lead_id;
            $this->body = $obj->body;
            $this->enquiry_id = $obj->enquiry_id ?: 1;
            $this->softwareType_id = $obj->softwareType_id;
            $this->softwareType_name = Common::find($obj->softwareType_id)->vname;
//            $this->status_id = $obj->status_id;
            $this->questions = json_decode($obj->questions, true) ?? $this->questions;
            $this->verified_by = $obj->verified_by;
            $this->common->active_id = $obj->active_id;
            return $obj;
        }
        return null;
    }
    #endregion

    #region[Clear Fields]
    public function clearFields(): void
    {
        $this->common->vid = '';
        $this->common->vname = '';
        $this->common->active_id = '1';
        $this->lead_id = '';
        $this->body = '';
        $this->enquiry_id = '';
        $this->softwareType_id = '';
        $this->softwareType_name = '';
//        $this->status_id = '';
        $this->questions = [
            'question1' => null,
            'question2' => null,
            'question3' => null,
            'question4' => null,
            'question5' => null,
            'question6' => null,
            'question7' => null,
        ];
        $this->verified_by = '';

    }
#endregion

    #region[Route]
    public function getRoute(): void
    {
        $this->redirect(route('leads'));
    }
    #endregion

    #region[softwareType]
    public $softwareType_id = '';
    public $softwareType_name = '';
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
    }

    public function enterSoftwareType(): void
    {
        $obj = $this->softwareTypeCollection[$this->highlightSoftwareType] ?? null;

        $this->softwareType_name = '';
        $this->softwareTypeCollection = Collection::empty();
        $this->highlightSoftwareType = 0;

        $this->softwareType_name = $obj['vname'] ?? '';
        $this->softwareType_id = $obj['id'] ?? '';
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
            Common::search(trim($this->softwareType_name))->where('label_id', '=', '26')->get() :
            Common::where('label_id', '=', '26')->orWhere('label_id', '=', '1')->get();
    }

#endregion


    #region[Render]
    public function render()
    {
        $this->getSoftwareTypeList();
        return view('livewire.crm.lead.upsert')->with([
            'list' => $this->getListForm->getList(Lead::class, function ($query) {
                return $query;
            })
        ]);
    }
    #endregion

    #region[route]
    public function getBack()
    {
        return redirect()->route('leads',$this->lead_id );
//        return redirect()->back();
    }
    #endregion
}
