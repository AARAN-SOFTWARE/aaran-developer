<?php

namespace App\Livewire\Crm\FollowUp;

use Aaran\Crm\Models\FollowUp;
use Livewire\Component;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Validate;




class Index extends Component
{

    use CommonTraitNew;

    #region[Properties]
    public $lead_id;
    public $body;
    public $action;
    public mixed $status_id;
    public mixed $priority_id;
    #endregion

    public function mount($id)
    {
        $this->lead_id = $id;

    }

    public function getSave(): void
    {
        if ($this->common->vname != '') {
            if ($this->common->vid == '') {
                $followup = new FollowUp();
                $extraFields = [
                    'lead_id' => $this->lead_id,
                    'body' => $this->body,
                    'action' => $this->action,
                    'status_id' => $this->status_id?:1,
                    'priority_id' => $this->priority_id?:1,
                ];
                $this->common->save($followup, $extraFields);
                $this->clearFields();
                $message = "Saved";
            } else {
                $followup = FollowUp::find($this->common->vid);
                $extraFields = [
                    'lead_id' => $this->lead_id,
                    'body' => $this->body,
                    'action' => $this->action,
                    'status_id' => $this->status_id?:1,
                    'priority_id' => $this->priority_id?:1,
                ];
                $this->common->edit($followup, $extraFields);
                $this->clearFields();
                $message = "Updated";
            }
            $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
        }
    }
    #endregion

    #region[getObj]
    public function getObj($id)
    {
        if ($id) {
            $obj = FollowUp::find($id);
            $this->common->vid = $obj->id;
            $this->common->vname = $obj->vname;
            $this->body = $obj->body;
            $this->action = $obj->action;
            $this->status_id = $obj->status_id;
            $this->priority_id = $obj->priority_id;
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
        $this->action = '';
        $this->status_id = '';
        $this->priority_id = '';
    }
    #endregion

    #region[Render]
    public function getRoute()
    {
        return route('followups');
    }

    public function render()
    {
//        $this->getContactList();
        return view('livewire.crm.follow-up.index')->with([
            'list' => $this->getListForm->getList(FollowUp::class, function ($query) {
                return $query->orderBy('id', 'asc')->where('lead_id', $this->lead_id);
            }),
        ]);
    }

//    public function render()
//    {
//        return view('livewire.crm.follow-ups.index');
//    }
}
