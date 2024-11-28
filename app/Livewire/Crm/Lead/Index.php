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
    public $assignee_id;
    public $enquiry_id;
    public $enquiry_data;

    #endregion

    #region[Mount]
    public function mount($id)
    {
        $this->enquiry_id = $id;
        $this->enquiry_data = Enquiry::find($id);

    }
    #endregion

    #region[Validation]
    public function rules(): array
    {
        return [
            'common.vname' => 'required|min:3',
            'body' => 'required|min:5',
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

    #region[getSave]
    public function getSave(): void
    {
        $this->validate($this->rules());

        if ($this->common->vid == '') {

            $lead = new Lead();

            $extraFields = [
                'enquiry_id' => $this->enquiry_id,
                'body' => $this->body,
                'status_id' => $this->status_id ?: 1,
                'assignee_id' => $this->assignee_id ?: 1,
                'softwareType_id' => $this->softwareType_id ?: 1,
                'user_id' => auth()->id(),
            ];

            $this->common->save($lead, $extraFields);
            $this->common->logEntry('lead','create',$this->common->vname.' has been created');
            $this->clearFields();
            $message = "Saved";

        } else {

            $lead = Lead::find($this->common->vid);

            $extraFields = [
                'enquiry_id' => $this->enquiry_id,
                'body' => $this->body,
                'status_id' => $this->status_id ?: 1,
                'assignee_id' => $this->assignee_id ?: 1,
                'softwareType_id' => $this->softwareType_id ?: 1,
                'user_id' => auth()->id(),
            ];

            $this->common->edit($lead, $extraFields);
            $this->common->logEntry('lead','update',$this->common->vname.' has been updated');
            $this->clearFields();
            $message = "Updated";
        }
        $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
    }
    #endregion

    #region[getObj]
    public function getObj($id)
    {
        if ($id) {
            $obj = Lead::find($id);
            $this->common->vid = $obj->id;
            $this->common->vname = $obj->vname;
            $this->body = $obj->body;
            $this->assignee_id = $obj->assignee_id;
            $this->softwareType_id = $obj->softwareType_id;
            $this->softwareType_name = Common::find($obj->softwareType_id)->vname;
            $this->status_id = $obj->status_id;
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
        $this->body = '';
        $this->assignee_id = '';
        $this->softwareType_id = '';
        $this->softwareType_name = '';
        $this->status_id = '';

    }

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
        return view('livewire.crm.lead.index')->with([
            'list' => $this->getListForm->getList(Lead::class, function ($query) {
                return $query->where('enquiry_id', $this->enquiry_id);
            })
        ]);
    }
    #endregion

}
