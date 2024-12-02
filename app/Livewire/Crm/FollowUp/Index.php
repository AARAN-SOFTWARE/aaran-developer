<?php

namespace App\Livewire\Crm\FollowUp;

use Aaran\Common\Models\Common;
use Aaran\Crm\Models\FollowUp;
use Livewire\Component;
use App\Livewire\Trait\CommonTraitNew;

//use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection;
use Livewire\Attributes\Validate;


class Index extends Component
{

    use CommonTraitNew;

    #region[Properties]
    public $lead_id;
    public $body;
//    public $action;
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
                    'action_id' => $this->action_id,
                    'status_id' => $this->status_id ?: 1,
                    'priority_id' => $this->priority_id ?: 1,
                ];
                $this->common->save($followup, $extraFields);
                $this->common->logEntry('followUp','create',$this->common->vname.' has been created');
                $this->clearFields();
                $message = "Saved";
            } else {
                $followup = FollowUp::find($this->common->vid);
                $extraFields = [
                    'lead_id' => $this->lead_id,
                    'body' => $this->body,
                    'action_id' => $this->action_id,
                    'status_id' => $this->status_id ?: 1,
                    'priority_id' => $this->priority_id ?: 1,
                ];
                $this->common->edit($followup, $extraFields);
                $this->common->logEntry('followUp','update',$this->common->vname.' has been updated');
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
            $this->action_id = $obj->action_id;
            $this->action_name = Common::find($obj->action_id)->vname;
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
        $this->action_id = '';
        $this->action_name = '';
        $this->status_id = '';
        $this->priority_id = '';
    }
    #endregion


    #region[action]
    public $action_id = '';
    public $action_name = '';
    public Collection $actionCollection;
    public $highlightAction = 0;
    public $actionTyped = false;

    public function decrementAction(): void
    {
        if ($this->highlightAction === 0) {
            $this->highlightAction = count($this->actionCollection) - 1;
            return;
        }
        $this->highlightAction--;
    }

    public function incrementAction(): void
    {
        if ($this->highlightAction === count($this->actionCollection) - 1) {
            $this->highlightAction = 0;
            return;
        }
        $this->highlightAction++;
    }

    public function setAction($name, $id): void
    {
        $this->action_name = $name;
        $this->action_id = $id;
        $this->getActionList();
    }

    public function enterAction(): void
    {
        $obj = $this->actionCollection[$this->highlightAction] ?? null;

        $this->action_name = '';
        $this->actionCollection = Collection::empty();
        $this->highlightAction = 0;

        $this->action_name = $obj['vname'] ?? '';
        $this->action_id = $obj['id'] ?? '';
    }

    public function refreshAction($v): void
    {
        $this->action_id = $v['id'];
        $this->action_name = $v['name'];
        $this->actionTyped = false;
    }

    public function actionSave($name)
    {
        $obj = Common::create([
            'label_id' => 30,
            'vname' => $name,
            'active_id' => '1'
        ]);
        $v = ['name' => $name, 'id' => $obj->id];
        $this->refreshAction($v);
    }

    public function getActionList(): void
    {
        $this->actionCollection = $this->action_name ?
            Common::search(trim($this->action_name))->where('label_id', '=', '30')->get() :
            Common::where('label_id', '=', '30')->orWhere('label_id', '=', '1')->get();
    }
#endregion


    #region[Render]
    public function getRoute()
    {
        return route('followups');
    }

    public function render()
    {
        $this->getActionList();
        return view('livewire.crm.follow-up.index')->with([
            'list' => $this->getListForm->getList(FollowUp::class, function ($query) {
                return $query->orderBy('id', 'asc')->where('lead_id', $this->lead_id);
            }),
        ]);
    }


}
