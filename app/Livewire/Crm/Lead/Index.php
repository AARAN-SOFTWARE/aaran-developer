<?php

namespace App\Livewire\Crm\Lead;

use Aaran\Crm\Models\Enquiry;
use Aaran\Crm\Models\Lead;
use App\Livewire\Trait\CommonTraitNew;
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

    public function mount($id)
    {
        $this->enquiry_id = $id;
        $this->enquiry_data = Enquiry::find($id);

    }

    #region[getSave]
    public function getSave(): void
    {
        if ($this->common->vid == '') {

            $lead = new Lead();

            $extraFields = [
                'enquiry_id' => $this->enquiry_id,
                'body' => $this->body,
                'status_id' => $this->status_id ?: 1,
                'assignee_id' => $this->assignee_id ?: 1,
                'user_id' => auth()->id(),
            ];

            $this->common->save($lead, $extraFields);
            $this->clearFields();
            $message = "Saved";

        } else {

            $lead = Lead::find($this->common->vid);

            $extraFields = [
                'enquiry_id' => $this->enquiry_id,
                'body' => $this->body,
                'status_id' => $this->status_id ?: 1,
                'assignee_id' => $this->assignee_id ?: 1,
                'user_id' => auth()->id(),
            ];

            $this->common->edit($lead, $extraFields);
            $this->clearFields();
            $message = "Updated";
        }
        $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
    }

    #region[getObj]
    public function getObj($id)
    {
        if ($id) {
            $obj = Lead::find($id);
            $this->common->vid = $obj->id;
            $this->common->vname = $obj->vname;
            $this->body = $obj->body;
            $this->assignee_id = $obj->assignee_id;
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
        $this->status_id = '';

    }

    #endregion
    public function render()
    {
        return view('livewire.crm.lead.index')->with([
            'list' => $this->getListForm->getList(Lead::class, function ($query) {
                return $query->where('enquiry_id', $this->enquiry_id);
            })
        ]);
    }
}
